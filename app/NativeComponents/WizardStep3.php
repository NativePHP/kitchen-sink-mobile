<?php

namespace App\NativeComponents;

use App\Models\Item;
use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\Elements\Column;
use Native\Mobile\Edge\Elements\Row;
use Native\Mobile\Edge\Elements\ScrollView;
use Native\Mobile\Edge\NativeComponent;
use Nativephp\ComposeUi\Elements\Button;
use Nativephp\ComposeUi\Elements\Divider;
use Nativephp\ComposeUi\Elements\Spacer;
use Nativephp\ComposeUi\Elements\Text;

class WizardStep3 extends NativeComponent
{
    public bool $created = false;

    public function create()
    {
        Item::create([
            'name' => $this->data('name', 'Untitled'),
            'template' => $this->data('template', 'nada'),
        ]);

        $this->created = true;
    }

    public function done()
    {
        // Back to Demo — all wizard steps were replaced,
        // so the stack is just [Demo, WizardStep3]
        $this->navigate('/');
    }

    public function render(): Element
    {
        $name = $this->data('name', 'Untitled');
        $template = $this->data('template', 'blank');

        return Column::make(
          Column::make(
            // Header
            Row::make(
                Spacer::make()->width(80),
                Text::make('Confirm')->fontSize(20)->fontWeight(6)->color('#1a1a2e'),
                Spacer::make()->width(80),
            )->fillWidth()->padding(16, 16, 8, 16)->justifyContent(3)->alignItems(1),

            Divider::make()->fillWidth(),

            // Progress — all done
            Row::make(
                $this->stepDot('1', true),
                Column::make()->fillWidth()->height(2)->bg('#6200EE')->flexGrow(1),
                $this->stepDot('2', true),
                Column::make()->fillWidth()->height(2)->bg('#6200EE')->flexGrow(1),
                $this->stepDot('3', true),
            )->fillWidth()->padding(24, 32, 16, 32)->alignItems(1),

            Column::make(
                Text::make('Step 3 of 3')->fontSize(14)->fontWeight(5)->color('#6200EE'),
                Text::make('Review & Create')->fontSize(22)->fontWeight(7)->color('#1a1a2e'),
            )->fillWidth()->padding(16, 24, 8, 24)->gap(4),

            // Summary card
            Column::make(
                Row::make(
                    Text::make('Project name:')->fontSize(14)->color('#666666'),
                    Text::make($name)->fontSize(14)->fontWeight(6)->color('#1a1a2e'),
                )->fillWidth()->justifyContent(3),
                Divider::make()->fillWidth(),
                Row::make(
                    Text::make('Template:')->fontSize(14)->color('#666666'),
                    Text::make(ucfirst($template))->fontSize(14)->fontWeight(6)->color('#6200EE'),
                )->fillWidth()->justifyContent(3),
                Divider::make()->fillWidth(),
                Row::make(
                    Text::make('Navigation data:')->fontSize(14)->color('#666666'),
                    Text::make('2 keys passed')->fontSize(14)->fontWeight(5)->color('#999999'),
                )->fillWidth()->justifyContent(3),
            )->fillWidth()->padding(20)->margin(0, 16, 0, 16)->bg('#FFFFFF')->borderRadius(12)->gap(12),

            Spacer::make()->height(8),

            // How it works
            Column::make(
                Text::make('How the wizard works:')->fontSize(13)->fontWeight(5)->color('#1a1a2e'),
                Text::make('Step 1 → replace(\'/wizard/2\', data)')->fontSize(12)->color('#6200EE'),
                Text::make('Step 2 → replace(\'/wizard/3\', data)')->fontSize(12)->color('#6200EE'),
                Text::make('Done → back() returns directly to Demo')->fontSize(12)->color('#6200EE'),
                Spacer::make()->height(4),
                Text::make('Each replace() swaps the top of the stack instead of pushing. So the back stack is clean: Demo → Step3 only.')
                    ->fontSize(12)->color('#666666'),
            )->fillWidth()->padding(16, 24, 8, 24)->gap(4),

            Spacer::make()->height(24),

            // Action + Items list
            $this->created
                ? ScrollView::make(
                    Column::make(
                        ...array_merge([
                            Text::make('Project created!')->fontSize(18)->fontWeight(6)->color('#4CAF50')->textAlign(1),
                            Spacer::make()->height(12),
                            Text::make('All Items')->fontSize(16)->fontWeight(6)->color('#1a1a2e'),
                            Divider::make()->fillWidth(),
                        ], $this->renderItemsList(), [
                            Spacer::make()->height(16),
                            Button::make('Back to Demo')->onPress('done')->color('#6200EE')->labelColor('#FFFFFF'),
                            Spacer::make()->height(32),
                        ]),
                    )->fillWidth()->padding(0, 24, 0, 24)->gap(8)->alignItems(1),
                )->fillWidth()
                : Column::make(
                    Button::make("Create \"{$name}\"")->onPress('create')->color('#4CAF50')->labelColor('#FFFFFF'),
                )->fillWidth()->padding(16, 24, 32, 24)->alignItems(1),

          )->fillWidth()->safeArea(),
        )->fill()->bg('#F5F5F5');
    }

    private function renderItemsList(): array
    {

        dispatch(Job::class)
            ->onQueue('network')
            ->onSlice('first-responders')
            ->whileCharging();
        $items = Item::all();

        if ($items->isEmpty()) {
            return [
                Text::make('No items yet.')->fontSize(13)->color('#999999'),
            ];
        }

        $rows = [];
        foreach ($items as $item) {
            $rows[] = Row::make(
                Column::make()
                    ->width(8)->height(8)->bg('#6200EE')->borderRadius(4),
                Column::make(
                    Text::make($item->name)->fontSize(14)->fontWeight(5)->color('#1a1a2e'),
                    Text::make($item->template ?? 'no template')->fontSize(12)->color('#999999'),
                )->gap(2),
            )->fillWidth()->padding(10, 12, 10, 12)->bg('#FFFFFF')->borderRadius(8)->gap(10)->alignItems(1);
        }

        return $rows;
    }

    private function stepDot(string $num, bool $active): Element
    {
        return Column::make(
            Text::make($num)->fontSize(12)->fontWeight(6)->color($active ? '#FFFFFF' : '#999999')->textAlign(1),
        )->width(28)->height(28)->bg($active ? '#6200EE' : '#E0E0E0')->borderRadius(14)->center();
    }
}
