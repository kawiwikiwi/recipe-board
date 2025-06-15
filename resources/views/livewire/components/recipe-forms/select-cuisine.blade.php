<?php

use Livewire\Volt\Component;

new class extends Component {
    public function render(): mixed
    {
        return view('livewire.components.recipe-forms.select-cuisine');
    }
}; ?>

<div>
    <flux:fieldset>
        <flux:legend>Cuisine Type</flux:legend>

        <flux:separator />

        <flux:description class="my-2">
            Select the cuisine type for this recipe. This will help users find recipes from specific culinary traditions.
        </flux:description>

        <div class="w-full grid grid-cols-6 gap-y-2 mt-2 items-start">
            <flux:checkbox value="african" label="African" />
            <flux:checkbox value="american" label="American" />
            <flux:checkbox value="brazilian" label="Brazilian" />
            <flux:checkbox value="british" label="British" />
            <flux:checkbox value="caribbean" label="Caribbean" />
            <flux:checkbox value="chinese" label="Chinese" />
            <flux:checkbox value="french" label="French" />
            <flux:checkbox value="greek" label="Greek" />
            <flux:checkbox value="indian" label="Indian" />
            <flux:checkbox value="italian" label="Italian" />
            <flux:checkbox value="japanese" label="Japanese" />
            <flux:checkbox value="korean" label="Korean" />
            <flux:checkbox value="mediterranean" label="Mediterranean" />
            <flux:checkbox value="mexican" label="Mexican" />
            <flux:checkbox value="middle-eastern" label="Middle Eastern" />
            <flux:checkbox value="spanish" label="Spanish" />
            <flux:checkbox value="thai" label="Thai" />
            <flux:checkbox value="turkish" label="Turkish" />
        </div>
        <flux:separator class="mt-4"/>
    </flux:fieldset>

    <flux:fieldset class="mt-10">
        <flux:legend>Other Cuisines</flux:legend>

        <flux:separator />

        <flux:description class="my-2">
            If the cuisine type is not listed above, please specify it here.
        </flux:description>

        <flux:input type="text" placeholder="Enter other cuisine type" />
    </flux:fieldset>
</div>
