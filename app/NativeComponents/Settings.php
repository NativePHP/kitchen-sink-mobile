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
use Native\Mobile\Edge\Elements\TextInput;
use Native\Mobile\Edge\Elements\Toggle;
use Native\Mobile\Edge\NativeComponent;

class Settings extends NativeComponent
{
    public bool $pushEnabled = true;
    public bool $soundEnabled = true;
    public bool $badgeEnabled = false;
    public bool $locationTracking = false;
    public bool $analytics = true;
    public bool $crashReports = true;
    public string $username = 'shane';
    public int $saveCount = 0;

    public function togglePush(bool $v) { $this->pushEnabled = $v; }
    public function toggleSound(bool $v) { $this->soundEnabled = $v; }
    public function toggleBadge(bool $v) { $this->badgeEnabled = $v; }
    public function toggleLocation(bool $v) { $this->locationTracking = $v; }
    public function toggleAnalytics(bool $v) { $this->analytics = $v; }
    public function toggleCrash(bool $v) { $this->crashReports = $v; }

    public function onUsernameChange(string $text)
    {
        $this->username = $text;
    }

    public function save()
    {
        $this->saveCount++;
    }

    public function goBack()
    {
        $this->back();
    }

    public function render(): Element
    {
        return ScrollView::make(
            Column::make(
                // Header
                Row::make(
                    Button::make('< Back')->onPress('goBack')->color('#6200EE')->labelColor('#FFFFFF'),
                    Text::make('Settings')->fontSize(20)->fontWeight(6)->color('#1a1a2e'),
                    Spacer::make()->width(80),
                )->fillWidth()->padding(16, 16, 8, 16)->justifyContent(3)->alignItems(1),

                Divider::make()->fillWidth(),

                // Profile
                Column::make(
                    Text::make('Profile')->fontSize(16)->fontWeight(6)->color('#1a1a2e'),
                    Spacer::make()->height(4),
                    Text::make('Username')->fontSize(13)->color('#666666'),
                    TextInput::make()
                        ->value($this->username)
                        ->placeholder('Enter username...')
                        ->onChange('onUsernameChange')
                        ->fillWidth(),
                    Text::make("Current: @{$this->username}")->fontSize(12)->color('#6200EE'),
                )->fillWidth()->padding(16)->margin(0, 16, 8, 16)->bg('#FFFFFF')->borderRadius(12)->gap(6),

                // Notifications
                Column::make(
                    Text::make('Notifications')->fontSize(16)->fontWeight(6)->color('#1a1a2e'),
                    Spacer::make()->height(4),
                    $this->settingRow('Push notifications', $this->pushEnabled, 'togglePush'),
                    $this->settingRow('Sound', $this->soundEnabled, 'toggleSound'),
                    $this->settingRow('Badge count', $this->badgeEnabled, 'toggleBadge'),
                )->fillWidth()->padding(16)->margin(0, 16, 8, 16)->bg('#FFFFFF')->borderRadius(12)->gap(8),

                // Privacy
                Column::make(
                    Text::make('Privacy')->fontSize(16)->fontWeight(6)->color('#1a1a2e'),
                    Spacer::make()->height(4),
                    $this->settingRow('Location tracking', $this->locationTracking, 'toggleLocation'),
                    $this->settingRow('Analytics', $this->analytics, 'toggleAnalytics'),
                    $this->settingRow('Crash reports', $this->crashReports, 'toggleCrash'),
                )->fillWidth()->padding(16)->margin(0, 16, 8, 16)->bg('#FFFFFF')->borderRadius(12)->gap(8),

                // Save
                Column::make(
                    Button::make('Save Settings')->onPress('save')->color('#4CAF50')->labelColor('#FFFFFF'),
                    $this->saveCount > 0
                        ? Text::make("Saved {$this->saveCount} time(s) — state persists on back()")->fontSize(12)->color('#4CAF50')->textAlign(1)
                        : Text::make('Toggle settings and tap save — come back to see them preserved')->fontSize(12)->color('#999999')->textAlign(1),
                )->fillWidth()->padding(16)->margin(0, 16, 8, 16)->gap(8)->alignItems(1),

                Spacer::make()->height(32),

            )->fillWidth()->gap(0)->safeArea(),
        )->fill()->bg('#F5F5F5');
    }

    private function settingRow(string $label, bool $value, string $handler): Element
    {
        return Row::make(
            Text::make($label)->fontSize(15)->color('#1a1a2e'),
            Toggle::make()->value($value)->onChange($handler),
        )->fillWidth()->justifyContent(3)->alignItems(1);
    }
}