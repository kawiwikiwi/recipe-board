<?php

use Livewire\Volt\Component;

new class extends Component {
    public $ingredient;
    public $amount;
    public $unit;

    public function render(): mixed
    {
        return view('livewire.components.recipe-forms.create-list');
    }

    public function addIngredient()
    {
        $this->dispatch('addIngredient', [
            'ingredient' => $this->ingredient,
            'amount' => $this->amount,
            'unit' => $this->unit,
        ]);
        // Clear input fields
        $this->ingredient = '';
        $this->amount = '';
        $this->unit = '';
    }

}; ?>


<flux:field>
    <flux:input.group>
        <flux:input
            wire:model="ingredient"
            type="text"
            required
            autofocus
            autocomplete="01:30"
            :placeholder="__('Tomato')"
        />
        <flux:input
            wire:model="amount"
            type="text"
            required
            autofocus
            autocomplete="01:30"
            :placeholder="__('2')"
            class="border-r-none!"
        />
        <flux:input.group>
            <flux:input
                wire:model="unit"
                type="text"
                required
                autofocus
                autocomplete="01:30"
                :placeholder="__('kg')"
                class="border-l-none!"
            />
            <flux:button class="px-6 text-white" icon="plus" variant="primary" wire:click="addIngredient"></flux:button>
        </flux:input.group>
    </flux:input.group>
</flux:field>

