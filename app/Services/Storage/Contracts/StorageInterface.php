<?php

namespace App\Services\Storage\Contracts;

interface StorageInterface
{

    public function get($index);

    public function set($index, $value);
    //get all in the session
    public function all();
    //item is in session
    public function exists($index);
//remove one
    public function unset($index);
    //clear session
    public function clear();

}
