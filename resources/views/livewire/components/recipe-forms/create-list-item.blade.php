<?php

use Livewire\Volt\Component;

new class extends Component
{
    public $ingredient;
    public $amount;
    public $unit;
    public $index;
    public $editIngredient;
    public $editAmount;
    public $editUnit;
    public $isEditing;

    public function mount($ingredient, $amount, $unit, $index, $isEditing = false)
    {
        $this->ingredient = $ingredient;
        $this->amount = $amount;
        $this->unit = $unit;
        $this->index = $index;
        $this->editIngredient = $ingredient;
        $this->editAmount = $amount;
        $this->editUnit = $unit;
    }

    public function remove()
    {
        $this->dispatch('removeIngredient', $this->index);
    }

    public function edit()
    {
        $this->isEditing = true;
    }

    public function saveEdit()
    {
        $this->dispatch('saveIngredient', $this->index, $this->editIngredient, $this->editAmount, $this->editUnit);
        $this->isEditing = false;
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
    }

    public function render():mixed
    {
        return view('livewire.components.recipe-forms.create-list-item');
    }
}?>


<flux:field>
    @if($this->isEditing)
        <flux:input.group class="items-end">
            <flux:input
                type="text"
                wire:model="editIngredient"
                required
                
            />
            <flux:input
                type="text"
                wire:model="editAmount"
                required
                
            />
            <flux:input.group>
                <flux:input
                type="text"
                wire:model="editUnit"
                required
                />
                <flux:button class="px-6" variant="primary" aria-label="Save edit" icon="check-line" wire:click="saveEdit"></flux:button>
                <flux:button class="px-6" variant="danger" aria-label="Cancel edit" icon="ban" wire:click="cancelEdit"></flux:button>
                <flux:button class="px-6" variant="danger" aria-label="Remove Step" icon="trash-2" wire:click="remove"></flux:button>
            </flux:input.group>
        </flux:input.group>
    @else
        <flux:input.group class="items-end">
            <flux:input
                type="text"
                wire:model="ingredient"
                required
                disabled
            />
            <flux:input
                type="text"
                wire:model="amount"
                required
                disabled
            />
            <flux:input.group>
                <flux:input
                    type="text"
                    wire:model="unit"
                    required
                    disabled
                />
                <flux:button class="px-6" variant="filled" aria-label="Edit Step" icon="pencil" wire:click="edit"></flux:button>
                <flux:button class="px-6" variant="danger" aria-label="Remove Step" icon="trash-2" wire:click="remove"></flux:button>
            </flux:input.group>
        </flux:input.group>
    @endif
</flux:field>
