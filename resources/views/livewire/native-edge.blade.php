<div>
    <native:top-bar
        :title="$title ?? 'Dashboard'"
        :show-navigation-icon="true"
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
            icon="home"
            :show-close-button="true"
            :pinned="true"
        />
        <native:side-nav-group heading="Camera" :expanded="request()->routeIs('camera.*')">
            <native:side-nav-item active="{{ request()->routeIs('camera.getPhoto') }}" id="camera-get-photo" icon="camera" url="{{ route('camera.getPhoto') }}" label="Get Photo"/>
            <native:side-nav-item active="{{ request()->routeIs('camera.pickImages') }}" id="camera-pick-images" icon="image-plus" url="{{ route('camera.pickImages') }}" label="Pick Images"/>
            <native:side-nav-item active="{{ request()->routeIs('camera.video') }}" id="camera-video" icon="video" url="{{ route('camera.video') }}" label="Video Recorder" badge="New!" badge-color="blue"/>
        </native:side-nav-group>
        <native:side-nav-group heading="Dialog" :expanded="request()->routeIs('dialog.*')">
            <native:side-nav-item active="{{ request()->routeIs('dialog.share') }}" id="dialog-share" icon="share" url="{{ route('dialog.share') }}" label="Share"/>
            <native:side-nav-item active="{{ request()->routeIs('dialog.alert') }}" id="dialog-alert" icon="bell" url="{{ route('dialog.alert') }}" label="Alert"/>
            <native:side-nav-item active="{{ request()->routeIs('dialog.toast') }}" id="dialog-toast" icon="bolt" url="{{ route('dialog.toast') }}" label="Toast"/>
        </native:side-nav-group>
        <native:side-nav-item active="{{ request()->routeIs('network.demo') }}" id="network-demo" icon="globe" url="{{ route('network.demo') }}" label="Network" badge="New!" badge-color="blue"/>
        <native:side-nav-item active="{{ request()->routeIs('scanner.demo') }}" id="scanner-demo" icon="qrcode" url="{{ route('scanner.demo') }}" label="Scanner Demo" badge="New!" badge-color="blue"/>
        <native:side-nav-item active="{{ request()->routeIs('microphone.demo') }}" id="microphone-demo" icon="microphone" url="{{ route('microphone.demo') }}" label="Microphone" badge="New!" badge-color="blue"/>
        <native:side-nav-item active="{{ request()->routeIs('device.demo') }}" id="device-demo" icon="device-phone-mobile" url="{{ route('device.demo') }}" label="Device Info"/>
        <native:side-nav-item active="{{ request()->routeIs('haptics.vibrate') }}" id="haptics-vibrate" icon="vibrate" url="{{ route('haptics.vibrate') }}" label="Haptics"/>
        <native:side-nav-item active="{{ request()->routeIs('browser.demo') }}" id="browser-demo" icon="globe-alt" url="{{ route('browser.demo') }}" label="Browser"/>
        <native:side-nav-item active="{{ request()->routeIs('system.flashlight') }}" id="system-flashlight" icon="lightbulb" url="{{ route('system.flashlight') }}" label="Flashlight"/>
        <native:side-nav-item active="{{ request()->routeIs('push-notifications.demo') }}" id="push-notifications-demo" icon="bell" url="{{ route('push-notifications.demo') }}" label="Push Notifications"/>
        <native:side-nav-item active="{{ request()->routeIs('biometrics.demo') }}" id="biometrics-demo" icon="finger-print" url="{{ route('biometrics.demo') }}" label="Biometrics"/>
        <native:side-nav-item active="{{ request()->routeIs('geolocation.getCurrent') }}" id="geolocation-get-current" icon="map" url="{{ route('geolocation.getCurrent') }}" label="Geolocation"/>
        <native:side-nav-item active="{{ request()->routeIs('secure-storage.demo') }}" id="secure-storage-demo" icon="folder-lock" url="{{ route('secure-storage.demo') }}" label="Secure Storage"/>
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
            url="{{ route('scanner.demo') }}"
            icon="qrcode"
            :active="request()->routeIs('scanner.demo')"
            news="true"
        />
        <native:bottom-nav-item
            id="camera"
            label="Video"
            badge="{{ $videoCount }}"
            url="{{ route('camera.video') }}"
            icon="video"
            :active="request()->routeIs('camera.video')"
        />
        <native:bottom-nav-item
            id="microphone"
            label="Microphone"
            badge="{{ $audioCount }}"
            url="{{ route('microphone.demo') }}"
            icon="microphone"
            :active="request()->routeIs('microphone.demo')"
        />
        <native:bottom-nav-item
            id="network"
            label="Network"
            url="{{ route('network.demo') }}"
            icon="globe"
            :active="request()->routeIs('network.demo')"
        />
    </native:bottom-nav>

</div>
