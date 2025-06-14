<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<flux:fieldset>
    <flux:legend>Allergies</flux:legend>

    <flux:separator />
    
    <flux:description class="my-2">
        Select the allergens preferences that apply to this recipe. This will help users find recipes that fit their dietary needs.
    </flux:description>

    <div class="w-full grid grid-cols-7 gap-y-2 mt-2 items-start">
        <flux:checkbox value="celery" label="Celery" />
        <flux:checkbox value="crustaceans" label="Crustaceans" />
        <flux:checkbox value="eggs" label="Eggs" />
        <flux:checkbox value="fish" label="Fish" />
        <flux:checkbox value="gluten" label="Gluten" />
        <flux:checkbox value="lupin" label="Lupin" />
        <flux:checkbox value="milk" label="Milk" />
        <flux:checkbox value="molluscs" label="Molluscs" />
        <flux:checkbox value="mustard" label="Mustard" />
        <flux:checkbox value="nuts" label="Nuts" />
        <flux:checkbox value="peanuts" label="Peanuts" />
        <flux:checkbox value="sesame" label="Sesame" />
        <flux:checkbox value="soybeans" label="Soybeans" />
        <flux:checkbox value="sulphites" label="Sulphites" />
    </div>

    <flux:separator class="mt-4" />

</flux:fieldset>
