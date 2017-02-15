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

### Customise HTML

You can pass in a string to the constructor that will be used in the
`makeEmojiAccessible` method. We use PHP’s [sprinf](https://secure.php.net/manual/en/function.sprintf.php)
function.

Three variables are passed into the function. The desired output form, then the
text of the emoji, then the matched emoji character. Thankfully `sprintf` allows
you to swap variable order if you need to, see example 3 in the manual.

Of course you need to provide your own CSS for presentation.

Inspired by http://adrianroselli.com/2016/12/accessible-emoji-tweaked.html
