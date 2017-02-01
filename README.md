# emoji-a11y

Make emoji more accessible.

## Install

Add this package with composer:

```
composer require jonnybarnes/emoji-a11y
```

## Usage

Anywhere you have some text with emoji use the `makeEmojiAccessible` method.

```
$emoji = new Jonnybarnes\EmojiA11y\EmojiModifier();
$text = 'I’m 😀';
$emoji->makeEmojiAccessible($text); // I’m <span role="img" aria-label="grinning face">😀</span>
```
