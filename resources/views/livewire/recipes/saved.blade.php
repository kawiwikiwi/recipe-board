<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


new #[Layout('components.layouts.app')] class extends Component {

    public function render(): mixed
    {
        return view('livewire.recipes.saved');
    }
}; ?>

<div>
    
</div>