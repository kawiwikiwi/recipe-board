<div class="grid grid-cols-1 gap-y-6 p-4 w-sm h-md bg-white dark:bg-zinc-900 rounded-lg border-8 border-alternate-400">
    <div class="relative w-full h-12">
        <div>
            {{ $deleteButton }}
        </div>
        <div class="absolute top-0 right-0">
            {{ $favourite }}
        </div>
    </div>

    <flux:heading class="text-center text-4xl!">
        {{ $title }}
    </flux:heading>

    <div class="grid grid-cols-[1fr_min-content_1fr] items-center gap-4 w-full p-4">
        <div class="flex flex-col items-center justify-center space-y-2 p-4">
            <img src="{{ asset('assets/stopwatch.svg') }}" alt="Stopwatch Image" class="w-16 h-16">
            <flux:text class="text-center text-lg">
                Recipe Time
            </flux:text>
            
            {{ $recipeTime ?? 'N/A' }}

        </div>
        <flux:separator vertical class="my-5 bg-gray-200 dark:bg-zinc-700" />
        <div class="flex flex-col items-center justify-center space-y-2 p-4">
            <img src="{{ asset('assets/food-tray.svg') }}" alt="Service Food Tray Image" class="w-16 h-16">
            <flux:text class="text-center text-lg">
                Servings
            </flux:text>

            {{ $recipeServes ?? 'N/A' }}

        </div>
    </div>

    <div class="flex w-full justify-center items-center gap-4 mb-4">
        {{ $actionButtons }}
    </div>
</div>