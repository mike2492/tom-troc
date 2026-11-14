<?php

// Base class of all entities: fills an object from an associative array
// (typically a database row).
abstract class Entity
{
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    // Calls the matching setter for each key: "user_id" becomes setUserId().
    // Keys without a public setter are ignored, so unexpected columns do no harm.
    protected function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (is_callable([$this, $setter])) {
                $this->$setter($value);
            }
        }
    }
}
