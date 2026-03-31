<div>
    @php
        $android = \Native\Mobile\Facades\System::isAndroid();
    @endphp
    <x-native-top-bar
        :title="$android ? ($title ?? 'Home') : ''"
        :show-navigation-icon="$android"
    >
        <x-native-top-bar-action
            id="home"
            icon="home"
            label="Home"
            :url="route('home')"
        />

        <x-native-top-bar-action
            id="docs"
            :icon="!$android ? 'book-open' : 'menu_book'"
            label="Docs"
            url="https://nativephp.com/docs/mobile/2/getting-started/introduction"
        />
    </x-native-top-bar>
    <x-native-side-nav
        :gestures-enabled="false">
        <x-native-side-nav-header
            title="NativePHP"
            subtitle="Kitchen Sink App"
            :show-close-button="true"
            :pinned="true"
        />
        <x-native-side-nav-group heading="Camera" :expanded="request()->routeIs('camera.*')">
            <x-native-side-nav-item :active="request()->routeIs('camera.camera')" id="camera-get-photo" icon="camera" :url="route('camera.camera')" label="Camera"/>
            <x-native-side-nav-item :active="request()->routeIs('camera.gallery')" id="camera-pick-images" icon="image-plus" :url="route('camera.gallery')" label="Gallery"/>
            <x-native-side-nav-item :active="request()->routeIs('camera.video')" id="camera-video" :icon="!$android ? 'video' : 'videocam'" :url="route('camera.video')" label="Video Recorder" badge="New!" badge-color="blue"/>
        </x-native-side-nav-group>
        <x-native-side-nav-group heading="Dialog" :expanded="request()->routeIs('dialog.*')">
            <x-native-side-nav-item :active="request()->routeIs('dialog.alert')" id="dialog-alert" :icon="!$android ? 'bell' : 'message'" :url="route('dialog.alert')" label="Alert"/>
            <x-native-side-nav-item :active="request()->routeIs('dialog.toast')" id="dialog-toast" :icon="!$android ? 'bolt' : 'flag'" :url="route('dialog.toast')" label="Toast"/>
        </x-native-side-nav-group>
        <x-native-side-nav-item :active="request()->routeIs('biometrics')" id="biometrics-demo" :icon="!$android ? 'die.face.5' : 'fingerprint'" :url="route('biometrics')" label="Biometrics"/>
        <x-native-side-nav-item :active="request()->routeIs('browser')" id="browser-demo" :icon="!$android ? 'person.line.dotted.person' : 'travel_explore'" :url="route('browser')" label="Browser"/>
        <x-native-side-nav-item :active="request()->routeIs('device')" id="device-demo" :icon="!$android ? 'shoeprints.fill' : 'app_shortcut'" :url="route('device')" label="Device Info"/>
        <x-native-side-nav-item :active="request()->routeIs('flashlight')" id="system-flashlight" :icon="!$android ? 'flashlight.on.fill' : 'flashlight_on'" :url="route('flashlight')" label="Flashlight"/>
        <x-native-side-nav-item :active="request()->routeIs('geolocation.getCurrent')" id="geolocation-get-current" icon="map" :url="route('geolocation.getCurrent')" label="Geolocation"/>
        <x-native-side-nav-item :active="request()->routeIs('haptics.vibrate')" id="haptics-vibrate" :icon="!$android ? 'vibrate' : 'vibration'" :url="route('haptics.vibrate')" label="Haptics"/>
        <x-native-side-nav-item :active="request()->routeIs('microphone')" id="microphone-demo" :icon="!$android ? 'microphone.circle' : 'app_shortcut'" :url="route('microphone')" label="Microphone" badge="New!" badge-color="blue"/>
        <x-native-side-nav-item :active="request()->routeIs('network')" id="network-demo" :icon="!$android ? 'globe' : 'network_check'" :url="route('network')" label="Network" badge="New!" badge-color="blue"/>
        <x-native-side-nav-item :active="request()->routeIs('local-notifications')" id="local-notifications-demo" :icon="!$android ? 'bell.badge' : 'notifications_active'" :url="route('local-notifications')" label="Local Notifications" badge="New!" badge-color="blue"/>
        <x-native-side-nav-item :active="request()->routeIs('scanner')" id="scanner-demo" :icon="!$android ? 'qrcode' : 'qr_code_scanner'" :url="route('scanner')" label="Scanner" badge="New!" badge-color="blue"/>
        <x-native-side-nav-item :active="request()->routeIs('secure-storage')" id="secure-storage-demo" icon="lock" :url="route('secure-storage')" label="Secure Storage"/>
        <x-native-side-nav-item :active="request()->routeIs('sleep-demo')" id="sleep-demo" :icon="!$android ? 'moon.zzz' : 'bedtime'" :url="route('sleep-demo')" label="Sleep Demo"/>
        <x-native-horizontal-divider />
        @if(app()->environment('local'))
            <x-native-side-nav-item :active="request()->routeIs('push-notifications')" id="push-notifications-demo" :icon="!$android ? 'bell' : 'circle_notifications'" :url="route('push-notifications')" label="Push Notifications"/>
            <x-native-side-nav-item :active="request()->routeIs('data-messages')" id="data-messages-demo" :icon="!$android ? 'envelope' : 'mail'" :url="route('data-messages')" label="Data Messages" badge="New!" badge-color="blue"/>
            <x-native-horizontal-divider />
        @endif
        <x-native-side-nav-group heading="Resources" :expanded="false">
            <x-native-side-nav-item id="docs" icon="book-open" url="https://nativephp.com/docs/mobile/1/getting-started/introduction" label="Docs"/>
            <x-native-side-nav-item id="learn-more" icon="information-circle" url="https://nativephp.com/mobile" label="Learn More"/>
        </x-native-side-nav-group>
    </x-native-side-nav>
    <x-native-bottom-nav>
        <x-native-bottom-nav-item
            id="scanner"
            label="Scanner"
            :url="route('scanner')"
            :icon="!$android ? 'qrcode' : 'qr_code_scanner'"
            :active="request()->routeIs('scanner')"
            :news="true"
        />
        <x-native-bottom-nav-item
            id="camera"
            label="Video"
            :url="route('camera.video')"
            :icon="!$android ? 'video' : 'videocam'"
            :active="request()->routeIs('camera.video')"
        />
        <x-native-bottom-nav-item
            id="microphone"
            label="Microphone"
            :url="route('microphone')"
            :icon="!$android ? 'microphone' : 'record_voice_over'"
            :active="request()->routeIs('microphone')"
        />
        <x-native-bottom-nav-item
            id="network"
            label="Network"
            :url="route('network')"
            :icon="!$android ? 'globe' : 'network_check'"
            :active="request()->routeIs('network')"
        />
    </x-native-bottom-nav>
</div>
