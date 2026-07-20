<x-filament-widgets::widget>
    <x-filament::section 
        class="relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-50 via-blue-100 to-blue-400 dark:from-blue-900/20 dark:via-blue-800/30 dark:to-blue-600 shadow-sm hover:shadow-md transition-shadow duration-300 !p-6"
    >
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <img src="{{ asset('logo.png') }}" alt="Logo Aplikasi" class="h-12 w-auto object-contain">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">SMP Negeri 3 Tuntang</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Sistem Informasi Pelanggaran dan Kepatuhan</p>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-3">
               <img width="50" src="{{ asset("smp2.png") }}" alt="">
            </div>
        </div>
        <!-- Garis bawah gradien -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-200 via-blue-400 to-blue-600 dark:from-blue-300 dark:via-blue-500 dark:to-blue-700"></div>
        <!-- Elemen dekoratif -->
        <div class="absolute -right-12 -top-12 h-32 w-32 rounded-full bg-blue-200/30 dark:bg-blue-400/10"></div>
        <div class="absolute -bottom-12 -left-12 h-24 w-24 rounded-full bg-blue-300/20 dark:bg-blue-500/10"></div>
    </x-filament::section>
</x-filament-widgets::widget>