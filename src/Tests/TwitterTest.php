<?php

namespace Shoogly\Tests;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\Twitter;

final class TwitterTest extends TestCase
{
    public function testIsntantiates(): void
    {
        $twitter = new Twitter('twitter');

        $array = [
            'handle' => '@twitter',
            'url'    => 'http://www.twitter.com/twitter',
            'link'   => '<a href="http://www.twitter.com/twitter">@twitter</a>',
        ];

        $this->assertEquals('@twitter', $twitter->handle());
        $this->assertEquals('http://www.twitter.com/twitter', $twitter->url());
        $this->assertEquals('<a href="http://www.twitter.com/twitter">@twitter</a>', $twitter->link());
        $this->assertEquals($array, $twitter->toArray());
    }
}
