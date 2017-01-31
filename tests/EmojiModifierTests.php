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

    public function test_smiley_emoji()
    {
        $input = 'I’m 😀';
        $excpected = 'I’m <span role="img" aria-label="grinning face">😀</span>';
        $this->assertEquals($excpected, $this->emoji->makeEmojiAccessible($input));
    }

    public function test_flag_emoji()
    {
        $input = 'I’m from 🇬🇧';
        $expected = 'I’m from <span role="img" aria-label="United Kingdom">🇬🇧</span>';
        $this->assertEquals($expected, $this->emoji->makeEmojiAccessible($input));
    }

    public function test_emoji_with_skintone()
    {
        $input = 'Inclusivity rocks. 👍🏻👍🏿';
        $expected = 'Inclusivity rocks. <span role="img" aria-label="thumbs up: light skin tone">👍🏻</span><span role="img" aria-label="thumbs up: dark skin tone">👍🏿</span>';
        $this->assertEquals($expected, $this->emoji->makeEmojiAccessible($input));
    }
}
