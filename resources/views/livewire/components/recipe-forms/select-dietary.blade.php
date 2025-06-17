<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Modelable;

new class extends Component {
    #[Modelable]
    public $dietaryTags = [];
}; ?>


<flux:fieldset>
    <flux:legend>Dietary Preferences</flux:legend>

    <flux:separator />
    
    <flux:description class="my-2">
        Select the dietary preferences that apply to this recipe. This will help users find recipes that fit their dietary needs.
    </flux:description>

    <div class="w-full grid grid-cols-7 gap-y-2 mt-2">
        <flux:checkbox value="vegetarian" label="Vegetarian" wire:model.live="dietaryTags"/>
        <flux:checkbox value="vegan" label="Vegan" wire:model.live="dietaryTags"/>
        <flux:checkbox value="pescatarian" label="Pescatarian" wire:model.live="dietaryTags"/>
        <flux:checkbox value="halal" label="Halal" wire:model.live="dietaryTags"/>
        <flux:checkbox value="kosher" label="Kosher" wire:model.live="dietaryTags"/>
        <flux:checkbox value="gluten_free" label="Gluten-Free" wire:model.live="dietaryTags"/>
        <flux:checkbox value="dairy_free" label="Dairy-Free" wire:model.live="dietaryTags"/>
        <flux:checkbox value="low_calorie" label="Low Calorie" wire:model.live="dietaryTags"/>
        <flux:checkbox value="low_carb" label="Low Carb" wire:model.live="dietaryTags"/>
        <flux:checkbox value="low_fat" label="Low Fat" wire:model.live="dietaryTags"/>
        <flux:checkbox value="low_sugar" label="Low Sugar" wire:model.live="dietaryTags"/>
        <flux:checkbox value="low_sodium" label="Low Sodium" wire:model.live="dietaryTags"/>
        <flux:checkbox value="high_protein" label="High Protein" wire:model.live="dietaryTags"/>
        <flux:checkbox value="keto" label="Keto" wire:model.live="dietaryTags"/>
    </div>

    <flux:separator class="mt-4" />

</flux:fieldset>

