<?php

namespace App\NativeComponents;

use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\Elements\Column;
use Native\Mobile\Edge\Elements\Row;
use Native\Mobile\Edge\Elements\ScrollView;
use Native\Mobile\Edge\NativeComponent;
use Nativephp\ComposeUi\Elements\Button;
use Nativephp\ComposeUi\Elements\Divider;
use Nativephp\ComposeUi\Elements\Spacer;
use Nativephp\ComposeUi\Elements\Text;

class WizardStep2 extends NativeComponent
{
    public string $selected = '';

    private array $templates = [
        ['key' => 'blank',     'label' => 'Blank',      'desc' => 'Empty project, start from scratch',        'icon' => '#9E9E9E'],
        ['key' => 'dashboard', 'label' => 'Dashboard',   'desc' => 'Admin panel with charts and tables',       'icon' => '#2196F3'],
        ['key' => 'social',    'label' => 'Social App',  'desc' => 'Feed, profiles, messaging',                'icon' => '#E91E63'],
        ['key' => 'ecommerce', 'label' => 'E-Commerce',  'desc' => 'Product catalog, cart, checkout',          'icon' => '#4CAF50'],
    ];

    public function selectBlank()     { $this->selected = 'blank'; }
    public function selectDashboard() { $this->selected = 'dashboard'; }
    public function selectSocial()    { $this->selected = 'social'; }
    public function selectEcommerce() { $this->selected = 'ecommerce'; }

    public function next()
    {
        if (strlen($this->selected) === 0) return;

        $this->replace('/wizard/3', [
            'name' => $this->data('name', ''),
            'template' => $this->selected,
        ]);
    }

    public function cancel()
    {
        // Back goes to Demo (step 1 was replaced, not pushed)
        $this->back();
    }

    public function render(): Element
    {
        $name = $this->data('name', 'Untitled');
        $hasSelection = strlen($this->selected) > 0;

        return Column::make(
          Column::make(
            // Header
            Row::make(
                Button::make('Cancel')->onPress('cancel')->color('#999999')->labelColor('#FFFFFF'),
                Text::make('Choose Template')->fontSize(20)->fontWeight(6)->color('#1a1a2e'),
                Spacer::make()->width(80),
            )->fillWidth()->padding(16, 16, 8, 16)->justifyContent(3)->alignItems(1),

            Divider::make()->fillWidth(),

            // Progress
            Row::make(
                $this->stepDot('1', true),
                Column::make()->fillWidth()->height(2)->bg('#6200EE')->flexGrow(1),
                $this->stepDot('2', true),
                Column::make()->fillWidth()->height(2)->bg('#E0E0E0')->flexGrow(1),
                $this->stepDot('3', false),
            )->fillWidth()->padding(24, 32, 16, 32)->alignItems(1),

            // Info
            Column::make(
                Text::make('Step 2 of 3')->fontSize(14)->fontWeight(5)->color('#6200EE'),
                Text::make("Project: \"{$name}\"")->fontSize(16)->color('#1a1a2e'),
                Text::make('Pick a starting template:')->fontSize(14)->color('#666666'),
            )->fillWidth()->padding(16, 24, 8, 24)->gap(4),

            // Template list + footer together in scroll
            ScrollView::make(
                Column::make(
                    ...array_merge($this->renderTemplates(), [
                        Spacer::make()->height(16),
                        Column::make(
                            Button::make($hasSelection ? "Next: Confirm ({$this->selected})" : 'Select a template')
                                ->onPress('next')
                                ->color($hasSelection ? '#6200EE' : '#CCCCCC')
                                ->labelColor('#FFFFFF'),
                            Spacer::make()->height(4),
                            Text::make('Step 1 was replaced — cancel goes directly to Demo')->fontSize(11)->color('#999999')->textAlign(1),
                        )->fillWidth()->gap(4)->alignItems(1),
                        Spacer::make()->height(32),
                    ]),
                )->fillWidth()->padding(0, 16, 0, 16)->gap(8),
            )->fillWidth(),

          )->fillWidth()->safeArea(),
        )->fill()->bg('#F5F5F5');
    }

    private function renderTemplates(): array
    {
        $cards = [];

        foreach ($this->templates as $t) {
            $isSelected = $this->selected === $t['key'];
            $handler = 'select'.ucfirst($t['key']);

            $cards[] = Column::make(
                Row::make(
                    Column::make()->width(40)->height(40)->bg($t['icon'])->borderRadius(8),
                    Column::make(
                        Text::make($t['label'])->fontSize(16)->fontWeight(5)->color('#1a1a2e'),
                        Text::make($t['desc'])->fontSize(13)->color('#666666'),
                    )->gap(2),
                )->fillWidth()->gap(12)->alignItems(1),
                $isSelected
                    ? Text::make('Selected')->fontSize(12)->fontWeight(6)->color('#6200EE')
                    : Button::make('Select')->onPress($handler)->color($t['icon'])->labelColor('#FFFFFF'),
            )->fillWidth()->padding(14, 16, 14, 16)
                ->bg($isSelected ? '#F3EEFF' : '#FFFFFF')
                ->border(2, $isSelected ? '#6200EE' : '#E0E0E0')
                ->borderRadius(12)->gap(10);
        }

        return $cards;
    }

    private function stepDot(string $num, bool $active): Element
    {
        return Column::make(
            Text::make($num)->fontSize(12)->fontWeight(6)->color($active ? '#FFFFFF' : '#999999')->textAlign(1),
        )->width(28)->height(28)->bg($active ? '#6200EE' : '#E0E0E0')->borderRadius(14)->center();
    }
}