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
        <div class="bg-accent bg-clip-border border-top-none rounded-t-2xl shadow-xl pb-6 pt-10 px-14">
            <flux:button icon="arrow-uturn-left" variant="ghost" class="absolute! left-0! top-0! py-5! px-7! bg-accent-700/50! hover:bg-[color-mix(in_oklab,_var(--color-accent-700),_transparent_10%)]! rounded-bl-none rounded-tr-none rounded-br-3xl rounded-tl-2xl!" size="sm" wire:click="redirectToMyRecipes">
                        
            </flux:button>
            <div class="items-center flex justify-between">
                <div class="flex items-center justify-center ">
                    <h1 class="text-4xl text-white text-center font-semibold">Create Your Recipe</h1>
                </div>
                <div class="flex flex-nowrap gap-3">
                    <flux:button icon="save" class="border! border-accent-50! bg-accent-700/50! hover:bg-[color-mix(in_oklab,_var(--color-accent-700),_transparent_10%)]! text-white!" size="sm" wire:click="redirectToMyRecipes">
                        Save
                    </flux:button>
                    <flux:button icon="wand-sparkles" class="border! border-accent-50! bg-alternate-600! hover:bg-[color-mix(in_oklab,_var(--color-alternate-700),_transparent_10%)]!" size="sm" wire:click="redirectToMyRecipes">
                        Publish
                    </flux:button>
                </div>
            </div>
        </div>

        <form class="mx-14 grid grid-cols-1 pt-10 gap-10 flex-1 overflow-y-scroll">
            <livewire:components.create-recipe-card title="Recipe Basics" type="basics"/>
            <livewire:components.create-recipe-card title="Ingredients" type="ingredients" />
            <livewire:components.create-recipe-card title="Instructions" type="instructions" />
            <livewire:components.create-recipe-card title="Tags" type="tags" />
        </form>
    </div>
</div>