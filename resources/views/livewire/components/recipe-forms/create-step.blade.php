<?php

use Livewire\Volt\Component;

new class extends Component {
    
    public $currentStep;
    public $title;
    public $description;

    public function addStep()
    {
        $this->dispatch('stepAdded',  [
            'step' => $this->currentStep,
            'title' => $this->title,
            'description' => $this->description,
            'frontend_id' => Str::uuid()->toString(),
        ]);

        // Clear input fields
        $this->title = '';
        $this->description = '';
    }

    public function render(): mixed
    {
        return view('livewire.components.recipe-forms.create-step');
    }
}; ?>


<div class="flex gap-10 w-full overflow-visible">
    <div class="w-12 h-12 rounded-full bg-accent flex shrink-0 items-center justify-center">
        <span class="text-white font-semibold text-2xl" >{{ $currentStep }}</span>
    </div>
    <div class="grid grid-cols-1 w-full">
        <div class="grid">
            <flux:input.group>
                <flux:input
                    wire:model="title"
                    required
                    autofocus
                    autocomplete="01:30"
                    :placeholder="__('Title')"
                    class:input="border-b-0 rounded-b-none text-lg! font-semibold"
                />
                <flux:button icon="plus" variant="primary" class="px-6 border-b-0 rounded-b-none text-white" wire:click="addStep"></flux:button>
            </flux:input.group>

            <flux:separator />

            <flux:textarea
                wire:model="description"
                required
                autofocus
                autocomplete="01:30"
                :placeholder="__('Write your instructions here...')"
                class="border-t-0 rounded-t-none"
            />
        </div>
    </div>
</div>

