<?php

abstract class Entity{

    public function __construct(array $data = []){
        if(!empty($data)){
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data){
        foreach($data as $key => $value){
            $setter = 'set' . str_replace('_', '', ucwords($key, '_'));
            if(method_exists($this, $setter)){
                $this->$setter($value);
            }
        }

        return $this;
    }
}