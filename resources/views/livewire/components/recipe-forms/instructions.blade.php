<?php

use Livewire\Volt\Component;

new class extends Component {
    
    public $steps = [];
    public $title;
    public $description;
    public $currentStep = 1;

    public function addStep()
    {
        $this->steps[] = [
            'step' => $this->currentStep,
            'title' => $this->title,
            'description' => $this->description,
        ];

        // Clear input fields
        $this->title = '';
        $this->description = '';
        $this->currentStep++;
    }

    public function removeStep($index)
    {
        unset($this->steps[$index]);
        $this->steps = array_values($this->steps);
        
        // Re-index steps
        foreach ($this->steps as $i => $step) {
            $this->steps[$i]['step'] = $i + 1;
        }
        
    }
    public function render(): mixed
    {
        return view('livewire.components.recipe-forms.instructions');
    }
    
} ?>

<div class="grid grid-cols-1 gap-4">
    <div class="flex gap-10 w-full overflow-visible">
        <div class="w-12 h-12 rounded-full bg-accent flex shrink-0 items-center justify-center">
            <span class="text-white font-semibold text-2xl">1</span>
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
                    <flux:button icon="plus" variant="primary" class="px-6 border-b-0 rounded-b-none text-white"></flux:button>
                </flux:input.group>

                <flux:separator />

                <flux:textarea
                    wire:model="instructions"
                    required
                    autofocus
                    autocomplete="01:30"
                    :placeholder="__('Write your instructions here...')"
                    class="border-t-0 rounded-t-none"
                />
            </div>
        </div>
    </div>
</div>