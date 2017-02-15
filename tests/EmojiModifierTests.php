<?php

namespace Jonnybarnes\EmojiA11y\Test;

use PHPUnit\Framework\TestCase;
use Jonnybarnes\EmojiA11y\EmojiModifier;

class EmojiModifierTest extends TestCase
{
    public function setUp()
    {
        $this->emoji = new EmojiModifier();
    }

    public function tearDown()
    {
        $this->emoji = null;
    }

    public function test_no_emojis()
    {
        $input = 'No emojis here';
        $this->assertEquals($input, $this->emoji->makeEmojiAccessible($input));
    }

    public function test_smiley_emoji()
    {
        $input = 'I’m 😀';
        $expected = 'I’m <span role="img" aria-label="grinning face">😀</span>';
        $this->assertEquals($expected, $this->emoji->makeEmojiAccessible($input));
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

    public function test_job_plus_skintone_emoji()
    {
        $input = 'I want to be a 👨🏼‍🏫';
        $expected = 'I want to be a <span role="img" aria-label="man teacher: medium-light skin tone">👨🏼‍🏫</span>';
        $this->assertEquals($expected, $this->emoji->makeEmojiAccessible($input));
    }

    public function test_family_emoji()
    {
        $input = 'Love conquers all. 👩‍👩‍👧';
        $expected = 'Love conquers all. <span role="img" aria-label="family: woman, woman, girl">👩‍👩‍👧</span>';
        $this->assertEquals($expected, $this->emoji->makeEmojiAccessible($input));
    }

    public function test_keycap_emoji()
    {
        $input = 'What’s your #️⃣';
        $expected = 'What’s your <span role="img" aria-label="keycap: #">#️⃣</span>';
        $this->assertEquals($expected, $this->emoji->makeEmojiAccessible($input));
    }

    public function test_random_2016_emoji()
    {
        $input = 'My favourite fruit is a 🥝';
        $expected = 'My favourite fruit is a <span role="img" aria-label="kiwi fruit">🥝</span>';
        $this->assertEquals($expected, $this->emoji->makeEmojiAccessible($input));
    }

    public function test_different_output()
    {
        $emojiModifier = new EmojiModifier('<span alt="%s">%s</span>');
        $input = 'I’m 😀';
        $expected = 'I’m <span alt="grinning face">😀</span>';
        $this->assertEquals($expected, $emojiModifier->makeEmojiAccessible($input));
        unset($emojiModifier);
    }
}
