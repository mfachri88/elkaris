<aside class="fixed top-0 left-0 bottom-0 w-64 bg-white shadow-lg z-20 overflow-y-auto transform transition-transform duration-300 ease-in-out lg:translate-x-0" id="sidebar">
    <!-- ...existing code... -->
    
    <?php
        $menu = [
            // ...existing menu items...
            [
                "ikon" => "fas fa-brain",
                "warna" => "text-purple-500",
                "label" => "Tes Minat Bakat",
                "route" => route('admin.career-test.index'),
                "submenu" => [
                    [
                        "label" => "Hasil Tes",
                        "route" => route('admin.career-test.index')
                    ],
                    [
                        "label" => "Kelola Pertanyaan",
                        "route" => route('admin.career-test.manage')
                    ],
                    [
                        "label" => "Statistik",
                        "route" => route('admin.career-test.statistics')
                    ]
                ]
            ],
            // ...existing menu items...
        ];
    ?>

    <ul class="space-y-6">
        @foreach($menu as $item)
            <li>
                @if(isset($item['submenu']))
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="{{ $item['ikon'] }} {{ $item['warna'] }} w-5 h-5 mr-2"></i>
                            <span>{{ $item['label'] }}</span>
                            <i class="fas fa-chevron-down text-gray-500 ml-auto" :class="{'transform rotate-180': open}"></i>
                        </button>
                        <div x-show="open" class="pl-4">
                            @foreach($item['submenu'] as $subitem)
                                <a href="{{ $subitem['route'] }}" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                    <span class="w-1 h-1 bg-gray-400 mr-2 rounded-full"></span>
                                    <span>{{ $subitem['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $item['route'] }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                        <i class="{{ $item['ikon'] }} {{ $item['warna'] }} w-5 h-5 mr-2"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endif
            </li>
        @endforeach
    </ul>

    <!-- ...existing code... -->
</aside>