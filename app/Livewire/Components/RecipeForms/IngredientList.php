<?php

namespace App\Livewire\Components\RecipeForms;

use Livewire\Component;

class IngredientList extends Component
{
    public $ingredient;
    public $amount;
    public $unit;
    public $added_ingredient = [];
    public $index;
    protected $listeners = ['removeIngredient'];
    
    public function render()
    {
        return view('livewire.components.recipe-forms.ingredient-list');
    }

    public function addIngredient()
    {
        $this->added_ingredient[] = [
            'ingredient' => $this->ingredient,
            'amount' => $this->amount,
            'unit' => $this->unit,
        ];

        // Clear input fields
        $this->ingredient = '';
        $this->amount = '';
        $this->unit = '';
    }

    public function removeIngredient($index)
    {
        unset($this->added_ingredient[$index]);
        $this->added_ingredient = array_values($this->added_ingredient);
    }
}
