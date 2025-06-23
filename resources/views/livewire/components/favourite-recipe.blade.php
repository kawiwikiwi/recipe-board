<?php

use Livewire\Volt\Component;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public $likeCount = 0;
    public $isFavorite = false;
    public $recipe;
    public $user_id;
    public $recipeId;

    public function mount()
    {
        $this->user_id = Auth::user()->id;
        $this->recipe = Recipe::find($this->recipeId);

        if ($this->recipe) {
        $this->likeCount = $this->recipe->like()->count();
        $this->isFavorite = $this->recipe->like()->where('user_id', auth()->id())->exists();
        } else {
            $this->likeCount = 0;
            $this->isFavorite = false;
        }
    }

    public function toggleFavorite()
    {
        if ($this->isFavorite) {
            $this->recipe->like()->where('user_id', auth()->id())->delete();
            $this->likeCount--;
        } else {
            $this->recipe->like()->create(['user_id' => auth()->id()]);
            $this->likeCount++;
        }
        $this->isFavorite = !$this->isFavorite;
    }

    
}?>


<div class="flex flex-row-reverse items-center justify-center">
    <flux:button
        class="group h-10! w-10! p-4! bg-transparent! border-none!"
        wire:click="toggleFavorite"
        loading="false"
    >
        @if($isFavorite)
            <flux:icon name="heart" variant="solid" class="text-accent-700 group-hover:text-accent-500 h-8 w-8 animate-jump-in animate-fill-both" />
        @else
            <flux:icon name="heart" variant="outline" class="text-accent-500 group-hover:text-accent-700 h-8 w-8 animate-jump-out animate-reverse animate-fill-backwards" />
        @endif
    </flux:button>
    <flux:heading class="text-lg!">
        {{ $likeCount }}
    </flux:heading>
</div>