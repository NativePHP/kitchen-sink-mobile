<?php

namespace App\Data;

class Quotes
{
    public static array $quotes = [
        [
            'quote' => "Unpopular opinion: yellow snow is nature's lemon sorbet",
            'author' => 'Craig Anderson',
        ],
        [
            'quote' => 'Only use React if you hate fun',
            'author' => 'Jason Beggs',
        ],
        [
            'quote' => "It's not double-dipping if you rotate the chip",
            'author' => 'Harris Raftopoulos',
        ],
        [
            'quote' => "Knock knock. Race condition. Who's there?",
            'author' => 'Povilas Korop',
        ],
        [
            'quote' => "If my wallet matched my diet, it'd explode",
            'author' => 'Logan Craft',
        ],
        [
            'quote' => "You're mom",
            'author' => 'Simon Hamp',
        ],
        [
            'quote' => "If I didn't have cats, I would be committing a lot more crimes.",
            'author' => 'Dan Harrin',
        ],
        [
            'quote' => "Jokes have to be funny, or not, I don't really care",
            'author' => 'ModestasV',
        ],
        [
            'quote' => "It works on my machine, so the problem is clearly your reality",
            'author' => 'Tilly the Coder',
        ],
        [
            'quote' => "!false is funny because it's true",
            'author' => 'Punyapal Shah',
        ],
        [
            'quote' => "Why learn an entire new language when you can just... not?",
            'author' => 'Tendai Karuma',
        ],
        [
            'quote' => "I'm not a funny guy!",
            'author' => 'TJ Miller',
        ],
        [
            'quote' => "Life is all about one thing, finding excuses to eat more whipped cream",
            'author' => 'Shane Rosenthal',
        ],
        [
            'quote' => "It's all about the community!",
            'author' => 'Caneco',
        ],
        [
            'quote' => "The Laravel community is the framework that supports the framework",
            'author' => 'Kasper Hartwich',
        ],
        [
            'quote' => "From now on, I'm only deploying changes directly to production… using FTP… on hotel Wi-Fi.",
            'author' => 'James Brooks',
        ],
    ];

    public static function random(): array
    {
        return self::$quotes[array_rand(self::$quotes)];
    }
}
