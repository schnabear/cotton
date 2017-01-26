<?php

include '../vendor/autoload.php';

error_reporting(E_ALL);

class HelloController extends \Cotton\Controller
{
    private $property = null;

    public function __construct()
    {
        $this->property = 'IN';
    }

    public function hello($name)
    {
        echo "HELLO {$name} FROM {$this->property} " . static::class . " CLASS!" . PHP_EOL;
    }
}

$app = new \Cotton\Application;
$app->get('/hello\/([^\/]+)/', function($name) {
    echo "HELLO {$name}!" . PHP_EOL;
});
$app->get('/inline\/([^\/]+)/', 'HelloController@hello');
$app->get('/exline\/([^\/]+)/', '\App\Controllers\ExampleController@hello');
$app->any('/.*/', function() {
    echo 'HELLO YO!' . PHP_EOL;
});
$app->run();
