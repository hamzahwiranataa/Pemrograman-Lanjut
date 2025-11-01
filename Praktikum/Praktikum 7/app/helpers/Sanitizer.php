<?php
class Sanitizer
{
    public static function phone($value)
    {
        $digits = preg_replace('/\D/', '', $value);

        if (strpos($digits, '62') === 0) {
            $digits = '+' . $digits;
        } elseif (strpos($digits, '0') === 0) {
            $digits = '+62' . substr($digits, 1);
        } else {
            $digits = '+62' . $digits;
        }

        if (preg_match('/^\+62(\d{3})(\d{4})(\d{4})$/', $digits, $m)) {
            return "+62-{$m[1]}-{$m[2]}-{$m[3]}";
        }

        return $digits;
    }

    public static function name($value)
    {
        $clean = preg_replace('/[^a-zA-Z\s]/', '', $value);
        $clean = ucwords(strtolower(trim($clean)));
        return $clean;
    }

    public static function alphanumeric($value)
    {
        return preg_replace('/[^a-zA-Z0-9]/', '', $value);
    }
}
