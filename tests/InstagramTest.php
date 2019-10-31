<?php

//phpunit 3.7.21
//https://phpunit.de/manual/3.7/en/automating-tests.html

//cmd: phpunit tests\InstagramTest.php

require __DIR__ . '..\..\model\instagram.php';
require_once 'PHPUnit/Autoload.php';

final class InstagramTest extends PHPUnit_Framework_TestCase
{
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
        $this->assertCount(1,array("foo"));
    }
}