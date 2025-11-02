<?php

class Csrf
{
    protected static $ttl = 3600; // 1 hour

    protected static function ensureSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['csrf_tokens']) || !is_array($_SESSION['csrf_tokens'])) {
            $_SESSION['csrf_tokens'] = [];
        }
    }

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

    public static function inputField(string $form = '_global') : string
    {
        $token = self::getToken($form);
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    public static function verify(string $token, string $form = '_global') : bool
    {
        self::ensureSession();
        if (empty($token)) return false;
        if (!isset($_SESSION['csrf_tokens'][$form])) return false;
        $meta = $_SESSION['csrf_tokens'][$form];
        if (!isset($meta['token'])) return false;

        if (isset($meta['time']) && (time() - $meta['time']) > self::$ttl) {
            unset($_SESSION['csrf_tokens'][$form]);
            return false;
        }
        $valid = hash_equals($meta['token'], $token);
        if ($valid) {

            unset($_SESSION['csrf_tokens'][$form]);
            return true;
        }
        return false;
    }


    public static function verifyOrFail(string $token, string $form = '_global') : void
    {
        if (!self::verify($token, $form)) {

            http_response_code(403);

            $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
            if (strpos($accept, 'application/json') !== false) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'CSRF token invalid or missing']);
            } else {
                echo '<h1>403 Forbidden</h1></p>';
            }
            exit;
        }
    }
}
