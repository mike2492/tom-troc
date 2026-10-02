<?php

abstract class Entity{

    public function __construct(array $data = []){
        $this->hydrate($data);
    }

    protected function hydrate(array $data) : void{
        foreach($data as $key => $value){
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
}