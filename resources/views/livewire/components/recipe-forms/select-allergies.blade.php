<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Modelable;

new class extends Component {
    #[Modelable]
    public $allergyTags = [];
}; ?>

<flux:fieldset>
    <flux:legend>Allergies</flux:legend>

    <flux:separator />
    
    <flux:description class="my-2">
        Select the allergens preferences that apply to this recipe. This will help users find recipes that fit their dietary needs.
    </flux:description>

    <div class="w-full grid grid-cols-7 gap-y-2 mt-2 items-start">
        <flux:checkbox value="celery" label="Celery" wire:model.live="allergyTags" />
        <flux:checkbox value="crustaceans" label="Crustaceans" wire:model.live="allergyTags" />
        <flux:checkbox value="eggs" label="Eggs" wire:model.live="allergyTags" />
        <flux:checkbox value="fish" label="Fish" wire:mode.livel="allergyTags" />
        <flux:checkbox value="gluten" label="Gluten" wire:model.live="allergyTags" />
        <flux:checkbox value="lupin" label="Lupin" wire:model.live="allergyTags" />
        <flux:checkbox value="milk" label="Milk" wire:model.live="allergyTags" />
        <flux:checkbox value="molluscs" label="Molluscs" wire:model.live="allergyTags" />
        <flux:checkbox value="mustard" label="Mustard" wire:mode.live="allergyTags" />
        <flux:checkbox value="nuts" label="Nuts" wire:model.live="allergyTags" />
        <flux:checkbox value="peanuts" label="Peanuts" wire:model.live="allergyTags" />
        <flux:checkbox value="sesame" label="Sesame" wire:model.live="allergyTags" />
        <flux:checkbox value="soybeans" label="Soybeans" wire:model.live="allergyTags" />
        <flux:checkbox value="sulphites" label="Sulphites" wire:model.live="allergyTags" />
    </div>

    <flux:separator class="mt-4" />

</flux:fieldset>
