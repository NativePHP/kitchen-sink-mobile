<?php

namespace App\NativeComponents;

use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\Elements\Button;
use Native\Mobile\Edge\Elements\Column;
use Native\Mobile\Edge\Elements\Divider;
use Native\Mobile\Edge\Elements\Row;
use Native\Mobile\Edge\Elements\Spacer;
use Native\Mobile\Edge\Elements\Text;
use Native\Mobile\Edge\Elements\TextInput;
use Native\Mobile\Edge\NativeComponent;

class WizardStep1 extends NativeComponent
{
    public string $name = '';

    public function onNameChange(string $text)
    {
        $this->name = $text;
    }

    public function next()
    {
        // TODO: switch back to replace() once debugged
        $this->navigate('/wizard/2', ['name' => $this->name]);
    }

    public function cancel()
    {
        $this->back();
    }

    public function render(): Element
    {
        $filled = strlen($this->name) > 0;

        return Column::make(
            Column::make(
                // Header
                Row::make(
                    Button::make('Cancel')->onPress('cancel')->color('#999999')->labelColor('#FFFFFF'),
                    Text::make('New Project')->fontSize(20)->fontWeight(6)->color('#1a1a2e'),
                    Spacer::make()->width(80),
                )->fillWidth()->padding(16, 16, 8, 16)->justifyContent(3)->alignItems(1),

                Divider::make()->fillWidth(),

                // Progress
                Row::make(
                    $this->stepDot('1', true),
                    Column::make()->fillWidth()->height(2)->bg('#6200EE')->flexGrow(1),
                    $this->stepDot('2', false),
                    Column::make()->fillWidth()->height(2)->bg('#E0E0E0')->flexGrow(1),
                    $this->stepDot('3', false),
                )->fillWidth()->padding(24, 32, 16, 32)->alignItems(1),

                // Form
                Column::make(
                    Text::make('Step 1 of 3')->fontSize(14)->fontWeight(5)->color('#6200EE'),
                    Text::make('What should we call your project?')->fontSize(22)->fontWeight(7)->color('#1a1a2e'),
                    Spacer::make()->height(8),
                    Text::make('Project name')->fontSize(13)->color('#666666'),
                    TextInput::make()
                        ->value($this->name)
                        ->placeholder('My Awesome App')
                        ->onChange('onNameChange')
                        ->fillWidth(),
                    $filled
                        ? Text::make("Great name: \"{$this->name}\"")->fontSize(13)->color('#4CAF50')
                        : Text::make('Enter a name to continue')->fontSize(13)->color('#999999'),
                )->fillWidth()->padding(24)->gap(6),

                Spacer::make()->height(32),

                // Footer
                Column::make(
                    Button::make($filled ? 'Next: Choose Template' : 'Enter a name first')
                        ->onPress('next')
                        ->color($filled ? '#6200EE' : '#CCCCCC')
                        ->labelColor('#FFFFFF'),
                    Spacer::make()->height(8),
                    Text::make('Uses replace() — back from step 2 skips step 1')->fontSize(11)->color('#999999')->textAlign(1),
                )->fillWidth()->padding(16, 24, 32, 24)->gap(4)->alignItems(1),

            )->fillWidth()->safeArea(),
        )->fill()->bg('#F5F5F5');
    }

    private function stepDot(string $num, bool $active): Element
    {
        return Column::make(
            Text::make($num)->fontSize(12)->fontWeight(6)->color($active ? '#FFFFFF' : '#999999')->textAlign(1),
        )->width(28)->height(28)->bg($active ? '#6200EE' : '#E0E0E0')->borderRadius(14)->center();
    }
}