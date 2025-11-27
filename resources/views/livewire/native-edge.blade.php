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
            icon="book-open"
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
            :pinned="true"
        />
        <native:side-nav-group heading="Camera" :expanded="request()->routeIs('camera.*')">
            <native:side-nav-item active="{{ request()->routeIs('camera.camera') }}" id="camera-get-photo" icon="camera" url="{{ route('camera.camera') }}" label="Camera"/>
            <native:side-nav-item active="{{ request()->routeIs('camera.galler') }}" id="camera-pick-images" icon="image-plus" url="{{ route('camera.gallery') }}" label="Gallery"/>
            <native:side-nav-item active="{{ request()->routeIs('camera.video') }}" id="camera-video" icon="video" url="{{ route('camera.video') }}" label="Video Recorder" badge="New!" badge-color="blue"/>
        </native:side-nav-group>
        <native:side-nav-group heading="Dialog" :expanded="request()->routeIs('dialog.*')">
            <native:side-nav-item active="{{ request()->routeIs('dialog.alert') }}" id="dialog-alert" icon="bell" url="{{ route('dialog.alert') }}" label="Alert"/>
            <native:side-nav-item active="{{ request()->routeIs('dialog.toast') }}" id="dialog-toast" icon="bolt" url="{{ route('dialog.toast') }}" label="Toast"/>
        </native:side-nav-group>
        <native:side-nav-item active="{{ request()->routeIs('biometrics') }}" id="biometrics-demo" icon="finger-print" url="{{ route('biometrics') }}" label="Biometrics"/>
        <native:side-nav-item active="{{ request()->routeIs('browser') }}" id="browser-demo" icon="globe-alt" url="{{ route('browser') }}" label="Browser"/>
        <native:side-nav-item active="{{ request()->routeIs('device') }}" id="device-demo" icon="device-phone-mobile" url="{{ route('device') }}" label="Device Info"/>
        <native:side-nav-item active="{{ request()->routeIs('flashlight') }}" id="system-flashlight" icon="lightbulb" url="{{ route('flashlight') }}" label="Flashlight"/>
        <native:side-nav-item active="{{ request()->routeIs('geolocation.getCurrent') }}" id="geolocation-get-current" icon="map" url="{{ route('geolocation.getCurrent') }}" label="Geolocation"/>
        <native:side-nav-item active="{{ request()->routeIs('haptics.vibrate') }}" id="haptics-vibrate" icon="vibrate" url="{{ route('haptics.vibrate') }}" label="Haptics"/>
        <native:side-nav-item active="{{ request()->routeIs('microphone') }}" id="microphone-demo" icon="microphone" url="{{ route('microphone') }}" label="Microphone" badge="New!" badge-color="blue"/>
        <native:side-nav-item active="{{ request()->routeIs('network') }}" id="network-demo" icon="globe" url="{{ route('network') }}" label="Network" badge="New!" badge-color="blue"/>
        <native:side-nav-item active="{{ request()->routeIs('push-notifications') }}" id="push-notifications-demo" icon="bell" url="{{ route('push-notifications') }}" label="Push Notifications"/>
        <native:side-nav-item active="{{ request()->routeIs('scanner') }}" id="scanner-demo" icon="qrcode" url="{{ route('scanner') }}" label="Scanner" badge="New!" badge-color="blue"/>
        <native:side-nav-item active="{{ request()->routeIs('secure-storage') }}" id="secure-storage-demo" icon="folder-lock" url="{{ route('secure-storage') }}" label="Secure Storage"/>
        <native:horizontal-divider />
        <native:side-nav-group heading="Resources" :expanded="false">
            <native:side-nav-item id="docs" icon="book-open" url="https://nativephp.com/docs/mobile/1/getting-started/introduction" label="Docs"/>
            <native:side-nav-item id="learn-more" icon="information-circle" url="https://nativephp.com/mobile" label="Learn More"/>
        </native:side-nav-group>
    </native:side-nav>
    <native:bottom-nav label-visibility="labeled">
        <native:bottom-nav-item
            id="scanner"
            label="Scanner"
            url="{{ route('scanner') }}"
            icon="qrcode"
            :active="request()->routeIs('scanner')"
            news="true"
        />
        <native:bottom-nav-item
            id="camera"
            label="Video"
            url="{{ route('camera.video') }}"
            icon="video"
            :active="request()->routeIs('camera.video')"
        />
        <native:bottom-nav-item
            id="microphone"
            label="Microphone"
            url="{{ route('microphone') }}"
            icon="microphone"
            :active="request()->routeIs('microphone')"
        />
        <native:bottom-nav-item
            id="network"
            label="Network"
            url="{{ route('network') }}"
            icon="globe"
            :active="request()->routeIs('network')"
        />
    </native:bottom-nav>

</div>
