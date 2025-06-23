<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Modelable;



new class extends Component
{
    #[Modelable]
    public $basics = [];
  
}?>

<div class="grid grid-cols-1 gap-6">
    <div class="grid grid-cols-2 lg:grid-cols-9 gap-5">
        <flux:input.group class="col-span-2 lg:col-span-7 grid gap-2">
            <div class="grid gap-2">
                <flux:label>
                    <flux:icon name="pencil" class="inline-block mr-2 size-5" />
                    Recipe Title
                </flux:label>
                <flux:input
                    wire:model.live="basics.title"
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
                    <flux:icon name="utensils" class="inline-block mr-2 size-5" />
                    Makes
                </flux:label>
                <flux:input
                    wire:model.live="basics.makes"
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
                    <flux:icon name="user-round" class="inline-block mr-2 size-5" />
                    Serves
                </flux:label>
            <flux:input
                wire:model.live="basics.serves"
                type="number"
                required
                autofocus
                autocomplete="4"
                :placeholder="__('4')"
            />
            </div>
        </flux:input.group>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <flux:input.group class="grid gap-2">
            <div class="grid gap-2">
                <flux:label>
                    <flux:icon name="clock" class="inline-block mr-2 size-5" />
                    Cooking Time
                </flux:label>
                <flux:input
                    wire:model.live="basics.cook_time"
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
                    <flux:icon name="clock" class="inline-block mr-2 size-5" />
                    Preparation Time
                </flux:label>
            <flux:input
                wire:model.live="basics.prep_time"
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
                    <flux:icon name="chef-hat" class="inline-block mr-2 size-5" />
                    Difficulty
                </flux:label>
                <flux:select
                    wire:model.live="basics.difficulty"
                    required
                    autofocus
                >
                    <flux:select.option value="" disabled selected class="placeholder">Select Difficulty</flux:select.option>
                    <flux:select.option value="easy">Beginner</flux:select.option>
                    <flux:select.option value="medium">Intermediate</flux:select.option>
                    <flux:select.option value="hard">Advanced</flux:select.option>
                    <flux:select.option value="expert">Expert</flux:select.option>
                    <flux:select.option value="master">Master Chef</flux:select.option>
                </flux:select>
            </div>
        </flux:input.group>
    </div>

    <div class="grid grid-cols-1 gap-10">
        <flux:input.group class="grid gap-2">
            <div class="grid gap-2">
                <flux:label>
                    <flux:icon name="book-open-text" class="inline-block mr-2 size-5" />
                    Description
                </flux:label>
                <flux:textarea
                    wire:model.live="basics.description"
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