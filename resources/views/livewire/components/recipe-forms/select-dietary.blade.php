<?php

use Livewire\Volt\Component;

new class extends Component {
    public function render(): mixed
    {
        return view('livewire.components.recipe-forms.select-dietary');
    }
}; ?>


<flux:fieldset>
    <flux:legend>Dietary Preferences</flux:legend>

    <flux:separator />
    
    <flux:description class="my-2">
        Select the dietary preferences that apply to this recipe. This will help users find recipes that fit their dietary needs.
    </flux:description>

    <div class="w-full grid grid-cols-7 gap-y-2 mt-2">
        <flux:checkbox value="vegetarian" label="Vegetarian" />
        <flux:checkbox value="vegan" label="Vegan" />
        <flux:checkbox value="gluten-free" label="Gluten-Free" />
        <flux:checkbox value="paleo" label="Paleo" />
        <flux:checkbox value="keto" label="Keto" />
        <flux:checkbox value="low-carb" label="Low-Carb" />
        <flux:checkbox value="dairy-free" label="Dairy-Free" />
        <flux:checkbox value="nut-free" label="Nut-Free" />
        <flux:checkbox value="halal" label="Halal" />
        <flux:checkbox value="kosher" label="Kosher" />
        <flux:checkbox value="low-sodium" label="Low Sodium" />
        <flux:checkbox value="low-fat" label="Low Fat" />
        <flux:checkbox value="high-protein" label="High Protein" />
    </div>

    <flux:separator class="mt-4" />

</flux:fieldset>

