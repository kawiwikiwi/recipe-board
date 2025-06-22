<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

new #[Layout('components.layouts.app')] class extends Component {

    public $recipes;
    public $recipe;
    public $toggleFilterIcon = 'outline';

    public function mount() {
        $this->user_id = Auth::user()->id;
        $this->recipes = Recipe::where('user_id', $this->user_id)->get();
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
    
}; 
?>

<div class="flex flex-col gap-10 overflow-y-auto h-full">
    
    <div class="flex justify-start gap-10 mr-10 items-center">
        <div class="bg-accent max-w-fit px-6 py-3 max-h-15 rounded-br-4xl rounded-tl-2xl">
            <h1 class="text-3xl text-white mr-1 text-shadow-md/50 text-shadow-accent-800"> Recipes </h1>
        </div>

        <flux:input.group>
            <flux:input
                placeholder="Search..."
                clearable
                type="search"
                icon="magnifying-glass"
                class="w-full max-w-xl"
                class:input="bg-zinc-900!"
            >
            </flux:input>
            <flux:button
                icon="funnel"
                icon:variant="{{ $toggleFilterIcon }}"
                variant="filled" 
                class="bg-zinc-900!" 
                wire:click="toggleFilter"
            />
        </flux:input.group>
    </div>
    @if($recipes->isEmpty())
        <p class="text-gray-500 p-10">No recipes added.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 justify-items-center overflow-x-auto gap-30 w-full p-10 pb-5">
            @foreach($recipes as $recipe)
                <x-recipe-card-layout>
                    <x-slot:title>
                        {{ $recipe->title }}
                    </x-slot:title>

                    <x-slot:deleteButton>
                        
                    </x-slot:deleteButton>

                    <x-slot:favourite>
                        <flux:button
                            class="h-10! w-10! p-4! bg-transparent! border-none!"
                            wire:click="toggleFavorite"
                        >
                            <flux:icon name="heart" class="text-accent-500 h-8 w-8" />
                        </flux:button>
                        <flux:heading class="text-lg!">
                            {{ $likeCount ?? 0}}
                        </flux:heading>
                    </x-slot:favourite>

                    <x-slot:recipeTime>
                        <flux:text class="text-center text-md">
                            {{ $this->getRecipeTime($recipe) ?? 'N/A' }}
                        </flux:text>
                    </x-slot:recipeTime>

                    <x-slot:recipeServes>
                        <flux:text class="text-center text-md">
                            {{ $recipe->serves ?? 'N/A' }}
                        </flux:text>
                    </x-slot:recipeServes>

                    <x-slot:actionButtons>
                        <flux:button 
                            icon="clipboard-list"
                            variant="primary"
                            size="sm"
                            wire:click="viewRecipe({{ $recipe->id }})" 
                            class="rounded-full! w-46! border! border-white!"
                        >
                            View Recipe
                        </flux:button>
                    </x-slot:actionButtons>
                </x-recipe-card-layout>
            @endforeach
        </div>
    @endif
</div>
