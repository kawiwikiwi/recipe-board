<?php

use Livewire\Volt\Component;

new class extends Component {
    public function render(): mixed
    {
        return view('livewire.components.recipe-forms.tags');
    }
}; ?>

<div class="grid grid-cols-1 gap-10">
    <livewire:components.recipe-forms.select-dietary/>
    <livewire:components.recipe-forms.select-allergies />
    <livewire:components.recipe-forms.select-cuisine />
</div>
