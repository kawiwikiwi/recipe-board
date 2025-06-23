<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Flux\Flux;



new #[Layout('components.layouts.app')] class extends Component {
    public $recipe;
    public $title;
    public $user_id;
    public $user;
    public $difficulty;

    public function mount(Recipe $recipe)
    {
        $this->recipe = $recipe;
        $this->title = $recipe->title;
        $this->user_id = $recipe->user_id;
        $this->difficulty = $recipe->difficulty;

        $this->user = $recipe->user;
    }

    public function redirectToSearch()
    {
        return $this->redirectRoute('recipes.search');
    }

    public function getRecipeTime($recipe)
    {
        if (!empty($recipe->cook_time) && !empty($recipe->prep_time)) {
            $cook = \Carbon\CarbonInterval::createFromFormat('H:i', $recipe->cook_time);
            $prep = \Carbon\CarbonInterval::createFromFormat('H:i', $recipe->prep_time);
            $total = $cook->add($prep);
            return $total->format('%H hrs %I mins');
        } elseif (!empty($recipe->cook_time)) {
            $cook = \Carbon\CarbonInterval::createFromFormat('H:i', $recipe->cook_time);
            return $cook->format('%H hrs %I mins');
        } elseif (!empty($recipe->prep_time)) {
            $prep = \Carbon\CarbonInterval::createFromFormat('H:i', $recipe->prep_time);
            return $prep->format('%H hrs %I mins');
        }
        return null;
    }

    
}
?>

<x-main-layout title="{{ $title }}">
    <x-slot:backButton>
        <flux:button 
            wire:click="redirectToSearch"
            icon="arrow-uturn-left" 
            variant="ghost" 
            class="absolute! left-0! top-0! py-5! px-7! h-12! inset-shadow-md bg-accent-700/50! hover:bg-[color-mix(in_oklab,_var(--color-accent-700),_transparent_10%)]! rounded-bl-none rounded-tr-none rounded-br-3xl rounded-tl-2xl!"
        >
        </flux:button>
    </x-slot:backButton>

    <x-slot:headerButtons >
        <div class="flex gap-2 bg-accent-600 px-4 py-4 rounded-t-lg inset-shadow-sm inset-shadow-accent-700">
            <h1 class="text-xl font-semibold">Makes</h1>
            <flux:separator vertical />
            <p class="text-xl font-semibold">{{ $recipe->makes }}</p>
        </div>
        <div class="flex gap-2 bg-alternate-600 px-4 py-4 rounded-t-lg inset-shadow-sm inset-shadow-alternate-700">
            <h1 class="text-xl font-semibold">Serves</h1>
            <flux:separator vertical />
            <p class="text-xl font-semibold">{{ $recipe->serves }}</p>
        </div>
    </x-slot:headerButtons>

    <x-slot:content>
        <div class="px-15 flex flex-col items-start justify-items-center overflow-y-scroll gap-5 w-full p-10 pb-5">
            <div class="py-5 flex w-full items-start justify-between">
                <div class="text-lg mb-2">
                    <p>Created by {{ $user->username }}</p>
                    <p>{{ $recipe->created_at->format('d M, Y') }}</p>
                </div>

                <div class="flex items-center gap-2 mr-30">
                    <h1 class="text-xl">Difficulty</h1>

                    @switch($difficulty)
                        @case('easy')
                            <div class="flex items-center">
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                            </div>
                            @break
                        @case('medium')
                            <div class="flex items-center">
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                            </div>
                            @break
                        @case('hard')
                            <div class="flex items-center">
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                            </div>
                            @break
                        @case('expert')
                            <div class="flex items-center">
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                            </div>
                            @break
                        @case('master')
                            <div class="flex items-center">
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                                <flux:icon name="star" variant="solid" class="text-alternate-500" />
                            </div>
                            @break
                        @default
                            <div class="flex items-center">
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                                <flux:icon name="star" variant="outline" class="text-accent-500" />
                            </div>
                            @break
                    @endswitch
                </div>

                <livewire:components.favourite-recipe :recipeId="$recipe->id" :key="'fav-'.$recipe->id.'-'.Str::uuid()" /> 
            </div>

            <div class="mb-4 grid grid-cols-[1fr_min-content_1fr_min-content_1fr] items-center gap-4 w-full">
                    <div class="flex flex-col items-center justify-center space-y-2 p-4">
                        <img src="{{ asset('assets/frying-pan.svg') }}" alt="Stopwatch Image" class="w-12 h-12">
                        <flux:text class="text-center text-lg">
                            Cooking Time
                        </flux:text>
                        <flux:text class="text-center text-md">
                            {{ $recipe->cook_time ?? 'N/A' }}
                        </flux:text>
                    </div>

                    <flux:separator vertical class="my-5 bg-gray-200 dark:bg-zinc-700" />
                    
                    <div class="flex flex-col items-center justify-center space-y-2 p-4">
                        <img src="{{ asset('assets/mixing-bowl.svg') }}" alt="Service Food Tray Image" class="w-12 h-12">
                        <flux:text class="text-center text-lg">
                            Preparation Time
                        </flux:text>
                        <flux:text class="text-center text-md">
                            {{ $recipe->prep_time ?? 'N/A' }}
                        </flux:text>
                    </div>

                    <flux:separator vertical class="my-5 bg-gray-200 dark:bg-zinc-700" />
                    
                    <div class="flex flex-col items-center justify-center space-y-2 p-4">
                        <img src="{{ asset('assets/stopwatch.svg') }}" alt="Service Food Tray Image" class="w-12 h-12">
                        <flux:text class="text-center text-lg">
                            Total Time
                        </flux:text>
                        <flux:text class="text-center text-md">
                            {{ $this->getRecipeTime($recipe) ?? 'N/A' }}
                        </flux:text>
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    <h1 class="text-3xl font-bold mb-2">Description</h1>
                    <flux:separator class="bg-accent! mb-2" />
                    <p class="text-lg">{{ $recipe->description }}</p>
                </div>

                <div class="w-full flex flex-col">
                    <h1 class="text-3xl font-bold mb-2 mt-10">Ingredients</h1>
                    <flux:separator class="bg-accent! mb-2" />
                    <ul class="list-disc marker:text-alternate-500 pl-5 text-lg">
                        @foreach($recipe->ingredient as $ingredient)
                            <li>{{ $ingredient->quantity }} {{ $ingredient->unit }} {{ $ingredient->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="w-full flex flex-col">
                    <h1 class="text-3xl font-bold mb-2 mt-10">Steps</h1>
                    <flux:separator class="bg-accent! mb-2" />
                    @foreach($recipe->step as $step)
                        <div class="flex gap-10 w-full my-4">
                            <div class="w-12 h-12 rounded-full bg-accent flex shrink-0 items-center justify-center">
                                <span class="text-white font-semibold text-2xl" >{{ $step->step_number }}</span>
                            </div>

                            <div class="grid grid-cols-1 w-full">
                                <flux:heading class="text-xl! font-semibold mb-2">
                                    {{ $step->title }}
                                </flux:heading>

                                <flux:separator class="bg-alternate-500! mb-2" />

                                <flux:text>
                                    {{ $step->instruction }}
                                </flux:text>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </x-slot:content>

</x-main-layout>