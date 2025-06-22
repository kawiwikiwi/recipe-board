<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Recipe;


new #[Layout('components.layouts.app')] class extends Component {
    public $recipes;
    public $user;

    public function render(): mixed
    {
        return view('livewire.recipes.index');
    }

    public function mount() {
        $this->user_id = Auth::user()->id;
        $this->recipes = Recipe::where('user_id', $this->user_id)->get();


    }

    public function redirectToAddRecipe(){
        $this->redirect(route('recipes.create', absolute:false), navigate:true);
    }

    public function redirectToDashboard(){
        $this->redirect(route('dashboard', absolute:false), navigate:true);
    }

    public function editRecipe($recipeId) {
        $this->redirect(route('recipes.edit', [$recipeId]), navigate:true);
    }
}; ?>

<x-main-layout title="My Recipes">
    <x-slot:backButton>
        <flux:button 
            wire:click="redirectToDashboard"
            icon="arrow-uturn-left" 
            variant="ghost" 
            class="absolute! left-0! top-0! py-5! px-7! h-12! inset-shadow-md bg-accent-700/50! hover:bg-[color-mix(in_oklab,_var(--color-accent-700),_transparent_10%)]! rounded-bl-none rounded-tr-none rounded-br-3xl rounded-tl-2xl!"
        >
        </flux:button>
    </x-slot:backButton>
    <x-slot:headerButtons>
        <flux:button icon="wand-sparkles" class="inset-shadow-sm/80! inset-shadow-alternate-800! rounded-b-none! text-shadow-md! border-none! bg-alternate-600! hover:bg-[color-mix(in_oklab,_var(--color-alternate-700),_transparent_10%)]! h-15!" wire:click="redirectToAddRecipe">
            Add New Recipe
        </flux:button>
    </x-slot:headerButtons>

    <x-slot:content>
        @if($recipes->isEmpty())
            <p class="text-gray-500 p-10">No recipes added.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 justify-items-center overflow-y-scroll gap-10 w-full p-10 pb-5">
                @foreach($recipes as $recipe)
                    <livewire:components.recipe-card 
                        :key="$recipe->id" 
                        :recipe="$recipe"
                        :likeCount="$recipe->likes_count" 
                        :title="$recipe->title" 
                        :recipeCook="$recipe->cook_time"
                        :recipePrep="$recipe->prep_time" 
                        :recipeServes="$recipe->serves"
                    />
                @endforeach
            </div>
        @endif
    </x-slot:content>

</x-main-layout>

