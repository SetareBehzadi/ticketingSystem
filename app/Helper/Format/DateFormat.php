<?php

namespace App\Helper\Format;

class DateFormat
{

    public static function miladiToShamsi($time, $hour = null)
    {
        $miladi = explode(' ', $time);
        if (count($miladi) < 1) {
            $time = date("Y-m-d H:i:s");
            $miladi = explode(' ', $time);
        }
        $miiladi = $miladi[0];
        $fMiladi = explode('-', $miiladi);
        if (count($fMiladi) < 3) {
            $time = date("Y-m-d H:i:s");
            $miladi = explode(' ', $time);
            $miiladi = $miladi[0];
            $fMiladi = explode('-', $miiladi);
        }
        $fMiladiii = \Morilog\Jalali\CalendarUtils::toJalali($fMiladi[0], $fMiladi[1], $fMiladi[2]);
        if ($fMiladiii[1] < 10) {
            $fMiladiii[1] = '0' . $fMiladiii[1];
        }
        if ($fMiladiii[2] < 10) {
            $fMiladiii[2] = '0' . $fMiladiii[2];
        }
        $shamsi = $fMiladiii[0] . '/' . $fMiladiii[1] . '/' . $fMiladiii[2];
        if ($hour) {
            $hour = $miladi[1];
            $shamsi = $fMiladiii[0] . '/' . $fMiladiii[1] . '/' . $fMiladiii[2] . ' - ' . $hour;
        }

        $shamsi = Number::PersianNumbers($shamsi);
        return $shamsi;
    }

}
