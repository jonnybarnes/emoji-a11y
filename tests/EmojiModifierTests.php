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

    public function test_single_emoji()
    {
        $input = 'I’m 😀';
        $excpected = 'I’m <span role="img" aria-label="grinning face">😀</span>';
        $this->assertEquals($excpected, $this->emoji->makeEmojiAccessible($input));
    }
}
