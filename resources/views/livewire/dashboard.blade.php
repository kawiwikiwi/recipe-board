<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

new #[Layout('components.layouts.app')] class extends Component {

    public $recipes;
    public $recipe;
    public $user_id;
    public $favouriteRecipes;
    public $popularRecipes;
    public $showMyRecipes = false;
    public $showFavourites = false;
    public $showPopular = true;


    public function mount() {
        $this->user_id = Auth::user()->id;
        $this->recipes = Recipe::where('user_id', $this->user_id)->get();
        $this->favouriteRecipes = Recipe::whereHas('like', function($query) {
            $query->where('user_id', $this->user_id);
        })->get();
        $this->popularRecipes = Recipe::withCount('like')
            ->orderBy('like_count', 'desc')
            ->take(5)
            ->get();

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

    public function redirectToSearch()
    {
        $this->redirect(route('recipes.search', absolute: false), navigate: true);
    }
    
}; 
?>

<div class="grid grid-cols-1 gap-10 h-full">
    <div class="flex w-full justify-center items-center xl:justify-start">
        <div class="animate-fade-up flex flex-col max-w-fit justify-center items-center p-4 bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm border-2 border-accent-600/20 rounded-2xl">
            <flux:heading class="text-3xl! text-center">
                Welcome back, {{ Auth::user()->name }}!
            </flux:heading>
            <flux:text class="text-center text-lg text-gray-500">
                Here are your recipes and some popular ones to try out.
            </flux:text>
        </div>
    </div>
    

    <div class=" bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm border border-alternate-600/20 rounded-2xl">
        <div class="flex items-start justify-between">
            <div class="bg-accent max-w-fit px-6 py-3 rounded-br-4xl rounded-tl-2xl">
                <h1 class="text-3xl text-white mr-1 text-shadow-md/50 text-shadow-accent-800"> My Recipes </h1>
            </div>
            <flux:button 
                icon="chevron-down"
                variant="primary"
                wire:click="$toggle('showMyRecipes')"
                class="px-7! h-15! rounded-tr-2xl! rounded-bl-2xl! rounded-tl-none! rounded-br-none!"
            />
        </div>
        @if($recipes->isEmpty())
            <p class="text-gray-500 p-10">No recipes added.</p>
        @else
            <div wire:show="showMyRecipes" class="animate-fade-left grid auto-cols-max grid-flow-col justify-items-center overflow-x-auto gap-30 w-full p-10 pb-5">
                @foreach($recipes as $recipe)
                    <x-recipe-card-layout >
                        <x-slot:title>
                            {{ $recipe->title }}
                        </x-slot:title>

                        <x-slot:deleteButton>
                            
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

    <div class=" bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm border border-alternate-600/20 rounded-2xl">
        <div class="flex items-start justify-between">
            <div class="bg-accent max-w-fit px-6 py-3 rounded-br-4xl rounded-tl-2xl">
                <h1 class="text-3xl text-white mr-1 text-shadow-md/50 text-shadow-accent-800"> My Favourites </h1>
            </div>
            <flux:button 
                icon="chevron-down"
                variant="primary"
                wire:click="$toggle('showFavourites')"
                class="px-7! h-15! rounded-tr-2xl! rounded-bl-2xl! rounded-tl-none! rounded-br-none!"
            />
        </div>
        @if($recipes->isEmpty())
            <p class="text-gray-500 p-10">No favourited recipes yet.</p>
        @else
            <div wire:show="showFavourites" class="animate-fade-left grid auto-cols-max grid-flow-col justify-items-center overflow-x-auto gap-30 w-full p-10 pb-5">
                @foreach($favouriteRecipes as $recipe)
                    <x-recipe-card-layout>
                        <x-slot:title>
                            {{ $recipe->title }}
                        </x-slot:title>

                        <x-slot:deleteButton>
                            
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

    <div class="pb-6 bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm border border-alternate-600/20 rounded-2xl">
        <div class="bg-accent max-w-fit px-6 py-3 rounded-br-4xl rounded-tl-2xl">
            <h1 class="text-3xl text-white mr-1 text-shadow-md/50 text-shadow-accent-800"> Popular Recipes </h1>
        </div>
        @if($recipes->isEmpty())
            <p class="text-gray-500 p-10">No featured recipes yet.</p>
        @else
            <div class="animate-fade-left grid auto-cols-max grid-flow-col justify-items-center overflow-x-auto gap-30 w-full p-10 pb-5">
                @foreach($popularRecipes as $recipe)
                    <x-recipe-card-layout>
                        <x-slot:title>
                            {{ $recipe->title }}
                        </x-slot:title>

                        <x-slot:deleteButton>
                            
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

    <div class="flex flex-col justify-center items-center p-8 bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm border border-alternate-600/20 rounded-2xl">
        <flux:heading class="text-2xl! text-center">
            Nothing catch your eye?
            <flux:text class="text-lg text-gray-500">Find your new favourite recipe over here...</flux:text>
        </flux:heading>
        <flux:button
            icon="square-arrow-out-up-right"
            variant="primary"
            class="mt-5 w-40! border! border-white!"
            wire:click="redirectToSearch"
        >
            Search Recipes
        </flux:button>
    </div>
</div>
