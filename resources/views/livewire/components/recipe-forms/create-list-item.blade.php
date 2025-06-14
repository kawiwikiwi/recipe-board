<?php

use Livewire\Volt\Component;

new class extends Component
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

    public function render():mixed
    {
        return view('livewire.components.recipe-forms.create-list-item');
    }
}?>

<div>
    <flux:field>
        <flux:input.group class="items-end">
            <flux:input
                type="text"
                :value="$ingredient"
                readonly
            />
            <flux:input
                type="text"
                :value="$amount"
                readonly
            />
            <flux:input
                type="text"
                :value="$unit"
                readonly 
            />
            <flux:button class="px-6" variant="danger" icon="x-mark" wire:click="remove"></flux:button>
        </flux:input.group>
    </flux:field>
</div>