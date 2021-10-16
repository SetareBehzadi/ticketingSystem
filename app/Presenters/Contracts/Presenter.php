<?php

namespace App\Presenters\Contracts;

abstract class Presenter
{

    protected $entity;

    /**
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function __get($property)
    {

        if (method_exists($this,$property)){
             return $this->{$property}();
        }
        return $this->entity->{$property};
    }

}
