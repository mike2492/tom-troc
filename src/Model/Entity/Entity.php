<?php

abstract class Entity{

    public function __construct(array $data = []){
        if(!empty($data)){
            $this->hydrate($data);
        }
    }

    protected function hydrate(array $data){
        foreach($data as $key => $value){
            $setter = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));       
            if(is_callable([$this, $setter])){
                $this->$setter($value);
            }
        }
    }
}