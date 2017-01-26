<?php

namespace App\Controllers;

class ExampleController extends \Cotton\Controller
{
    private $property = null;

    public function __construct()
    {
        $this->property = 'OUT';
    }

    public function hello($name)
    {
        echo "HELLO {$name} FROM {$this->property} " . static::class . " CLASS!" . PHP_EOL;
    }
}
