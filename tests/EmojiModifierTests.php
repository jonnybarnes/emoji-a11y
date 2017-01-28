<?php

namespace Jonnybarnes\EmojiA11y\Test;

use PHPUnit_Framework_TestCase;
use Jonnybarnes\EmojiA11y\EmojiModifier;

class EmojiModifierTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->emoji = new EmojiModifier();
    }

    public function tearDown()
    {
        $this->emoji = null;
    }

    public function test_emoji_returns_same()
    {
        $this->assertEquals('Test', $this->emoji->makeEmojiAccessible('Test'));
    }
}
