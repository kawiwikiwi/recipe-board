<div class="bg-white shadow-lg">
    <div class="bg-accent max-w-fit px-4 py-2 rounded-br-3xl">
        <h1 class="text-xl text-white mr-1"> {{ $title }} </h1>
    </div>

    <div class="bg-white p-10">
        @if($type === 'basics')
            <livewire:components.recipe-forms.basics/>
        @elseif($type === 'ingredients')
            <livewire:components.recipe-forms.ingredient-list/>
        @elseif($type === 'instructions')
            <livewire:components.recipe-forms.instructions/>
        @endif
    </div>
</div>