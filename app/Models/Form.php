<?php

namespace App\Models;


class Form
{

    private array $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }


    public function getForm()
    {
        $fields = $this->fields;
    }

    public function createField($data)
    {
    }

    public function returnada(int $int): int
    {
        return $int;
    }

}
