<?php
//declare(strict_types=1);

/*
        Documentation: https://phpunit.de/getting-started/phpunit-5.html
        execution: 
*/


// require __DIR__ . '..\..\model\instagram.php';
// require_once 'PHPUnit\Autoload.php';


require __DIR__ . '../../model/instagram.php';
require_once 'PHPUnit/Autoload.php';
//include __DIR__ . '/../vendor/autoload.php'

//use PHPUnit\Framework\TestCase;

class InstagramTest extends PHPUnit_Framework_TestCase
{
    /*
        @test
    */
    public function testGetReport(){
        $rawHandles=[
            "https://www.instagram.com/aashnahegde/",
            "https://www.instagram.com/anmolbhatia_/",
            "https://www.instagram.com/ashi_khanna/",
            "https://www.instagram.com/ahsaassy_/",
            "https://www.instagram.com/thechiquefactor/",
            "https://www.instagram.com/kushakapila/",
            "https://www.instagram.com/cherryjain21/?hl=en",
            "https://www.instagram.com/rits_badiani/",
            "https://www.instagram.com/vitastabhat/"
        ];
        $this->assertCount(8,$rawHandles);
    }
}

