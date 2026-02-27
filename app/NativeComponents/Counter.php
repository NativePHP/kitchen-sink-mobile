<?php

namespace App\NativeComponents;

use Illuminate\Support\Facades\Http;
use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;
use Native\Mobile\Facades\Device;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\Network as NetworkFacade;

class Counter extends NativeComponent
{
    public int $count = 0;

    public $display = '';
    public $transformText = '';

    public bool $sheetVisible = false;
    public string $activeTransform = '';

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    // ── Text transform handlers ─────────────────

    public function showSheet()
    {
        $this->sheetVisible = true;
    }

    public function updatedTransformText(): void
    {
        $this->updateDisplay();
    }

    public function toggleUpper(bool $value): void
    {
        $this->activeTransform = $value ? 'upper' : '';
        $this->updateDisplay();
    }

    public function toggleLower(bool $value): void
    {
        $this->activeTransform = $value ? 'lower' : '';
        $this->updateDisplay();
    }

    public function toggleTitle(bool $value): void
    {
        $this->activeTransform = $value ? 'title' : '';
        $this->updateDisplay();
    }

    public function toggleCamel(bool $value): void
    {
        $this->activeTransform = $value ? 'camel' : '';
        $this->updateDisplay();
    }

    public function toggleSnake(bool $value): void
    {
        $this->activeTransform = $value ? 'snake' : '';
        $this->updateDisplay();
    }

    public function toggleKebab(bool $value): void
    {
        $this->activeTransform = $value ? 'kebab' : '';
        $this->updateDisplay();
    }

    public function toggleReverse(bool $value): void
    {
        $this->activeTransform = $value ? 'reverse' : '';
        $this->updateDisplay();
    }

    private function updateDisplay(): void
    {
        if (strlen($this->transformText) === 0 || $this->activeTransform === '') {
            $this->display = $this->transformText;
            return;
        }

        $this->display = (string) str($this->transformText)->{$this->activeTransform}();
    }

    public function viewDemo()
    {
        $this->sheetVisible = false;
        $this->navigate('/demo')
            ->transition(Transition::SlideFromRight);
    }

    public function viewBenchmark()
    {
        $this->navigate('/benchmark')
            ->transition(Transition::SlideFromRight);
    }

    public function render(): Element
    {
        return $this->view('counter');
    }
}
