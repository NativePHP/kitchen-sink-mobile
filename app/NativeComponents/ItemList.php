<?php

namespace App\NativeComponents;

use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\Elements\Button;
use Native\Mobile\Edge\Elements\Column;
use Native\Mobile\Edge\Elements\Divider;
use Native\Mobile\Edge\Elements\Row;
use Native\Mobile\Edge\Elements\ScrollView;
use Native\Mobile\Edge\Elements\Spacer;
use Native\Mobile\Edge\Elements\Text;
use Native\Mobile\Edge\NativeComponent;

class ItemList extends NativeComponent
{
    private array $items = [
        ['id' => 1,  'title' => 'Shared Memory Architecture', 'tag' => 'Core',    'color' => '#6200EE'],
        ['id' => 2,  'title' => 'Binary Tree Serialization',  'tag' => 'Core',    'color' => '#6200EE'],
        ['id' => 3,  'title' => 'Event Loop & Condvars',      'tag' => 'Core',    'color' => '#6200EE'],
        ['id' => 4,  'title' => 'JNI Bridge Functions',       'tag' => 'Android', 'color' => '#4CAF50'],
        ['id' => 5,  'title' => 'Compose Renderer',           'tag' => 'Android', 'color' => '#4CAF50'],
        ['id' => 6,  'title' => 'Plugin System',              'tag' => 'Plugins', 'color' => '#FF5722'],
        ['id' => 7,  'title' => 'Bridge Function Registry',   'tag' => 'Plugins', 'color' => '#FF5722'],
        ['id' => 8,  'title' => 'EDGE Components',            'tag' => 'UI',      'color' => '#E91E63'],
        ['id' => 9,  'title' => 'Navigation & Routing',       'tag' => 'UI',      'color' => '#E91E63'],
        ['id' => 10, 'title' => 'Hot-Swap Navigation',        'tag' => 'UI',      'color' => '#E91E63'],
        ['id' => 11, 'title' => 'State Preservation',         'tag' => 'UI',      'color' => '#E91E63'],
        ['id' => 12, 'title' => 'Callback Registry',          'tag' => 'UI',      'color' => '#E91E63'],
    ];

    public function goBack()
    {
        $this->back();
    }

    public function open1()  { $this->navigate('/detail/1'); }
    public function open2()  { $this->navigate('/detail/2'); }
    public function open3()  { $this->navigate('/detail/3'); }
    public function open4()  { $this->navigate('/detail/4'); }
    public function open5()  { $this->navigate('/detail/5'); }
    public function open6()  { $this->navigate('/detail/6'); }
    public function open7()  { $this->navigate('/detail/7'); }
    public function open8()  { $this->navigate('/detail/8'); }
    public function open9()  { $this->navigate('/detail/9'); }
    public function open10() { $this->navigate('/detail/10'); }
    public function open11() { $this->navigate('/detail/11'); }
    public function open12() { $this->navigate('/detail/12'); }

    public function render(): Element
    {
        return Column::make(
          Column::make(
            // Header
            Row::make(
                Button::make('< Back')->onPress('goBack')->color('#6200EE')->labelColor('#FFFFFF'),
                Text::make('Items')->fontSize(20)->fontWeight(6)->color('#1a1a2e'),
                Spacer::make()->width(80),
            )->fillWidth()->padding(16, 16, 8, 16)->justifyContent(3)->alignItems(1),

            Divider::make()->fillWidth(),

            Column::make(
                Text::make('Tap any item to navigate to /detail/{id}')->fontSize(13)->color('#999999')->textAlign(1),
                Text::make('Each uses the same Detail component with different route params')->fontSize(12)->color('#999999')->textAlign(1),
            )->fillWidth()->padding(12, 16, 4, 16)->gap(2)->alignItems(1),

            // Item list
            ScrollView::make(
                Column::make(
                    ...array_merge($this->renderItems(), [
                        Spacer::make()->height(32),
                    ]),
                )->fillWidth()->padding(0, 16, 0, 16)->gap(8),
            )->fillHeight()->fillWidth(),

          )->fillWidth()->safeArea(),
        )->fill()->bg('#F5F5F5');
    }

    private function renderItems(): array
    {
        $rows = [];

        foreach ($this->items as $item) {
            $rows[] = Column::make(
                Row::make(
                    Column::make()
                        ->width(4)->height(32)->bg($item['color'])->borderRadius(2),
                    Column::make(
                        Text::make($item['title'])->fontSize(15)->fontWeight(5)->color('#1a1a2e'),
                        Row::make(
                            Text::make($item['tag'])->fontSize(11)->fontWeight(5)->color($item['color']),
                            Text::make("ID: {$item['id']}")->fontSize(11)->color('#999999'),
                        )->gap(8),
                    )->gap(2),
                )->fillWidth()->gap(12)->alignItems(1),
                Button::make("Open {$item['title']}")->onPress("open{$item['id']}")->color($item['color'])->labelColor('#FFFFFF'),
            )->fillWidth()->padding(14, 16, 14, 16)->bg('#FFFFFF')->borderRadius(10)->gap(10);
        }

        return $rows;
    }
}