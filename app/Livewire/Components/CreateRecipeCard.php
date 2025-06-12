<?php

namespace App\Livewire\Components;

use Livewire\Component;

class CreateRecipeCard extends Component
{
    public $title;
    public $type;

    public function mount($title, $type)
    {
        $this->title = $title;
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.components.create-recipe-card');
    }
}
