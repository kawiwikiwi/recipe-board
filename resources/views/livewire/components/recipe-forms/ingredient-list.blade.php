<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Modelable;

new class extends Component
{
    public $ingredient;
    public $amount;
    public $unit;
    public $index;

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
            'frontend_id' => $ingredient['frontend_id'] ?? Str::uuid()->toString(),
        ];
    }

    public function getIndexByFrontendId($frontendId)
    {
        return array_search($frontendId, array_column($this->added_ingredient, 'frontend_id'));
    }

    public function removeIngredient($frontendId)
    {
        $index = $this->getIndexByFrontendId($frontendId); 
        array_splice($this->added_ingredient, $index, 1);
    }

    public function saveIngredient($frontendId, $ingredient, $amount, $unit)
    {
        $index = $this->getIndexByFrontendId($frontendId); 
        $this->added_ingredient[$index] = [
            'id' => $this->added_ingredient[$index]['id'] ?? null,
            'ingredient' => $ingredient,
            'amount' => $amount,
            'unit' => $unit,
            'frontend_id' => $this->added_ingredient[$index]['frontend_id']
        ];
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
                    :index="$item['frontend_id']"
                    :key="$item['frontend_id']"
                />
            @endforeach
        </div>
    @endif
    <livewire:components.recipe-forms.create-list />
</div>

