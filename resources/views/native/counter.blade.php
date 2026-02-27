<native:scroll-view class="w-full h-full bg-white">
    <native:column class="w-full items-center pt-[64] px-6 pb-6 gap-4">
        <native:text class="text-3xl font-extrabold text-[#272d48] text-center">
            Native UI Counter
        </native:text>
        <native:text class="text-[80] font-bold text-[#7C3AED] text-center">
            {{ $count }}
{{--            {{ number_format($count * 10, 2)}}--}}
        </native:text>
        <native:row class="gap-4 w-full justify-center">
            <native:button @press="decrement" class="bg-[#272d48] rounded-2xl text-white text-6xl font-bold">−</native:button>
            <native:button @press="increment" class="bg-[#272d48] rounded-2xl text-white text-6xl font-bold">+</native:button>
        </native:row>

        {{-- String Transform Section --}}
        <native:column class="w-full p-4 mt-4 rounded-2xl bg-white border border-[#E2E8F0] gap-3">
            <native:text class="text-2xl font-bold text-[#272d48]">String Transform</native:text>

            <native:text class="text-[35] font-semibold text-center" :color="strlen($display) > 0 ? '#7C3AED' : '#CBD5E1'">{{ strlen($display) > 0 ? $display : 'Start typing...' }}</native:text>

            <native:text-input class="w-full" @model="transformText" placeholder="Type something..." />

            <native:scroll-view horizontal>
                <native:row class="gap-2">
                    <native:chip label="UPPER" :selected="$activeTransform === 'upper'" @change="toggleUpper" />
                    <native:chip label="lower" :selected="$activeTransform === 'lower'" @change="toggleLower" />
                    <native:chip label="Title" :selected="$activeTransform === 'title'" @change="toggleTitle" />
                    <native:chip label="camelCase" :selected="$activeTransform === 'camel'" @change="toggleCamel" />
                    <native:chip label="snake_case" :selected="$activeTransform === 'snake'" @change="toggleSnake" />
                    <native:chip label="kebab-case" :selected="$activeTransform === 'kebab'" @change="toggleKebab" />
                    <native:chip label="esreveR" :selected="$activeTransform === 'reverse'" @change="toggleReverse" />
                </native:row>
            </native:scroll-view>

            <native:row class="text-center">
                @if($activeTransform && strlen($transformText) > 0)
                    <native:text class="text-lg w-full rounded-xl text-white p-3 font-bold text-center bg-[#272d48]">str('{{ $transformText }}')->{{ $activeTransform }}()</native:text>
                @endif
            </native:row>
        </native:column>

        <native:row class="justify-center mt-4">
            <native:button @press="showSheet" class="bg-[#272d48] rounded-xl shadow w-full text-3xl font-bold text-white">You ready?</native:button>
        </native:row>

{{--        <native:row class="justify-center mt-4">--}}
{{--            <native:button @press="viewBenchmark" class="bg-[#7C3AED] rounded-full shadow-lg w-full text-2xl font-semibold text-white">Benchmark</native:button>--}}
{{--        </native:row>--}}

        <native:bottom-sheet :visible="$sheetVisible" >
            <native:column class="w-full p-6 gap-3 rounded-t-2xl" >
                <native:button @press="viewDemo" class="bg-[#7C3AED]  rounded-full shadow  w-full text-3xl font-bold text-white my-10">Lets Go 🚀</native:button>
            </native:column>
        </native:bottom-sheet>

    </native:column>
</native:scroll-view>
