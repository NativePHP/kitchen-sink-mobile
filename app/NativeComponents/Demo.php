<?php

namespace App\NativeComponents;

use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Facades\Biometrics;
use Native\Mobile\Facades\Dialog;

class Demo extends NativeComponent
{
    // Button state
    public int $tapCount = 0;
    public int $longPressCount = 0;

    // Text input state
    public string $inputText = '';
    public string $submittedText = '';
    public string $secureText = '';

    // Toggle state
    public bool $darkMode = false;
    public bool $notifications = false;

    // Checkbox state
    public bool $agreeTerms = false;
    public bool $newsletter = true;

    // Slider state
    public float $volume = 50.0;
    public float $brightness = 0.7;

    // Radio state
    public string $selectedSize = 'medium';

    // Select state
    public string $selectedColor = '';

    // Tab state
    public int $selectedTab = 0;

    // Bottom sheet state
    public bool $sheetVisible = false;

    // List item state
    public bool $listCheckbox = false;
    public bool $listRadio = false;
    public bool $listTrailingCheckbox = true;
    public bool $listSwitch = false;
    public int $trailingPressCount = 0;

    // Chip state
    public bool $chipA = true;
    public bool $chipB = false;
    public bool $chipC = false;

    // Button group state
    public int $selectedSegment = 0;

    // Form validation state
    public string $formName = '';
    public string $formEmail = '';
    public array $errors = [];
    public bool $formSubmitted = false;

    // ── Button handlers ──────────────────────────

    public function tap()
    {
        $this->tapCount++;
    }

    public function longTap()
    {
        $this->longPressCount++;
    }

    public function resetCounters()
    {
        $this->tapCount = 0;
        $this->longPressCount = 0;
    }

    // ── Text input handlers ──────────────────────

    public function onType(string $text)
    {
        $this->inputText = $text;
    }

    public function onSubmit(string $text)
    {
        $this->submittedText = strtoupper($text);
    }

    public function onSecureType(string $text)
    {
        $this->secureText = $text;
    }

    public function clearInput()
    {
        $this->inputText = '';
        $this->secureText = '';
        $this->submittedText = '';
    }

    // ── Toggle handlers ──────────────────────────

    public function toggleDark(bool $value)
    {
        $this->darkMode = $value;
    }

    public function toggleNotifications(bool $value)
    {
        if($value){
            Biometrics::prompt();
        }
        $this->notifications = $value;
    }

    // ── Checkbox handlers ────────────────────────

    public function toggleTerms(bool $value)
    {
        $this->agreeTerms = $value;
    }

    public function toggleNewsletter(bool $value)
    {
        $this->newsletter = $value;
    }

    // ── Slider handlers ─────────────────────────

    public function onVolumeChange(float $value)
    {
        $this->volume = round($value, 1);
    }

    public function onBrightnessChange(float $value)
    {
        $this->brightness = round($value, 2);
    }

    // ── Radio handlers ──────────────────────────

    public function onSizeChange(string $value)
    {
        $this->selectedSize = $value;
    }

    // ── Select handlers ─────────────────────────

    public function onColorChange(string $value)
    {
        $this->selectedColor = $value;
    }

    // ── Tab handlers ────────────────────────────

    public function onTabChange(int $index)
    {
        $this->selectedTab = $index;
    }

    // ── Bottom sheet handlers ───────────────────

    public function showSheet()
    {
        $this->sheetVisible = true;
    }

    public function hideSheet()
    {
        $this->sheetVisible = false;
    }

    // ── List item handlers ────────────────────────

    public function onListCheckbox(bool $value)
    {
        $this->listCheckbox = $value;
    }

    public function onListRadio(bool $value)
    {
        $this->listRadio = $value;
    }

    public function onListTrailingCheckbox(bool $value)
    {
        $this->listTrailingCheckbox = $value;
    }

    public function onListSwitch(bool $value)
    {
        $this->listSwitch = $value;
    }

    public function onTrailingPress()
    {
        $this->trailingPressCount++;
    }

    // ── Chip handlers ────────────────────────────

    public function toggleChipA(bool $value)
    {
        $this->chipA = $value;
    }

    public function toggleChipB(bool $value)
    {
        $this->chipB = $value;
    }

    public function toggleChipC(bool $value)
    {
        $this->chipC = $value;
    }

    // ── Button group handlers ────────────────────

    public function onSegmentChange(int $index)
    {
        $this->selectedSegment = $index;
    }

    // ── Form validation handlers ────────────────

    public function onFormName(string $text)
    {
        $this->formName = $text;
        // Clear error on edit
        unset($this->errors['name']);
    }

    public function onFormEmail(string $text)
    {
        $this->formEmail = $text;
        unset($this->errors['email']);
    }

    public function submitForm()
    {
        $this->errors = [];
        $this->formSubmitted = false;

        if (trim($this->formName) === '') {
            $this->errors['name'] = 'Name is required';
        } elseif (strlen($this->formName) < 2) {
            $this->errors['name'] = 'Name must be at least 2 characters';
        }

        if (trim($this->formEmail) === '') {
            $this->errors['email'] = 'Email is required';
        } elseif (! str_contains($this->formEmail, '@')) {
            $this->errors['email'] = 'Enter a valid email address';
        }

        if (empty($this->errors)) {
            $this->formSubmitted = true;
        }
    }

    public function resetForm()
    {
        $this->formName = '';
        $this->formEmail = '';
        $this->errors = [];
        $this->formSubmitted = false;
    }

    // ── Navigation handlers ─────────────────────

    public function openDetail()
    {
        $this->navigate('/detail/42');
    }

    public function openEdit()
    {
        $this->navigate('/edit', ['item' => 'direct', 'likes' => 0]);
    }

    public function openSettings()
    {
        $this->navigate('/settings');
    }

    public function openItemList()
    {
        $this->navigate('/items');
    }

    public function openWizard()
    {
        $this->navigate('/wizard/1');
    }

    public function exitToHome()
    {
        $this->exitToWeb('/flashlight');
    }

    public function fireDd()
    {
        dd('Hey Laracon 🔥', now()->format('F j, Y H:i'));
    }

    public function fireException()
    {
        throw new \Exception('We EFFED UP 💩');
    }

    public function onResume(): void
    {
        // Called when returning via back() — state is preserved
        Dialog::toast('Welcome back! Tap count: '.$this->tapCount);
    }

    // ── Render ───────────────────────────────────

    public function render(): Element
    {
        return $this->view('demo');
    }
}
