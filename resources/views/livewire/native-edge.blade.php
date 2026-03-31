<div>
    <native:top-bar
        title="{{\Native\Mobile\Facades\System::isAndroid() ? $title ?? 'Home' : ''}}"
        show-navigation-icon="{{\Native\Mobile\Facades\System::isAndroid()}}"
    >
        <native:top-bar-action
            id="home"
            icon="home"
            label="Home"
            url="{{ route('home') }}"
        />

        <native:top-bar-action
            id="docs"
            icon="{{\Native\Mobile\Facades\System::isIos() ? 'book-open' : 'menu_book'}}"
            label="Docs"
            url="https://nativephp.com/docs/mobile/2/getting-started/introduction"
        />
    </native:top-bar>
    <native:side-nav
        :gestures_enabled="false">
        <native:side-nav-header
            title="NativePHP"
            subtitle="Kitchen Sink App"
            :show-close-button="true"
            pinned
        />
        <native:side-nav-group heading="Camera" :expanded="request()->routeIs('camera.*')">
            <native:side-nav-item active="{{ request()->routeIs('camera.camera') }}" id="camera-get-photo" icon="camera" url="{{ route('camera.camera') }}" label="Camera"/>
            <native:side-nav-item active="{{ request()->routeIs('camera.gallery') }}" id="camera-pick-images" icon="image-plus" url="{{ route('camera.gallery') }}" label="Gallery"/>
            <native:side-nav-item active="{{ request()->routeIs('camera.video') }}" id="camera-video" icon="{{\Native\Mobile\Facades\System::isIos() ? 'video' : 'videocam'}}" url="{{ route('camera.video') }}" label="Video Recorder" badge="New!" badge-color="blue"/>
        </native:side-nav-group>
        <native:side-nav-group heading="Dialog" :expanded="request()->routeIs('dialog.*')">
            <native:side-nav-item active="{{ request()->routeIs('dialog.alert') }}" id="dialog-alert" icon="{{\Native\Mobile\Facades\System::isIos() ? 'bell' : 'message'}}" url="{{ route('dialog.alert') }}" label="Alert"/>
            <native:side-nav-item active="{{ request()->routeIs('dialog.toast') }}" id="dialog-toast" icon="{{\Native\Mobile\Facades\System::isIos() ? 'bolt' : 'flag'}}" url="{{ route('dialog.toast') }}" label="Toast"/>
        </native:side-nav-group>
        <native:side-nav-item active="{{ request()->routeIs('biometrics') }}" id="biometrics-demo" icon="{{\Native\Mobile\Facades\System::isIos() ? 'die.face.5' : 'fingerprint'}}" url="{{ route('biometrics') }}" label="Biometrics"/>
        <native:side-nav-item active="{{ request()->routeIs('browser') }}" id="browser-demo" icon="{{\Native\Mobile\Facades\System::isIos() ? 'person.line.dotted.person' : 'travel_explore'}}" url="{{ route('browser') }}" label="Browser"/>
        <native:side-nav-item active="{{ request()->routeIs('device') }}" id="device-demo" icon="{{\Native\Mobile\Facades\System::isIos() ? 'shoeprints.fill' : 'app_shortcut'}}" url="{{ route('device') }}" label="Device Info"/>
        <native:side-nav-item active="{{ request()->routeIs('flashlight') }}" id="system-flashlight" icon="{{\Native\Mobile\Facades\System::isIos() ? 'flashlight.on.fill' : 'flashlight_on'}}" url="{{ route('flashlight') }}" label="Flashlight"/>
        <native:side-nav-item active="{{ request()->routeIs('geolocation.getCurrent') }}" id="geolocation-get-current" icon="map" url="{{ route('geolocation.getCurrent') }}" label="Geolocation"/>
        <native:side-nav-item active="{{ request()->routeIs('haptics.vibrate') }}" id="haptics-vibrate" icon="{{\Native\Mobile\Facades\System::isIos() ? 'vibrate' : 'vibration'}}" url="{{ route('haptics.vibrate') }}" label="Haptics"/>
        <native:side-nav-item active="{{ request()->routeIs('microphone') }}" id="microphone-demo" icon="{{\Native\Mobile\Facades\System::isIos() ? 'microphone.circle' : 'app_shortcut'}}" url="{{ route('microphone') }}" label="Microphone" badge="New!" badge-color="blue"/>
        <native:side-nav-item active="{{ request()->routeIs('network') }}" id="network-demo" icon="{{\Native\Mobile\Facades\System::isIos() ? 'globe' : 'network_check'}}" url="{{ route('network') }}" label="Network" badge="New!" badge-color="blue"/>
        <native:side-nav-item active="{{ request()->routeIs('push-notifications') }}" id="push-notifications-demo" icon="{{\Native\Mobile\Facades\System::isIos() ? 'bell' : 'circle_notifications'}}" url="{{ route('push-notifications') }}" label="Push Notifications"/>
        <native:side-nav-item active="{{ request()->routeIs('scanner') }}" id="scanner-demo" icon="{{\Native\Mobile\Facades\System::isIos() ? 'qrcode' : 'qr_code_scanner'}}" url="{{ route('scanner') }}" label="Scanner" badge="New!" badge-color="blue"/>
        <native:side-nav-item active="{{ request()->routeIs('secure-storage') }}" id="secure-storage-demo" icon="lock" url="{{ route('secure-storage') }}" label="Secure Storage"/>
        <native:horizontal-divider />
        <native:side-nav-group heading="Resources" :expanded="false">
            <native:side-nav-item id="docs" icon="book-open" url="https://nativephp.com/docs/mobile/1/getting-started/introduction" label="Docs"/>
            <native:side-nav-item id="learn-more" icon="information-circle" url="https://nativephp.com/mobile" label="Learn More"/>
        </native:side-nav-group>
    </native:side-nav>
    <native:bottom-nav>
        <native:bottom-nav-item
            id="scanner"
            label="Scanner"
            url="{{ route('scanner') }}"
            icon="{{\Native\Mobile\Facades\System::isIos() ? 'qrcode' : 'qr_code_scanner'}}"
            :active="request()->routeIs('scanner')"
            news="true"
        />
        <native:bottom-nav-item
            id="camera"
            label="Video"
            url="{{ route('camera.video') }}"
            icon="{{\Native\Mobile\Facades\System::isIos() ? 'video' : 'videocam'}}"
            :active="request()->routeIs('camera.video')"
        />
        <native:bottom-nav-item
            id="microphone"
            label="Microphone"
            url="{{ route('microphone') }}"
            icon="{{\Native\Mobile\Facades\System::isIos() ? 'microphone' : 'record_voice_over'}}"
            :active="request()->routeIs('microphone')"
        />
        <native:bottom-nav-item
            id="network"
            label="Network"
            url="{{ route('network') }}"
            icon="{{\Native\Mobile\Facades\System::isIos() ? 'globe' : 'network_check'}}"
            :active="request()->routeIs('network')"
        />
    </native:bottom-nav>

</div>
