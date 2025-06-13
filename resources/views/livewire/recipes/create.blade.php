<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


new #[Layout('components.layouts.app')] class extends Component {

    public function render(): mixed
    {
        return view('livewire.recipes.create');
    }

    public function redirectToMyRecipes()
    {
        $this->redirect(route('recipes.index', absolute:false), navigate:true);
    }
}; ?>

<div class="flex items-start justify-center">
    <div class="w-full border border-alternate-600/20 rounded-2xl max-h-[91vh] flex flex-col max-w-7xl pb-6 bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm h-screen">
        <div class="bg-accent bg-clip-border border-top-none rounded-t-2xl shadow-xl py-6 px-6 items-center flex justify-between">
            <div class="flex items-center justify-center ">
                <h1 class="text-3xl text-white text-center font-semibold">Create Your Recipe</h1>
            </div>
            <flux:button icon="arrow-uturn-left" class="border! border-accent-50!" size="sm" wire:click="redirectToMyRecipes">
                Back
            </flux:button>
        </div>

        <form class="mx-14 grid grid-cols-1 pt-10 gap-10 flex-1 overflow-y-scroll">
            <livewire:components.create-recipe-card title="Recipe Basics" type="basics"/>
            <livewire:components.create-recipe-card title="Ingredients" type="ingredients" />
            <livewire:components.create-recipe-card title="Instructions" type="instructions" />
        </form>
    </div>
</div>