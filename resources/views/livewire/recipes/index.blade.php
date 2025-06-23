<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Recipe;


new #[Layout('components.layouts.app')] class extends Component {
    public $recipes;
    public $user;
    public $user_id;

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

    public function deleteRecipe($recipeId) {
        $recipe = Recipe::find($recipeId);
        if ($recipe) {
            $recipe->delete();
            $this->recipes = Recipe::where('user_id', $this->user_id)->get();
            session()->flash('message', 'Recipe deleted successfully.');
        } else {
            session()->flash('error', 'Recipe not found.');
        }
    }

    public function publishRecipe($recipeId) {
        $recipe = Recipe::find($recipeId);
        if ($recipe) {
            $recipe->is_published = true;
            $recipe->save();
            $this->recipes = Recipe::where('user_id', $this->user_id)->get();
            session()->flash('message', 'Recipe published successfully.');
        } else {
            session()->flash('error', 'Recipe not found.');
        }
    }

    public function unpublishRecipe($recipeId) {
        $recipe = Recipe::find($recipeId);
        if ($recipe) {
            $recipe->is_published = false;
            $recipe->save();
            $this->recipes = Recipe::where('user_id', $this->user_id)->get();
            session()->flash('message', 'Recipe unpublished successfully.');
        } else {
            session()->flash('error', 'Recipe not found.');
        }
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
                <x-recipe-card-layout>
                    <x-slot:title>
                        {{ $recipe->title }}
                    </x-slot:title>

                    <x-slot:deleteButton>
                        <flux:button 
                            class="group h-10! w-10! bg-transparent! border-none!" 
                            wire:click="deleteRecipe({{ $recipe->id }})"
                        >
                            <flux:icon name="trash-2" class="h-7 w-7 text-zinc-500 dark:text-white/70 group-hover:text-red-400! dark:group-hover:text-red-400!" />
                        </flux:button>
                    </x-slot:deleteButton>

                    <x-slot:favourite>
                        <livewire:components.favourite-recipe :recipeId="$recipe->id" :key="$recipe->id" />
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
                        <flux:button.group>
                            <flux:button
                                icon="clipboard-pen-line"
                                size="sm"
                                class="rounded-l-full bg-accent-400/70! inset-shadow-sm! inset-shadow-accent-700! border-r-accent-700! w-25!"
                                wire:click="editRecipe({{ $recipe->id }})"
                            >
                                Edit
                            </flux:button>
                            @if($recipe->is_published)
                                <flux:button
                                    size="sm"
                                    icon:trailing="clipboard-x"
                                    class="rounded-r-full bg-accent!  border-l-none! w-25! "
                                    wire:click="unpublishRecipe({{ $recipe->id }})"
                                >
                                    Unpublish 
                                </flux:button>
                            @else
                                <flux:button
                                    size="sm"
                                    icon:trailing="clipboard-check"
                                    class="rounded-r-full bg-accent!  border-l-none! w-25! "
                                    wire:click="publishRecipe({{ $recipe->id }})"
                                >
                                    Publish 
                                </flux:button>
                            @endif
                        </flux:button.group>
                    </x-slot:actionButtons>
                </x-recipe-card-layout>
            @endforeach
            </div>
        @endif
    </x-slot:content>

</x-main-layout>

