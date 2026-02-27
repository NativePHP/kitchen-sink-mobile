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

class Edit extends NativeComponent
{
    public string $notes = '';

    public function onNotesChange(string $text)
    {
        $this->notes = $text;
    }

    public function goBack()
    {
        $this->back();
    }

    public function render(): Element
    {
        $item = $this->data('item', '—');
        $likes = $this->data('likes', 0);

        return Column::make(
          Column::make(
            // Header
            Row::make(
                Button::make('< Back')->onPress('goBack')->color('#FF5722')->labelColor('#FFFFFF'),
                Text::make('Edit')->fontSize(20)->fontWeight(6)->color('#1a1a2e'),
                Spacer::make()->width(80),
            )->fillWidth()->padding(16, 16, 8, 16)->justifyContent(3)->alignItems(1),

            Divider::make()->fillWidth(),

            Column::make(
                // Data received
                Column::make(
                    Text::make('Navigation Data Received')->fontSize(18)->fontWeight(6)->color('#1a1a2e'),
                    Spacer::make()->height(4),
                    Text::make('Passed via $this->navigate(\'/edit\', [...])')->fontSize(12)->color('#6200EE')->fontWeight(5),
                    Text::make('Read via $this->data(\'item\')')->fontSize(12)->color('#6200EE')->fontWeight(5),
                    Spacer::make()->height(8),
                    Row::make(
                        Text::make('item:')->fontSize(14)->color('#666666'),
                        Text::make((string) $item)->fontSize(14)->fontWeight(6)->color('#1a1a2e'),
                    )->gap(8),
                    Row::make(
                        Text::make('likes:')->fontSize(14)->color('#666666'),
                        Text::make((string) $likes)->fontSize(14)->fontWeight(6)->color('#E91E63'),
                    )->gap(8),
                )->fillWidth()->padding(20)->bg('#FFFFFF')->borderRadius(12)->gap(4),

                // Edit form
                Column::make(
                    Text::make('Add Notes')->fontSize(18)->fontWeight(6)->color('#1a1a2e'),
                    TextInput::make()
                        ->value($this->notes)
                        ->placeholder('Type notes for this item...')
                        ->onChange('onNotesChange')
                        ->fillWidth(),
                    Text::make(strlen($this->notes) > 0 ? "Editing: \"{$this->notes}\"" : 'No notes yet')
                        ->fontSize(13)->color(strlen($this->notes) > 0 ? '#4CAF50' : '#999999'),
                )->fillWidth()->padding(20)->bg('#FFFFFF')->borderRadius(12)->gap(10),

                // Info
                Column::make(
                    Text::make('Back returns to Detail with its state intact.')->fontSize(12)->color('#999999')->textAlign(1),
                    Text::make('Then back again returns to Demo — tap count preserved.')->fontSize(12)->color('#999999')->textAlign(1),
                )->fillWidth()->padding(16)->gap(4)->alignItems(1),

            )->fillWidth()->padding(16)->gap(12),

          )->fillWidth()->safeArea(),
        )->fill()->bg('#F5F5F5');
    }
}