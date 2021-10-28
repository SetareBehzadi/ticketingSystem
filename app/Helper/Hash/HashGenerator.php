<?php


namespace App\Helper\Hash;


class HashGenerator
{

    public static function make($length = 10)
    {
        return bin2hex(random_bytes($length/2));
    }
}
