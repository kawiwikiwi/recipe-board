<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Reactive;

new class extends Component {

    public $title;
    public $description;
    #[Reactive]
    public $step;
    public $isEditing = false;
    public $editTitle;
    public $editDescription;
    public $frontendId;

    public function mount($title, $description, $step)
    {
        $this->title = $title;
        $this->description = $description;
        $this->step = $step;
        $this->editTitle = $title;
        $this->editDescription = $description;
        $this->frontendId = $this->frontendId ?? Str::uuid()->toString();
    }
    
    public function render(): mixed
    {
        return view('livewire.components.recipe-forms.create-step-item');
    }

    public function removeStep()
    {
        $this->dispatch('removeStep', $this->frontendId);
    }

    public function editStep()
    {
        $this->isEditing = true;
    }

    public function saveStep()
    {
        $this->dispatch('saveStep', $this->step, $this->editTitle, $this->editDescription, $this->frontendId);
        $this->isEditing = false;
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
    }
}; ?>

<div class="flex gap-10 w-full overflow-visible">
    <div class="w-12 h-12 rounded-full bg-accent flex shrink-0 items-center justify-center">
        <span class="text-white font-semibold text-2xl" wire:model="step" >{{ $step }}</span>
    </div>
    <div class="grid grid-cols-1 w-full">
        <div class="grid">
            <flux:input.group>
                @if($isEditing)
                    <flux:input
                        wire:model="editTitle"
                        required
                        autofocus
                        class:input="border-b-0 rounded-b-none text-lg! font-semibold"
                    />
                    <flux:button icon="check-line" aria-label="Save ingredient edit" variant="primary" class="px-6 border-b-0 rounded-b-none text-white" wire:click="saveStep"></flux:button>
                    <flux:button icon="ban" aria-label="Cancel ingredient edit" variant="danger" class="px-6 border-b-0 rounded-b-none text-white" wire:click="cancelEdit"></flux:button>
                @else
                    <flux:input
                        wire:model="title"
                        required
                        autofocus
                        disabled
                        class:input="border-b-0 rounded-b-none text-lg! font-semibold"
                    />
                    <flux:button icon="pencil" aria-label="Edit ingredient" variant="filled" class="px-6 border-b-0 rounded-b-none text-white" wire:click="editStep"></flux:button>
                @endif
                <flux:button icon="trash-2" aria-label="Remove ingredient" variant="danger" class="px-6 border-b-0 rounded-b-none text-white" wire:click="removeStep"></flux:button>
            </flux:input.group>

            <flux:separator />
            @if($isEditing)
                <flux:textarea
                    wire:model="editDescription"
                    required
                    autofocus
                    class="border-t-0 rounded-t-none"
                />
            @else
                <flux:textarea
                    wire:model="description"
                    required
                    autofocus
                    disabled
                    class="border-t-0 rounded-t-none"
                />
            @endif
        </div>
    </div>
</div>
