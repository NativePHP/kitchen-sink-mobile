<?php

namespace App\Livewire\Concerns;

use App\Data\Quotes;

trait HasQuote
{
    public function getRandomQuoteProperty(): array
    {
        return Quotes::random();
    }
}
