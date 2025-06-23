<?php

use Livewire\Volt\Component;

new class extends Component
{
    
    public $title = 'Title of the Recipe';
    public $likeCount = 0;
    public $recipeTime;
    public $recipeCook;
    public $recipePrep;
    public $recipeServes;
    public $recipe;

    public function getRecipeTime()
    {
        if ($this->recipeCook && $this->recipePrep) {
            $cook = \Carbon\CarbonInterval::createFromFormat('H:i', $this->recipeCook);
            $prep = \Carbon\CarbonInterval::createFromFormat('H:i', $this->recipePrep);
            $total = $cook->add($prep);
            $this->recipeTime = $total->format('%H hrs %I mins');
            return $this->recipeTime;
        }
        elseif ($this->recipeCook) {
            $cook = \Carbon\CarbonInterval::createFromFormat('H:i', $this->recipeCook);
            $this->recipeTime = $cook->format('%H hrs %I mins');
            return $this->recipeTime;
        } elseif ($this->recipePrep) {
            $prep = \Carbon\CarbonInterval::createFromFormat('H:i', $this->recipePrep);
            $this->recipeTime = $prep->format('%H hrs %I mins');
            return $this->recipeTime;
        }
        return null;
    }
    
}?>

<div class="grid grid-cols-1 gap-y-6 p-4 w-sm h-md bg-white dark:bg-zinc-900 rounded-lg border-8 border-alternate-400">
    <div class="relative w-full h-12">
        <div>
            <flux:button 
                class="group h-10! w-10! bg-transparent! border-none!" 
                wire:click="$parent.deleteRecipe({{ $recipe->id }})"
            >
                <flux:icon name="trash-2" class="h-7 w-7 text-zinc-500 dark:text-white/70 group-hover:text-red-400! dark:group-hover:text-red-400!" />
            </flux:button>
        </div>
        <livewire:components.favourite-recipe />
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
            <flux:text class="text-center text-md">
                {{ $this->getRecipeTime() ?? 'N/A' }}
            </flux:text>
        </div>
        <flux:separator vertical class="my-5 bg-gray-200 dark:bg-zinc-700" />
        <div class="flex flex-col items-center justify-center space-y-2 p-4">
            <img src="{{ asset('assets/food-tray.svg') }}" alt="Service Food Tray Image" class="w-16 h-16">
            <flux:text class="text-center text-lg">
                Servings
            </flux:text>
            <flux:text class="text-center text-md">
                {{ $recipeServes ?? 'N/A' }}
            </flux:text>
        </div>
    </div>

    <div class="flex w-full justify-center items-center gap-4 mb-4">
        <flux:button.group>
            <flux:button
                icon="clipboard-pen-line"
                size="sm"
                class="rounded-l-full bg-accent-400/70! inset-shadow-sm! inset-shadow-accent-700! border-r-accent-700! w-23!"
                wire:click="$parent.editRecipe({{ $recipe->id }})"
            >
                Edit
            </flux:button>
            <flux:button
                icon:trailing="clipboard-check"
                size="sm"
                class="rounded-r-full bg-accent!  border-l-none! w-23!"
                wire:click="$parent.publishRecipe({{ $recipe->id }})"
            >
                Publish
            </flux:button>
        </flux:button.group>
    </div>
</div>
