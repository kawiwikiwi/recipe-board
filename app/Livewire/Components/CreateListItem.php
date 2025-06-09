<?php

namespace App\Livewire\Components;

use Livewire\Component;

class CreateListItem extends Component
{
    public $ingredient;
    public $amount;
    public $unit;

    public $index;

    public function mount($ingredient, $amount, $unit)
    {
        $this->ingredient = $ingredient;
        $this->amount = $amount;
        $this->unit = $unit;
    }

    public function remove()
    {
        $this->dispatch('removeIngredient', $this->index);
    }

    public function render()
    {
        return view('livewire.components.create-list-item');
    }
}
