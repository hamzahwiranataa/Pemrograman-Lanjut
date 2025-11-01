<?php
class DateHelper
{
    public static function format($date, $format = 'd-m-Y')
    {
        return date($format, strtotime($date));
    }

    public static function age($birthdate)
    {
        $dob = new DateTime($birthdate);
        $today = new DateTime();
        return $today->diff($dob)->y;
    }

    public static function diffHuman($date)
    {
        $target = new DateTime($date);
        $now = new DateTime();
        $diff = $now->diff($target);

        if ($diff->days == 0) return 'hari ini';
        if ($diff->invert == 0) return $diff->days . ' hari lagi';
        return $diff->days . ' hari yang lalu';
    }

    public static function toMysql($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }

    public static function isWeekend($date)
    {
        $day = date('N', strtotime($date)); // 6 = Sabtu, 7 = Minggu
        return ($day >= 6);
    }
}
