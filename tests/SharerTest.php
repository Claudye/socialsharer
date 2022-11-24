<?php

use PHPUnit\Framework\TestCase;
use Claudye\Socialsharer\Sharer;
use Claudye\Socialsharer\Social\Facebook;

class SharerTest extends TestCase
{

    public function test_sharer()
    {
        $facebook = Sharer::facebook();

        return $this->assertInstanceOf(
            Facebook::class,
            $facebook
        );
    }
}
