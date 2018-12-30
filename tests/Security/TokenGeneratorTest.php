<?php
namespace App\Security;

use PHPUnit\Framework\TestCase;

class TokenGeneratorTest extends TestCase
{
    public function testGetRandomSecureToken()
    {
        $tokenGen = new TokenGenerator();
        $token = $tokenGen->getRandomSecureToken(30);

        $this->assertEquals(30, strlen($token));
        $this->assertEquals(1, preg_match("/[A-Za-z0-9]/", $token));
        $this->assertTrue(ctype_alnum($token), 'Token contains illegal characters.');
    }
}
