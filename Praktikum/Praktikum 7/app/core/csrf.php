<?php
// Simple CSRF protection helper for the Praktikum MVC
// Usage:
// - In your form view: echo \Csrf::inputField();
// - In your controller POST handler: \Csrf::verifyOrFail($_POST['csrf_token'] ?? '');

class Csrf
{
    // Token lifetime in seconds (optional)
    protected static $ttl = 3600; // 1 hour

    // Ensure session started
    protected static function ensureSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['csrf_tokens']) || !is_array($_SESSION['csrf_tokens'])) {
            $_SESSION['csrf_tokens'] = [];
        }
    }

    // Generate a new token (optionally namespaced per form)
    public static function generateToken(string $form = '_global') : string
    {
        self::ensureSession();
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_tokens'][$form] = [
            'token' => $token,
            'time'  => time()
        ];
        return $token;
    }

    // Get existing token or generate a new one
    public static function getToken(string $form = '_global') : string
    {
        self::ensureSession();
        if (isset($_SESSION['csrf_tokens'][$form])) {
            $meta = $_SESSION['csrf_tokens'][$form];
            if (isset($meta['time']) && (time() - $meta['time']) <= self::$ttl && !empty($meta['token'])) {
                return $meta['token'];
            }
        }
        return self::generateToken($form);
    }

    // Helper: render a hidden input field for forms
    public static function inputField(string $form = '_global') : string
    {
        $token = self::getToken($form);
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    // Verify a token (optionally by form namespace). Single-use: token is removed on success.
    public static function verify(string $token, string $form = '_global') : bool
    {
        self::ensureSession();
        if (empty($token)) return false;
        if (!isset($_SESSION['csrf_tokens'][$form])) return false;
        $meta = $_SESSION['csrf_tokens'][$form];
        if (!isset($meta['token'])) return false;
        // check expiry
        if (isset($meta['time']) && (time() - $meta['time']) > self::$ttl) {
            unset($_SESSION['csrf_tokens'][$form]);
            return false;
        }
        $valid = hash_equals($meta['token'], $token);
        if ($valid) {
            // single-use: remove stored token
            unset($_SESSION['csrf_tokens'][$form]);
            return true;
        }
        return false;
    }

    // Verify or send 403 and exit
    public static function verifyOrFail(string $token, string $form = '_global') : void
    {
        if (!self::verify($token, $form)) {
            // simple JSON-aware 403 for AJAX or normal 403 for browsers
            http_response_code(403);
            // If request expects JSON, return JSON message
            $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
            if (strpos($accept, 'application/json') !== false) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'CSRF token invalid or missing']);
            } else {
                echo '<h1>403 Forbidden</h1><p>CSRF token invalid or missing.</p>';
            }
            exit;
        }
    }
}
