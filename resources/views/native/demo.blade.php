@php
    // NativePHP brand palette
    $bg = $darkMode ? '#050714' : '#FFFFFF';
    $fg = $darkMode ? '#F8FAFC' : '#272d48';
    $muted = $darkMode ? '#94A3B8' : '#64748B';
    $card = $darkMode ? '#0F1629' : '#FFFFFF';
    $border = $darkMode ? '#1E293B' : '#E2E8F0';
    $accent = '#7C3AED';
    $accentText = $darkMode ? '#A78BFA' : '#7C3AED';
    $navy = '#272d48';
    $teal = $darkMode ? '#3edad7' : '#00aaa6';
    $indigo = $darkMode ? '#8696ed' : '#505b93';
@endphp

<native:scroll-view class="w-full h-full" :bg="$bg">
    <native:column class="w-full gap-0 safe-area">

        {{-- Header --}}
        <native:column class="w-full px-6 pt-6 pb-3 gap-2 items-center">
            <native:text class="text-3xl font-extrabold text-center" :color="$accentText">EDGE Component Demo</native:text>
            <native:text class="text-base text-center" :color="$muted">Every native UI element rendered from PHP</native:text>
        </native:column>

        {{-- 1. Text Styles --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">1. Text</native:text>
            <native:spacer class="h-2" />
            <native:column class="gap-1">
                <native:text class="text-lg font-thin" :color="$fg">Thin (1)</native:text>
                <native:text class="text-lg font-light" :color="$fg">Light (2)</native:text>
                <native:text class="text-lg font-normal" :color="$fg">Normal (3)</native:text>
                <native:text class="text-lg font-medium" :color="$fg">Medium (4)</native:text>
                <native:text class="text-lg font-semibold" :color="$indigo">SemiBold (5)</native:text>
                <native:text class="text-lg font-bold" :color="$accentText">Bold (6)</native:text>
                <native:text class="text-lg font-extrabold" :color="$teal">ExtraBold (7)</native:text>
            </native:column>
            <native:row class="w-full justify-between">
                <native:text class="text-lg" :color="$muted">Start</native:text>
                <native:text class="text-lg" :color="$muted">Center</native:text>
                <native:text class="text-lg" :color="$muted">End</native:text>
            </native:row>
            <native:text class="text-lg" :color="$muted" :maxLines="1">This text has maxLines set to 1 so it will be truncated with an ellipsis if it overflows the available space in the container</native:text>
            <native:text class="text-lg font-semibold" :color="$accentText" @press="tap">Tappable text — tap me!</native:text>
        </native:column>

        {{-- 2. Buttons --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">2. Buttons</native:text>
            <native:spacer class="h-2" />
            <native:row class="gap-2 justify-center">
                <native:button class="bg-[#272d48] rounded-full text-white text-lg" @press="tap">Tap Me</native:button>
                <native:button label="Long press" @press="tap" @longPress="longTap" color="#7C3AED" labelColor="#FFFFFF" />
            </native:row>
            <native:row class="gap-4 justify-center">
                <native:text class="text-lg font-semibold" :color="$accentText">Taps: {{ $tapCount }}</native:text>
                <native:text class="text-lg font-semibold" :color="$teal">Long: {{ $longPressCount }}</native:text>
            </native:row>
            <native:row class="gap-2 justify-center">
                <native:button label="Reset" @press="resetCounters" color="{{ $darkMode ? '#94A3B8' : '#64748B' }}" labelColor="#FFFFFF" />
                <native:button label="Disabled" disabled color="#CBD5E1" labelColor="#94A3B8" />
            </native:row>
        </native:column>

        {{-- 3. Text Input --}}
{{--        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">--}}
{{--            <native:text class="text-2xl font-bold" :color="$fg">3. Text Input</native:text>--}}
{{--            <native:text class="text-base" :color="$muted">Full M3 TextField — outlined/filled, label, icons, prefix/suffix, supporting, error, keyboard types</native:text>--}}
{{--            <native:spacer class="h-2" />--}}

{{--            --}}{{-- Interactive: onChange + onSubmit --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Live round-trip</native:text>--}}
{{--            <native:text-input class="w-full" :value="$inputText" label="Your text" placeholder="Type something..." :textColor="$fg" color="#7C3AED" @change="onType" @submit="onSubmit" />--}}
{{--            <native:row class="gap-2 items-center">--}}
{{--                <native:text class="text-base" :color="$muted">Live:</native:text>--}}
{{--                <native:text class="text-lg font-semibold" :color="strlen($inputText) > 0 ? $accentText : '#CBD5E1'">{{ strlen($inputText) > 0 ? strtoupper($inputText) : '(empty)' }}</native:text>--}}
{{--            </native:row>--}}
{{--            @if(strlen($submittedText) > 0)--}}
{{--                <native:text class="text-lg font-bold" :color="$teal">Submitted: {{ $submittedText }}</native:text>--}}
{{--            @else--}}
{{--                <native:text class="text-base" :color="$muted">Press Done/Enter to submit</native:text>--}}
{{--            @endif--}}

{{--            <native:divider class="w-full" />--}}

{{--            --}}{{-- Variants: Outlined vs Filled --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Variants</native:text>--}}
{{--            <native:text-input class="w-full" label="Outlined (default)" placeholder="This is the default..." :textColor="$fg" color="#7C3AED" />--}}
{{--            <native:text-input class="w-full" label="Filled variant" placeholder="Filled style..." :variant="1" :textColor="$fg" color="#7C3AED" :containerColor="$darkMode ? '#1A2332' : '#F1F5F9'" />--}}

{{--            <native:divider class="w-full" />--}}

{{--            --}}{{-- Label + Placeholder --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Floating label</native:text>--}}
{{--            <native:text-input class="w-full" label="Email address" placeholder="you@example.com" leadingIcon="email" :keyboard="2" :textColor="$fg" color="#7C3AED" />--}}

{{--            <native:divider class="w-full" />--}}

{{--            --}}{{-- Icons --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Leading & trailing icons</native:text>--}}
{{--            <native:text-input class="w-full" label="Search" placeholder="Search..." leadingIcon="search" :textColor="$fg" color="#7C3AED" />--}}
{{--            <native:text-input class="w-full" label="Password" placeholder="Enter password..." secure leadingIcon="lock" trailingIcon="visibility_off" :textColor="$fg" color="#7C3AED" />--}}

{{--            <native:divider class="w-full" />--}}

{{--            --}}{{-- Prefix & Suffix --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Prefix & suffix</native:text>--}}
{{--            <native:text-input class="w-full" label="Price" prefix="$" suffix=".00" :keyboard="5" :textColor="$fg" color="#7C3AED" />--}}
{{--            <native:text-input class="w-full" label="Website" prefix="https://" suffix=".com" :keyboard="4" :textColor="$fg" color="#7C3AED" />--}}

{{--            <native:divider class="w-full" />--}}

{{--            --}}{{-- Supporting text + Error state --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Supporting text & error</native:text>--}}
{{--            <native:text-input class="w-full" label="Username" supporting="Must be 3-20 characters" leadingIcon="person" :textColor="$fg" color="#7C3AED" />--}}
{{--            <native:text-input class="w-full" label="Email" value="not-an-email" isError supporting="Please enter a valid email address" leadingIcon="error" :textColor="$fg" />--}}

{{--            <native:divider class="w-full" />--}}

{{--            --}}{{-- Disabled & ReadOnly --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Disabled & read-only</native:text>--}}
{{--            <native:text-input class="w-full" label="Disabled field" value="Can't edit this" disabled :textColor="$fg" />--}}
{{--            <native:text-input class="w-full" label="Read-only field" value="Read but not edit" readOnly :textColor="$fg" color="#7C3AED" />--}}

{{--            <native:divider class="w-full" />--}}

{{--            --}}{{-- Max length --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Max length (10 chars)</native:text>--}}
{{--            <native:text-input class="w-full" label="Short code" placeholder="Max 10..." :maxLength="10" supporting="Limited to 10 characters" :textColor="$fg" color="#7C3AED" />--}}

{{--            <native:divider class="w-full" />--}}

{{--            --}}{{-- Multiline --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Multiline</native:text>--}}
{{--            <native:text-input class="w-full" label="Bio" placeholder="Tell us about yourself..." multiline :minLines="3" :maxLines="6" supporting="Min 3 lines, max 6 lines" :textColor="$fg" color="#7C3AED" />--}}

{{--            <native:divider class="w-full" />--}}

{{--            --}}{{-- Keyboard types --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Keyboard types</native:text>--}}
{{--            <native:text-input class="w-full" label="Number" placeholder="123" leadingIcon="pin" :keyboard="1" :textColor="$fg" color="#7C3AED" />--}}
{{--            <native:text-input class="w-full" label="Phone" placeholder="+1 (555) 000-0000" leadingIcon="phone" :keyboard="3" :textColor="$fg" color="#7C3AED" />--}}
{{--            <native:text-input class="w-full" label="Decimal" placeholder="0.00" :keyboard="5" :textColor="$fg" color="#7C3AED" />--}}

{{--            <native:divider class="w-full" />--}}

{{--            --}}{{-- Secure input --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Secure input</native:text>--}}
{{--            <native:text-input class="w-full" :value="$secureText" label="Password" placeholder="Enter password..." secure leadingIcon="lock" :textColor="$fg" color="#7C3AED" @change="onSecureType" />--}}

{{--            <native:button label="Clear all" @press="clearInput" color="{{ $darkMode ? '#94A3B8' : '#64748B' }}" labelColor="#FFFFFF" />--}}
{{--        </native:column>--}}

        {{-- 4. Toggle --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">3. Toggle</native:text>
            <native:spacer class="h-2" />
            <native:row class="w-full justify-between items-center">
                <native:text class="text-lg" :color="$fg">Dark mode</native:text>
                <native:toggle :value="$darkMode" @change="toggleDark" />
            </native:row>
            <native:row class="w-full justify-between items-center">
                <native:text class="text-lg" :color="$fg">Prompt for bio</native:text>
                <native:toggle :value="$notifications" @change="toggleNotifications" />
            </native:row>
            <native:row class="w-full justify-between items-center">
                <native:text class="text-lg" :color="$muted">Disabled toggle</native:text>
                <native:toggle :value="true" disabled />
            </native:row>
            <native:text class="text-base" :color="$muted">Dark: {{ $darkMode ? 'ON' : 'OFF' }} · Security: {{ $notifications ? 'ON' : 'OFF' }}</native:text>
        </native:column>

        {{-- 5. Checkbox --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">4. Checkbox</native:text>
            <native:spacer class="h-2" />
            <native:checkbox :value="$agreeTerms" label="I agree to the terms" :labelColor="$fg" @change="toggleTerms" />
            <native:checkbox :value="$newsletter" label="Subscribe to newsletter" :labelColor="$fg" @change="toggleNewsletter" />
            <native:checkbox :value="true" label="Disabled checkbox" :labelColor="$muted" disabled />
            <native:text class="text-base" :color="$muted">Terms: {{ $agreeTerms ? 'YES' : 'NO' }} · Newsletter: {{ $newsletter ? 'YES' : 'NO' }}</native:text>
        </native:column>

        {{-- 6. Slider --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">5. Slider</native:text>
            <native:spacer class="h-2" />
            <native:text class="text-lg" :color="$fg">Volume: {{ $volume }}</native:text>
            <native:slider class="w-full" :value="$volume" :min="0" :max="100" :step="1" @change="onVolumeChange" />
            <native:text class="text-lg" :color="$fg">Brightness: {{ $brightness }}</native:text>
            <native:slider class="w-full" :value="$brightness" :min="0" :max="1" :step="0.05" @change="onBrightnessChange" />
            <native:text class="text-base" :color="$muted">Disabled slider:</native:text>
            <native:slider class="w-full" :value="0.5" :min="0" :max="1" disabled />
        </native:column>

        {{-- 7. Progress Bar --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">6. Progress Bar</native:text>
            <native:spacer class="h-2" />
            <native:text class="text-lg" :color="$fg">Default ({{ round($brightness * 100) }}% — linked to brightness slider):</native:text>
            <native:progress-bar class="w-full" :value="$brightness" />
            <native:text class="text-lg" :color="$fg">Custom colors:</native:text>
            <native:progress-bar class="w-full" :value="0.75" color="{{ $teal }}" trackColor="{{ $darkMode ? '#0F2B2A' : '#F0FDFA' }}" />
            <native:progress-bar class="w-full" :value="0.33" color="{{ $accentText }}" trackColor="{{ $darkMode ? '#1E1338' : '#F5F3FF' }}" />
        </native:column>

        {{-- 8. Activity Indicator --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">7. Activity Indicator</native:text>
            <native:spacer class="h-2" />
            <native:row class="w-full gap-6 justify-center items-center">
                <native:column class="gap-1 items-center">
                    <native:activity-indicator size="small" color="#7C3AED" />
                    <native:text class="text-base" :color="$muted">Small</native:text>
                </native:column>
                <native:column class="gap-1 items-center">
                    <native:activity-indicator :color="$indigo" />
                    <native:text class="text-base" :color="$muted">Medium</native:text>
                </native:column>
                <native:column class="gap-1 items-center">
                    <native:activity-indicator size="large" :color="$teal" />
                    <native:text class="text-base" :color="$muted">Large</native:text>
                </native:column>
            </native:row>
        </native:column>

        {{-- 9. Image --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">8. Image</native:text>
            <native:spacer class="h-2" />
            <native:row class="w-full gap-2 justify-center items-center">
                <native:column class="gap-1 items-center">
                    <native:image class="w-[120] h-20 rounded-lg" src="https://picsum.photos/seed/nativephp1/240/160" />
                    <native:text class="text-base" :color="$muted">Fit (default)</native:text>
                </native:column>
                <native:column class="gap-1 items-center">
                    <native:image class="w-20 h-20 rounded-[40]" src="https://picsum.photos/seed/nativephp2/160/160" :fit="2" />
                    <native:text class="text-base" :color="$muted">Crop circle</native:text>
                </native:column>
                <native:column class="gap-1 items-center">
                    <native:image class="w-20 h-20 rounded-lg" src="https://picsum.photos/seed/nativephp3/160/160" :fit="2" />
                    <native:text class="text-base" :color="$muted">Crop rounded</native:text>
                </native:column>
            </native:row>
            <native:text class="text-base" :color="$muted">Images loaded from picsum.photos with seeded URLs</native:text>
        </native:column>

        {{-- 10. Radio Group --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">9. Radio Group</native:text>
            <native:spacer class="h-2" />
            <native:text class="text-lg" :color="$fg">Select size:</native:text>
            <native:radio-group class="w-full" :value="$selectedSize" @change="onSizeChange">
                <native:radio radioValue="small" label="Small" :labelColor="$fg" />
                <native:radio radioValue="medium" label="Medium" :labelColor="$fg" />
                <native:radio radioValue="large" label="Large" :labelColor="$fg" />
                <native:radio radioValue="xl" label="Extra Large" :labelColor="$muted" disabled />
            </native:radio-group>
            <native:text class="text-base" :color="$muted">Selected: {{ $selectedSize }}</native:text>
        </native:column>

        {{-- 11. Select (Dropdown) --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">10. Select</native:text>
            <native:spacer class="h-2" />
            <native:select class="w-full" :value="$selectedColor" placeholder="Choose a color..." :options="['Red', 'Green', 'Blue', 'Purple', 'Orange']" @change="onColorChange" />
            <native:text class="text-base" :color="$muted">Selected: {{ $selectedColor ?: '(none)' }}</native:text>
            <native:text class="text-base" :color="$muted">Disabled select:</native:text>
            <native:select class="w-full" value="Locked" :options="['Locked']" disabled />
        </native:column>

        {{-- 12. Icon --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">11. Icon</native:text>
            <native:spacer class="h-2" />
            <native:row class="w-full gap-4 justify-center items-center">
                <native:icon name="home" :size="32" color="#7C3AED" />
                <native:icon name="star" :size="32" :color="$teal" />
                <native:icon name="heart" :size="32" :color="$indigo" />
                <native:icon name="search" :size="32" :color="$fg" />
                <native:icon name="settings" :size="32" :color="$muted" />
            </native:row>
        </native:column>

        {{-- 13. Badge --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">12. Badge</native:text>
            <native:spacer class="h-2" />
            <native:row class="w-full gap-4 justify-center items-center">
                <native:row class="gap-2 items-center">
                    <native:text class="text-lg" :color="$fg">Messages</native:text>
                    <native:badge :count="3" />
                </native:row>
                <native:row class="gap-2 items-center">
                    <native:text class="text-lg" :color="$fg">Alerts</native:text>
                    <native:badge :count="42" :color="$teal" />
                </native:row>
                <native:row class="gap-2 items-center">
                    <native:text class="text-lg" :color="$fg">Overflow</native:text>
                    <native:badge :count="150" color="#7C3AED" />
                </native:row>
            </native:row>
        </native:column>

        {{-- 14. Row & Column Layout --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">13. Row & Column</native:text>
            <native:spacer class="h-2" />
            <native:text class="text-base" :color="$muted">Row with gap + center:</native:text>
            <native:row class="w-full gap-2 justify-center">
                <native:column class="w-10 h-10 bg-[#272d48] rounded-lg" />
                <native:column class="w-10 h-10 bg-[#505b93] rounded-lg" />
                <native:column class="w-10 h-10 bg-[#7C3AED] rounded-lg" />
                <native:column class="w-10 h-10 bg-[#00aaa6] rounded-lg" />
            </native:row>
            <native:text class="text-base" :color="$muted">Row with space-between:</native:text>
            <native:row class="w-full justify-between">
                <native:column class="w-10 h-10 bg-[#272d48] rounded-lg" />
                <native:column class="w-10 h-10 bg-[#7C3AED] rounded-lg" />
                <native:column class="w-10 h-10 bg-[#00aaa6] rounded-lg" />
            </native:row>
            <native:text class="text-base" :color="$muted">Row with space-evenly:</native:text>
            <native:row class="w-full justify-evenly">
                <native:column class="w-10 h-10 bg-[#272d48] rounded-lg" />
                <native:column class="w-10 h-10 bg-[#505b93] rounded-lg" />
                <native:column class="w-10 h-10 bg-[#00aaa6] rounded-lg" />
            </native:row>
        </native:column>

        {{-- 15. Stack (overlay) --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">14. Stack</native:text>
            <native:spacer class="h-2" />
            <native:stack class="w-full h-[100] items-center justify-center">
                <native:column class="w-[200] h-[100] bg-[#272d48] rounded-xl" />
                <native:column class="w-[150] h-[75] bg-[#505b93] rounded-xl" />
                <native:column class="w-[100] h-[50] bg-[#7C3AED] rounded-xl" />
            </native:stack>
        </native:column>

        {{-- 16. Styling --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">15. Styling</native:text>
            <native:spacer class="h-2" />
            <native:row class="w-full gap-2 justify-center">
                <native:column class="w-20 h-[50] bg-[#272d48] rounded-2xl" center>
                    <native:text class="text-base text-white text-center">Rounded</native:text>
                </native:column>
                <native:column class="w-20 h-[50] border-2 border-[#7C3AED] rounded-lg" center>
                    <native:text class="text-base text-[#7C3AED] text-center">Border</native:text>
                </native:column>
                <native:column class="w-20 h-[50] bg-[#505b93] rounded-lg opacity-50" center>
                    <native:text class="text-base text-white text-center">50%</native:text>
                </native:column>
            </native:row>
            <native:row class="w-full gap-2 justify-center">
                <native:column class="w-[100] h-[50] shadow-lg rounded-lg" :bg="$card" center>
                    <native:text class="text-base text-center" :color="$fg">Elevated</native:text>
                </native:column>
                <native:column class="w-[100] h-10 bg-[#00aaa6] rounded-[20]" center>
                    <native:text class="text-base text-white text-center">Pill</native:text>
                </native:column>
            </native:row>
        </native:column>

        {{-- 17. Divider & Spacer --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">16. Divider & Spacer</native:text>
            <native:spacer class="h-2" />
            <native:text class="text-lg" :color="$fg">Above divider</native:text>
            <native:divider class="w-full" />
            <native:text class="text-lg" :color="$fg">Below divider</native:text>
            <native:text class="text-base" :color="$muted">Below is a 32dp spacer:</native:text>
            <native:spacer class="h-8" />
            <native:text class="text-lg" :color="$fg">After the spacer</native:text>
        </native:column>

        {{-- 18. Horizontal Scroll --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">17. Horizontal Scroll</native:text>
            <native:spacer class="h-2" />
            <native:scroll-view horizontal>
                <native:row class="gap-2">
                    @foreach(['#272d48', '#505b93', '#7C3AED', '#A78BFA', '#00aaa6', '#3edad7', '#8696ed', '#64748B'] as $color)
                        <native:column class="w-20 h-20 rounded-lg" :bg="$color" />
                    @endforeach
                </native:row>
            </native:scroll-view>
        </native:column>

        {{-- 20. Form Validation (@nativeError directive) --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">18. Form Validation</native:text>
            <native:text class="text-base" :color="$muted">@@nativeError directive — inline error text from $errors</native:text>
            <native:spacer class="h-2" />

            <native:text class="text-lg font-semibold" :color="$fg">Name</native:text>
            <native:text-input class="w-full" :value="$formName" placeholder="Enter your name..." :textColor="$fg" color="#7C3AED" @change="onFormName" />
            @nativeError('name')

            <native:text class="text-lg font-semibold" :color="$fg">Email</native:text>
            <native:text-input class="w-full" :value="$formEmail" placeholder="you@example.com" :textColor="$fg" color="#7C3AED" @change="onFormEmail" :keyboard="2" />
            @nativeError('email', '#EF4444')

            <native:row class="gap-2 justify-center">
                <native:button label="Submit" @press="submitForm" color="#272d48" labelColor="#FFFFFF" />
                <native:button label="Reset" @press="resetForm" color="{{ $darkMode ? '#94A3B8' : '#64748B' }}" labelColor="#FFFFFF" />
            </native:row>

            @if($formSubmitted)
                <native:column class="w-full p-3 rounded-lg gap-1" :bg="$darkMode ? '#0D2818' : '#ECFDF5'">
                    <native:text class="text-lg font-bold" :color="$teal">Form submitted!</native:text>
                    <native:text class="text-base" :color="$teal">Name: {{ $formName }} · Email: {{ $formEmail }}</native:text>
                </native:column>
            @endif

            <native:text class="text-base" :color="$muted">Try submitting empty, short name, or email without @@</native:text>
        </native:column>

        {{-- 21. Card --}}
{{--        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">--}}
{{--            <native:text class="text-2xl font-bold" :color="$fg">21. Card</native:text>--}}
{{--            <native:spacer class="h-2" />--}}
{{--            <native:card class="w-full" :variant="0">--}}
{{--                <native:column class="p-4 gap-1">--}}
{{--                    <native:text class="text-lg font-semibold" :color="$fg">Filled Card</native:text>--}}
{{--                    <native:text class="text-base" :color="$muted">Default M3 filled card style</native:text>--}}
{{--                </native:column>--}}
{{--            </native:card>--}}
{{--            <native:card class="w-full" :variant="1">--}}
{{--                <native:column class="p-4 gap-1">--}}
{{--                    <native:text class="text-lg font-semibold" :color="$fg">Outlined Card</native:text>--}}
{{--                    <native:text class="text-base" :color="$muted">Card with border outline</native:text>--}}
{{--                </native:column>--}}
{{--            </native:card>--}}
{{--            <native:card class="w-full" :variant="2">--}}
{{--                <native:column class="p-4 gap-1">--}}
{{--                    <native:text class="text-lg font-semibold" :color="$fg">Elevated Card</native:text>--}}
{{--                    <native:text class="text-base" :color="$muted">Card with shadow elevation</native:text>--}}
{{--                </native:column>--}}
{{--            </native:card>--}}
{{--            <native:card class="w-full" :variant="0" @press="tap">--}}
{{--                <native:column class="p-4 gap-1">--}}
{{--                    <native:text class="text-lg font-semibold" :color="$accentText">Tappable Card</native:text>--}}
{{--                    <native:text class="text-base" :color="$muted">Cards support @press too</native:text>--}}
{{--                </native:column>--}}
{{--            </native:card>--}}
{{--        </native:column>--}}

        {{-- 22. List Item --}}
{{--        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">--}}
{{--            <native:text class="text-2xl font-bold" :color="$fg">22. List Item</native:text>--}}
{{--            <native:text class="text-base" :color="$muted">M3 spec — leading/trailing content types, callbacks, styling, elevation</native:text>--}}
{{--            <native:spacer class="h-2" />--}}

{{--            --}}{{-- Basic --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Basic</native:text>--}}
{{--            <native:list-item class="w-full" headline="Simple headline" headlineColor="{{ $fg }}" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="With supporting text" supporting="Secondary text below the headline" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="With overline" supporting="Supporting text" overline="CATEGORY" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" overlineColor="{{ $accentText }}" />--}}

{{--            <native:divider class="w-full" />--}}
{{--            <native:spacer class="h-2" />--}}

{{--            --}}{{-- Leading content types --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Leading content</native:text>--}}
{{--            <native:list-item class="w-full" headline="Leading icon" supporting="Material icon in leading slot" leadingIcon="person" trailingIcon="chevron_right" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" leadingIconColor="{{ $accentText }}" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Avatar" supporting="40dp circle from URL" leadingAvatar="https://i.pravatar.cc/80?img=3" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Monogram" supporting="Initials in a colored circle" leadingMonogram="SR" leadingMonogramColor="{{ $accent }}" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Image thumbnail" supporting="56dp rounded rect from URL" leadingImage="https://picsum.photos/seed/listdemo/112/112" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Leading checkbox" supporting="{{ $listCheckbox ? 'Checked' : 'Unchecked' }}" :leadingCheckbox="$listCheckbox" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" @leadingChange="onListCheckbox" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Leading radio" supporting="{{ $listRadio ? 'Selected' : 'Not selected' }}" :leadingRadio="$listRadio" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" @leadingChange="onListRadio" />--}}

{{--            <native:divider class="w-full" />--}}
{{--            <native:spacer class="h-2" />--}}

{{--            --}}{{-- Trailing content types --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Trailing content</native:text>--}}
{{--            <native:list-item class="w-full" headline="Trailing icon" leadingIcon="mail" trailingIcon="chevron_right" headlineColor="{{ $fg }}" trailingIconColor="{{ $muted }}" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Trailing text" supporting="Metadata in trailing slot" leadingIcon="event" trailingText="Mar 15" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" trailingTextColor="{{ $muted }}" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Trailing checkbox" supporting="{{ $listTrailingCheckbox ? 'Enabled' : 'Disabled' }}" leadingIcon="notifications" :trailingCheckbox="$listTrailingCheckbox" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" @trailingChange="onListTrailingCheckbox" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Trailing switch" supporting="{{ $listSwitch ? 'ON' : 'OFF' }}" leadingIcon="wifi" :trailingSwitch="$listSwitch" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" @trailingChange="onListSwitch" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Trailing icon button" supporting="Taps: {{ $trailingPressCount }}" leadingIcon="share" trailingIconButton="more_vert" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" @trailingPress="onTrailingPress" />--}}

{{--            <native:divider class="w-full" />--}}
{{--            <native:spacer class="h-2" />--}}

{{--            --}}{{-- Styling --}}
{{--            <native:text class="text-lg font-semibold" :color="$fg">Styling & states</native:text>--}}
{{--            <native:list-item class="w-full" headline="Container color" supporting="Tinted background" leadingIcon="palette" containerColor="{{ $darkMode ? '#1A1A2E' : '#F5F3FF' }}" headlineColor="{{ $accentText }}" supportingColor="{{ $muted }}" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Tonal elevation" supporting="2dp tonal + 1dp shadow" leadingIcon="layers" :tonalElevation="2" :shadowElevation="1" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Disabled item" supporting="Interactions blocked" leadingIcon="block" trailingIcon="chevron_right" headlineColor="{{ $muted }}" supportingColor="{{ $muted }}" disabled />--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:list-item class="w-full" headline="Tap + long press" supporting="Tap: {{ $tapCount }} · Long: {{ $longPressCount }}" leadingIcon="touch_app" trailingIcon="chevron_right" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" @press="tap" @longPress="longTap" />--}}
{{--        </native:column>--}}

        {{-- 23. Tabs --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">19. Tabs</native:text>
            <native:spacer class="h-2" />
            <native:tab-row class="w-full" :selectedIndex="$selectedTab" @change="onTabChange">
                <native:tab label="Home" icon="home" />
                <native:tab label="Search" icon="search" />
                <native:tab label="Profile" icon="person" />
            </native:tab-row>
            <native:column class="p-3 gap-1">
                @if($selectedTab === 0)
                    <native:text class="text-lg font-semibold" :color="$fg">Home tab selected</native:text>
                    <native:text class="text-base" :color="$muted">Welcome to the home tab!</native:text>
                @elseif($selectedTab === 1)
                    <native:text class="text-lg font-semibold" :color="$fg">Search tab selected</native:text>
                    <native:text class="text-base" :color="$muted">Search for something...</native:text>
                @else
                    <native:text class="text-lg font-semibold" :color="$fg">Profile tab selected</native:text>
                    <native:text class="text-base" :color="$muted">Your profile info here</native:text>
                @endif
            </native:column>
            <native:text class="text-base" :color="$muted">Selected tab index: {{ $selectedTab }}</native:text>
        </native:column>

        {{-- 24. Bottom Sheet --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">20. Bottom Sheet</native:text>
            <native:spacer class="h-2" />
            <native:button @press="showSheet" class="bg-[#272d48] text-white w-full rounded-full">Open Bottom Sheet</native:button>
            <native:text class="text-base" :color="$muted">Sheet visible: {{ $sheetVisible ? 'YES' : 'NO' }}</native:text>
            <native:bottom-sheet :visible="$sheetVisible" @dismiss="hideSheet">
                <native:column class="w-full p-6 gap-3 rounded-t-2xl" :bg="$card">
                    <native:row class="w-full justify-center">
                        <native:column class="w-10 h-1 rounded-full" :bg="$darkMode ? '#334155' : '#CBD5E1'" />
                    </native:row>
                    <native:text class="text-2xl font-bold" :color="$fg">Bottom Sheet Content</native:text>
                    <native:text class="text-lg" :color="$muted">This is a modal bottom sheet. Swipe down or tap outside to dismiss.</native:text>
                    <native:divider class="w-full" />
                    <native:list-item class="w-full" headline="Option 1" supporting="First option" leadingAvatar="https://i.pravatar.cc/80?img=5" trailingText="Just now" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" trailingTextColor="{{ $muted }}" />
                    <native:list-item class="w-full" headline="Option 2" supporting="Second option" leadingMonogram="AB" leadingMonogramColor="{{ $teal }}" trailingIcon="chevron_right" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" />
                    <native:list-item class="w-full" headline="Option 3" supporting="Third option" leadingIcon="settings" trailingIconButton="more_vert" headlineColor="{{ $fg }}" supportingColor="{{ $muted }}" @trailingPress="onTrailingPress" />
                    <native:spacer class="h-4" />
                    <native:button label="Close Sheet" @press="hideSheet" color="#7C3AED" labelColor="#FFFFFF" />
                </native:column>
            </native:bottom-sheet>
        </native:column>

        {{-- 25. Reusable Partials (@include) --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            @include('native.partials.card-header', ['number' => '25', 'title' => 'Reusable Partials', 'subtitle' => '@include for DRY templates — renders inline, stack stays balanced', 'fg' => $fg, 'muted' => $muted])

            <native:text class="text-base" :color="$muted">These status dots are rendered via @@include partials:</native:text>
            <native:row class="gap-4 justify-center">
                @include('native.partials.status-dot', ['dotColor' => $teal, 'dotLabel' => 'Online'])
                @include('native.partials.status-dot', ['dotColor' => '#F59E0B', 'dotLabel' => 'Away'])
                @include('native.partials.status-dot', ['dotColor' => '#EF4444', 'dotLabel' => 'Offline'])
            </native:row>

            <native:divider class="w-full" />
            <native:text class="text-base" :color="$muted">The card header above was also rendered via @@include — same partial, different data:</native:text>
            <native:column class="w-full p-3 rounded-lg gap-2" :bg="$darkMode ? '#1A2332' : '#F1F5F9'">
                @include('native.partials.card-header', ['number' => 'X', 'title' => 'Nested Example', 'subtitle' => 'Same partial, different data', 'fg' => $fg, 'muted' => $muted])
                <native:text class="text-base" :color="$fg">Works at any nesting depth.</native:text>
            </native:column>
        </native:column>

        {{-- 26. Chip (UI Plugin) --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">21. Chip (Plugin)</native:text>
            <native:spacer class="h-2" />
            <native:row class="gap-2 justify-center">
                <native:chip label="Featured" :selected="$chipA" icon="star" @change="toggleChipA" />
                <native:chip label="Popular" :selected="$chipB" icon="trending_up" @change="toggleChipB" />
                <native:chip label="New" :selected="$chipC" @change="toggleChipC" />
            </native:row>
            <native:text class="text-base" :color="$muted">Featured: {{ $chipA ? 'ON' : 'OFF' }} · Popular: {{ $chipB ? 'ON' : 'OFF' }} · New: {{ $chipC ? 'ON' : 'OFF' }}</native:text>
        </native:column>

        {{-- 19. Navigation --}}
        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">
            <native:text class="text-2xl font-bold" :color="$fg">22. Navigation</native:text>
            <native:text class="text-base" :color="$muted">navigate(), back(), replace(), exitToWeb()</native:text>
            <native:divider class="w-full" />
            <native:text class="text-lg font-semibold" :color="$fg">Wizard — replace() for linear flows</native:text>
            <native:button @press="openWizard" class="bg-[#272d48] text-white w-full rounded-full text-lg">Start Wizard</native:button>
        </native:column>

        {{-- 27. Button Group (Segmented Buttons) --}}
{{--        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">--}}
{{--            <native:text class="text-2xl font-bold" :color="$fg">27. Button Group</native:text>--}}
{{--            <native:spacer class="h-2" />--}}
{{--            <native:button-group :options="['Day', 'Week', 'Month']" :selectedIndex="$selectedSegment" @change="onSegmentChange" />--}}
{{--            <native:text class="text-base" :color="$muted">Selected: {{ ['Day', 'Week', 'Month'][$selectedSegment] ?? '?' }} (index {{ $selectedSegment }})</native:text>--}}
{{--            <native:text class="text-base" :color="$muted">Disabled button group:</native:text>--}}
{{--            <native:button-group :options="['On', 'Off']" :selectedIndex="0" disabled />--}}
{{--        </native:column>--}}

{{--        --}}{{-- 28. Carousel --}}
{{--        <native:column class="w-full p-4 mx-4 mb-3 rounded-2xl gap-3 border border-[{{ $border }}]" :bg="$card">--}}
{{--            <native:text class="text-2xl font-bold" :color="$fg">28. Carousel</native:text>--}}
{{--            <native:spacer class="h-2" />--}}
{{--            <native:text class="text-base" :color="$muted">Multi-browse (default):</native:text>--}}
{{--            <native:carousel item-width="200" item-spacing="8">--}}
{{--                @foreach(['nativephp4', 'nativephp5', 'nativephp6', 'nativephp7', 'nativephp8'] as $seed)--}}
{{--                    <native:image class="w-[200] h-[150] rounded-2xl" src="https://picsum.photos/seed/{{ $seed }}/400/300" />--}}
{{--                @endforeach--}}
{{--            </native:carousel>--}}
{{--            <native:spacer class="h-2" />--}}
{{--            <native:text class="text-base" :color="$muted">Uncontained variant:</native:text>--}}
{{--            <native:carousel item-width="150" item-spacing="8" variant="uncontained">--}}
{{--                @foreach(['carousel1', 'carousel2', 'carousel3', 'carousel4', 'carousel5'] as $seed)--}}
{{--                    <native:image class="w-[150] h-[150] rounded-2xl" src="https://picsum.photos/seed/{{ $seed }}/300/300" />--}}
{{--                @endforeach--}}
{{--            </native:carousel>--}}
{{--        </native:column>--}}

        {{-- Footer --}}
{{--        <native:column class="w-full pt-4 px-6 pb-8 gap-2 items-center">--}}
{{--            <native:divider class="w-full" />--}}
{{--            <native:text class="text-base text-center" :color="$muted">End of EDGE demo — 28 components</native:text>--}}
{{--            <native:text class="text-base text-center" :color="$muted">All UI rendered natively via shared memory</native:text>--}}
{{--        </native:column>--}}

    </native:column>
</native:scroll-view>
