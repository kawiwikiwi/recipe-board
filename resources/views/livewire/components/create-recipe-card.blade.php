<?php

use Livewire\Volt\Component;

new class extends Component
{
    public $title;
    public $type;

    public function mount($title, $type)
    {
        $this->title = $title;
        $this->type = $type;
    }

    public function render():mixed
    {
        return view('livewire.components.create-recipe-card');
    }
}?>

<div class="bg-white dark:bg-zinc-800 shadow-lg/30 mb-5">
    <div class="bg-accent max-w-fit px-4 py-2 rounded-br-3xl">
        <h1 class="text-xl text-white mr-1"> {{ $title }} </h1>
    </div>

    <div class="bg-white dark:bg-zinc-800 p-10">
        @if($type === 'basics')
            <livewire:components.recipe-forms.basics/>
        @elseif($type === 'ingredients')
            <livewire:components.recipe-forms.ingredient-list/>
        @elseif($type === 'instructions')
            <livewire:components.recipe-forms.instructions/>
        @elseif($type === 'tags')
            <livewire:components.recipe-forms.tags/>
        @endif
    </div>
</div>