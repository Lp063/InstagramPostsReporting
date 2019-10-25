<?php
declare(strict_types=1);
require __DIR__ . '..\model\instagram.php';
use PHPUnit\Framework\TestCase;

final class InstagramTest extends TestCase
{
    public function testGetReport(): void
    {
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
        $this->assertInstanceOf(
            instagram::class,
            instagram::processInfluencers($rawHandles)
        );
    }
}