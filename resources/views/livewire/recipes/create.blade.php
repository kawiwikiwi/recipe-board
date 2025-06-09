<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


new #[Layout('components.layouts.app')] class extends Component {

    public function render(): mixed
    {
        return view('livewire.recipes.create');
    }

    public function redirectToMyRecipes()
    {
        $this->redirect(route('recipes.index', absolute:false), navigate:true);
    }
}; ?>

<div class="bg-[#0B0B0B]/40 min-h-full flex items-start justify-center">
    <div class="w-full p-15 flex flex-col gap-6 max-w-7xl">
        <div class="flex justify-between">
            <div class="flex mb-8 items-center justify-center ">
                <h1 class="text-4xl text-center font-semibold">Create a new recipe</h1>
            </div>
            <flux:button icon="arrow-uturn-left" class="border-l! border-l-solid! border-l-white! border-t! border-t-solid! border-t-white! border-b! border-b-solid! border-b-white!" wire:click="redirectToMyRecipes">
                Back
            </flux:button>
        </div>

        <form>
            <div class="grid grid-cols-1 gap-6">

                <div class="grid grid-cols-9 gap-5">
                    <flux:input.group class="col-span-7 grid gap-2">
                        <flux:label>Recipe Title</flux:label>
                        <flux:input
                            wire:model="name"
                            type="text"
                            required
                            autofocus
                            autocomplete="Recipe Title"
                            :placeholder="__('Recipe Title')"
                        />
                    </flux:input.group>

                    <flux:input.group class="col-span-1 grid gap-2">
                        <flux:label>Makes</flux:label>
                        <flux:input
                            wire:model="makes"
                            type="number"
                            required
                            autofocus
                            autocomplete="4"
                            :placeholder="__('4')"
                        />
                    </flux:input.group>

                    <flux:input.group class="col-span-1 grid gap-2">
                        <flux:label>Serves</flux:label>
                        <flux:input
                            wire:model="serves"
                            type="number"
                            required
                            autofocus
                            autocomplete="4"
                            :placeholder="__('4')"
                        />
                    </flux:input.group>
                </div>

                <div class="grid grid-cols-1 gap-10">
                    <flux:input.group class="grid gap-2">
                        <flux:label>Description</flux:label>
                        <flux:textarea
                            wire:model="description"
                            type="text"
                            required
                            autofocus
                            autocomplete="Description"
                            :placeholder="__('Description about my recipe...')"
                            class="h-full"
                        />
                    </flux:input.group>
                </div>

                <div class="grid grid-cols-3 gap-10">
                        <flux:input.group class="grid gap-2">
                            <flux:label>Cook Time</flux:label>
                            <flux:input
                                wire:model="cook_time"
                                type="time"
                                required
                                autofocus
                                autocomplete="01:30"
                                :placeholder="__('01:30')"
                            />
                        </flux:input.group>

                        <flux:input.group class="grid gap-2">
                            <flux:label>Preparation Time</flux:label>
                            <flux:input
                                wire:model="prep_time"
                                type="time"
                                required
                                autofocus
                                autocomplete="01:30"
                                :placeholder="__('01:30')"
                            />
                        </flux:input.group>

                        <flux:input.group class="grid gap-2">
                            <flux:label>Additional Time</flux:label>
                            <flux:input
                                wire:model="additional_time"
                                type="time"
                                required
                                autofocus
                                autocomplete="01:30"
                                :placeholder="__('01:30')"
                            />
                        </flux:input.group>
                    </div>




            </div>

        <!-- 'prep_time',
        'cook_time',
        'additional_time',
        'total_time',
        'servings',
        'instructions', -->
        </form>
        </div>


    </div>
</div>