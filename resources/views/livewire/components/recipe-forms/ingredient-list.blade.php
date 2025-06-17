<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Modelable;

new class extends Component
{
    public $ingredient;
    public $amount;
    public $unit;
    public $index;
    public $editingIndex = null;

    #[Modelable]
    public $added_ingredient = [];

    protected $listeners = [
        'addIngredient',
        'removeIngredient',
        'editIngredient',
        'saveIngredient',
        'cancelEdit',
    ];

    public function addIngredient($ingredient)
    {
        $this->added_ingredient[] = [
            'ingredient' => $ingredient['ingredient'],
            'amount' => $ingredient['amount'],
            'unit' => $ingredient['unit'],
        ];
    }

    public function removeIngredient($index)
    {
        unset($this->added_ingredient[$index]);
        $this->added_ingredient = array_values($this->added_ingredient);

        // Adjust the editing index if necessary
        if ($this->editingIndex === $index) {
            $this->editingIndex = null;
        } elseif ($this->editingIndex > $index) {
            $this->editingIndex--;
        }
    }

    public function editIngredient($index)
    {
        $this->editingIndex = $index;
    }

    public function saveIngredient($index, $ingredient, $amount, $unit)
    {
        $this->added_ingredient[$index] = [
            'ingredient' => $ingredient,
            'amount' => $amount,
            'unit' => $unit,
        ];

        $this->editingIndex = null;
    }

    public function cancelEdit()
    {
        $this->editingIndex = null;
    }
}?>

<div class="grid grid-cols-1 gap-4">
    <div class="grid grid-cols-3">
        <flux:label>Ingredient</flux:label>
        <flux:label>Amount</flux:label>
        <flux:label>Unit</flux:label>
    </div>
    @if (!empty($added_ingredient))
        <div class="grid grid-cols-1 gap-4">
            @foreach($added_ingredient as $index => $item)
                <livewire:components.recipe-forms.create-list-item
                    :ingredient="$item['ingredient']"
                    :amount="$item['amount']"
                    :unit="$item['unit']"
                    :index="$index"
                    :editingIndex="$editingIndex"
                    :key="$index.'-'.$editingIndex"
                />
            @endforeach
        </div>
    @endif
    <livewire:components.recipe-forms.create-list />
</div>

