<?php

namespace App\Livewire\Components;

use Livewire\Component;

class RecipeCard extends Component
{
    
    public $title = '';

    public function render()
    {
        return view('livewire.components.recipe-card');
    }
}
