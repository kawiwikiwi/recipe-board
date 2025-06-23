<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Modelable;

new class extends Component {
    #[Modelable]
    public $cuisineTags = [];
    public $otherCuisine = '';

    public function addOtherCuisine()
    {
        $value = trim($this->otherCuisine);
        if ($value && !in_array($value, $this->cuisineTags)) {
            $this->cuisineTags[] = $value;
        }
        $this->otherCuisine = '';
    }
}; ?>

<div>
    <flux:fieldset>
        <flux:legend>Cuisine Type</flux:legend>

        <flux:separator />

        <flux:description class="my-2">
            Select the cuisine type for this recipe. This will help users find recipes from specific culinary traditions.
        </flux:description>

        <div class="w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-y-2 mt-2 items-start">
            <flux:checkbox value="african" label="African" wire:model.live="cuisineTags" />
            <flux:checkbox value="american" label="American" wire:model.live="cuisineTags" />
            <flux:checkbox value="brazilian" label="Brazilian" wire:model.live="cuisineTags" />
            <flux:checkbox value="british" label="British" wire:model.live="cuisineTags" />
            <flux:checkbox value="caribbean" label="Caribbean" wire:model.live="cuisineTags" />
            <flux:checkbox value="chinese" label="Chinese" wire:model.live="cuisineTags" />
            <flux:checkbox value="french" label="French" wire:model.live="cuisineTags" />
            <flux:checkbox value="greek" label="Greek" wire:model.live="cuisineTags" />
            <flux:checkbox value="indian" label="Indian" wire:model.live="cuisineTags" />
            <flux:checkbox value="italian" label="Italian" wire:model.live="cuisineTags" />
            <flux:checkbox value="japanese" label="Japanese" wire:model.live="cuisineTags" />
            <flux:checkbox value="korean" label="Korean" wire:model.live="cuisineTags" />
            <flux:checkbox value="mediterranean" label="Mediterranean" wire:model.live="cuisineTags" />
            <flux:checkbox value="mexican" label="Mexican" wire:model.live="cuisineTags" />
            <flux:checkbox value="middle-eastern" label="Middle Eastern" wire:model.live="cuisineTags" />
            <flux:checkbox value="spanish" label="Spanish" wire:model.live="cuisineTags" />
            <flux:checkbox value="thai" label="Thai" wire:model.live="cuisineTags" />
            <flux:checkbox value="turkish" label="Turkish" wire:model.live="cuisineTags" />
        </div>
        <flux:separator class="mt-4"/>
    </flux:fieldset>

    <flux:fieldset class="mt-10">
        <flux:legend>Other Cuisines</flux:legend>

        <flux:separator />

        <flux:description class="my-2">
            If the cuisine type is not listed above, please specify it here.
        </flux:description>

        <flux:input.group>
            <flux:input type="text" placeholder="Enter other cuisine type" wire:model="otherCuisine" wire:keydown.enter="addOtherCuisine" />
            <flux:button icon="plus" variant="primary" class="px-6" wire:click="addOtherCuisine"></flux:button>
        </flux:input.group>
    </flux:fieldset>
</div>
