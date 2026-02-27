<?php

namespace App\NativeComponents;

use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\Elements\Button;
use Native\Mobile\Edge\Elements\Column;
use Native\Mobile\Edge\Elements\Divider;
use Native\Mobile\Edge\Elements\Row;
use Native\Mobile\Edge\Elements\Spacer;
use Native\Mobile\Edge\Elements\Text;
use Native\Mobile\Edge\NativeComponent;

class Detail extends NativeComponent
{
    public int $likes = 0;

    public function like()
    {
        $this->likes++;
    }

    public function openEdit()
    {
        $this->navigate('/edit', ['item' => $this->param('id', '??'), 'likes' => $this->likes]);
    }

    public function goBack()
    {
        $this->back();
    }

    public function render(): Element
    {
        $id = $this->param('id', '—');

        return Column::make(
          Column::make(
            // Header
            Row::make(
                Button::make('< Back')->onPress('goBack')->color('#6200EE')->labelColor('#FFFFFF'),
                Text::make('Detail')->fontSize(20)->fontWeight(6)->color('#1a1a2e'),
                Spacer::make()->width(80),
            )->fillWidth()->padding(16, 16, 8, 16)->justifyContent(3)->alignItems(1),

            Divider::make()->fillWidth(),

            Column::make(
                // Item info card
                Column::make(
                    Text::make("Item #{$id}")->fontSize(28)->fontWeight(7)->color('#1a1a2e')->textAlign(1),
                    Spacer::make()->height(8),
                    Text::make('This component received its ID from a route parameter.')->fontSize(14)->color('#666666'),
                    Text::make("Route::native('/detail/{id}', Detail::class)")->fontSize(12)->color('#6200EE')->fontWeight(5),
                    Text::make('Accessed via $this->param(\'id\')')->fontSize(12)->color('#6200EE')->fontWeight(5),
                )->fillWidth()->padding(20)->bg('#FFFFFF')->borderRadius(12)->gap(4),

                // Like counter
                Column::make(
                    Row::make(
                        Text::make("{$this->likes}")->fontSize(48)->fontWeight(7)->color('#E91E63')->textAlign(1),
                        Text::make('likes')->fontSize(16)->color('#666666'),
                    )->gap(8)->alignItems(1)->justifyContent(1),
                    Button::make('Like')->onPress('like')->color('#E91E63')->labelColor('#FFFFFF'),
                    Text::make('This state resets on back() — Detail is popped off the stack')->fontSize(11)->color('#999999')->textAlign(1),
                )->fillWidth()->padding(20)->bg('#FFFFFF')->borderRadius(12)->gap(12)->alignItems(1),

                // Navigate to Edit
                Column::make(
                    Text::make('Navigate forward with data:')->fontSize(14)->color('#666666'),
                    Text::make('$this->navigate(\'/edit\', [\'item\' => $id])')->fontSize(12)->color('#6200EE')->fontWeight(5),
                    Spacer::make()->height(4),
                    Button::make('Open Edit')->onPress('openEdit')->color('#FF5722')->labelColor('#FFFFFF'),
                )->fillWidth()->padding(20)->bg('#FFFFFF')->borderRadius(12)->gap(8),

            )->fillWidth()->padding(16)->gap(12),

          )->fillWidth()->safeArea(),
        )->fill()->bg('#F5F5F5');
    }
}