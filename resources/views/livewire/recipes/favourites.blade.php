<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;


new #[Layout('components.layouts.app')] class extends Component {
    public $recipes;
    public $recipe;
    public $user_id;

    protected $listeners = [
        'refreshParentComponent' => 'refreshRecipes'
    ];

    public function render(): mixed {
        return view('livewire.recipes.favourites');
    }

    public function mount() {
        $this->user_id = Auth::user()->id;
        $this->refreshRecipes();
    }

    public function refreshRecipes() {
        $this->recipes = Recipe::whereHas('like', function($query) {
            $query->where('user_id', $this->user_id);
        })->get();
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

    public function viewRecipe($recipeId) {

        $this->redirect(route('recipes.view', ['recipe' => $recipeId]), navigate: true);
    
    }
}; ?>

<div class="flex flex-col gap-2 overflow-y-auto h-[calc(100vh-7.5rem)] bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm rounded-2xl shadow-lg">
    <div class="grid grid-cols-1 items-center ">
        <div class=" bg-accent max-w-fit px-6 py-3 max-h-14 rounded-br-4xl rounded-tl-2xl">
            <h1 class="text-3xl text-white mr-1 text-shadow-md/50 text-shadow-accent-800"> Favourite Recipes </h1>
        </div>
    </div>

    @if($recipes->isEmpty())
        <div class="flex flex-col items-center justify-center h-full">
            <p class="text-gray-500 p-10">No recipes found.</p>

        </div>
    @else
        <div 
            key="favourites-{{ implode('-', $recipes->pluck('id')->toArray()) }}" 
            class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 justify-items-center max-h-full overflow-y-auto gap-30 w-full p-10 pb-5"
        >
            @foreach($recipes as $recipe)
                <x-recipe-card-layout>
                    <x-slot:title>
                        {{ $recipe->title }}
                    </x-slot:title>

                    <x-slot:deleteButton>
                        <span>
                            Created by {{ $recipe->user->username }}
                        </span>
                        
                    </x-slot:deleteButton>

                    <x-slot:favourite>
                        <livewire:components.favourite-recipe :recipeId="$recipe->id" :key="'fav-'.$recipe->id.'-'.Str::uuid()" />
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