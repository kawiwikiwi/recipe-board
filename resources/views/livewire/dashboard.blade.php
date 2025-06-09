<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] class extends Component {
    public function redirectToEnterAppointment(): void
    {
        $this->redirect(route('appointments.enter', absolute: false), navigate: true);
    }

    public function render(): mixed
    {
        return view('livewire.dashboard');
    }
}; ?>

<div>

</div>