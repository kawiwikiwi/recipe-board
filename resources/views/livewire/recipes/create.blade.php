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

<div class="min-h-full flex items-start justify-center">
    <div class="w-full flex flex-col gap-6 max-w-7xl">
        <div class="bg-accent border-top rounded-t-xl py-6 px-6 items-center flex justify-between">
            <div class="flex items-center justify-center ">
                <h1 class="text-4xl text-white text-center font-semibold">Create Your Recipe</h1>
            </div>
            <flux:button icon="arrow-uturn-left" class="border-l! border-l-solid! border-l-white! border-t! border-t-solid! border-t-white! border-b! border-b-solid! border-b-white!" wire:click="redirectToMyRecipes">
                Back
            </flux:button>
        </div>

        <form class="mx-10 grid grid-cols-1 gap-10">
            <!-- <div class="bg-white">
                <div class="bg-accent max-w-fit px-4 py-2 rounded-br-3xl">
                    <h1 class="text-xl text-white mr-1">Recipe Basics</h1>
                </div>

                <div class="bg-white p-10 grid grid-cols-1 gap-6">
                    <div class="grid grid-cols-9 gap-5">
                        <flux:input.group class="col-span-7 grid gap-2">
                            <div class="grid gap-2">
                                <flux:label>
                                    <flux:icon name="pencil" class="inline-block mr-2" />
                                    Recipe Title
                                </flux:label>
                                <flux:input
                                    wire:model="name"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="Recipe Title"
                                    :placeholder="__('Recipe Title')"
                                />
                            </div>
                        </flux:input.group>

                        <flux:input.group class="col-span-1 grid gap-2">
                            <div class="grid gap-2">
                                <flux:label>
                                    <flux:icon name="utensils" class="inline-block mr-2" />
                                    Makes
                                </flux:label>
                                <flux:input
                                    wire:model="makes"
                                    type="number"
                                    required
                                    autofocus
                                    autocomplete="4"
                                    :placeholder="__('4')"
                                />
                            </div>
                        </flux:input.group>

                        <flux:input.group class="col-span-1 grid gap-2">
                            <div class="grid gap-2">
                                <flux:label>
                                    <flux:icon name="user-round" class="inline-block mr-2" />
                                    Serves
                                </flux:label>
                            <flux:input
                                wire:model="serves"
                                type="number"
                                required
                                autofocus
                                autocomplete="4"
                                :placeholder="__('4')"
                            />
                            </div>
                        </flux:input.group>
                    </div>

                    <div class="grid grid-cols-3 gap-10">
                        <flux:input.group class="grid gap-2">
                            <div class="grid gap-2">
                                <flux:label>
                                    <flux:icon name="clock" class="inline-block mr-2" />
                                    Cooking Time
                                </flux:label>
                                <flux:input
                                    wire:model="cook_time"
                                    type="time"
                                    required
                                    autofocus
                                    autocomplete="01:30"
                                    :placeholder="__('01:30')"
                                />
                            </div>
                        </flux:input.group>

                        <flux:input.group class="grid gap-2">
                            <div class="grid gap-2">
                                <flux:label>
                                    <flux:icon name="clock" class="inline-block mr-2" />
                                    Preparation Time
                                </flux:label>
                            <flux:input
                                wire:model="prep_time"
                                type="time"
                                required
                                autofocus
                                autocomplete="01:30"
                                :placeholder="__('01:30')"
                            />
                            </div>
                        </flux:input.group>

                        <flux:input.group class="grid gap-2">
                            <div class="grid gap-2">
                                <flux:label>
                                    <flux:icon name="chef-hat" class="inline-block mr-2" />
                                    Difficulty
                                </flux:label>
                                <flux:input
                                    wire:model="difficulty"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="01:30"
                                    :placeholder="__('Easy')"
                                />
                            </div>
                        </flux:input.group>
                    </div>

                    <div class="grid grid-cols-1 gap-10">
                        <flux:input.group class="grid gap-2">
                            <div class="grid gap-2">
                                <flux:label>
                                    <flux:icon name="book-open-text" class="inline-block mr-2" />
                                    Description
                                </flux:label>
                                <flux:textarea
                                    wire:model="description"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="Description"
                                    :placeholder="__('Write a description for your recipe')"
                                    class="h-full"
                                />
                            </div>
                        </flux:input.group>
                    </div>
                </div>
            </div> -->

            <livewire:components.create-recipe-card title="Recipe Basics" type="basics"/>
            <livewire:components.create-recipe-card title="Ingredients" type="ingredients" />
        </form>
    </div>
</div>