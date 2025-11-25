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
    ];

    public static function random(): array
    {
        return self::$quotes[array_rand(self::$quotes)];
    }
}
