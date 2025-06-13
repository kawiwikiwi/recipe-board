<div class="grid grid-cols-1 gap-4">
    <div class="grid grid-cols-3 mr-12">
        <flux:label>Ingredient</flux:label>
        <flux:label>Amount</flux:label>
        <flux:label>Unit</flux:label>
    </div>
    @if (!empty($added_ingredient))
        <div class="grid grid-cols-1 gap-4">
            @foreach($added_ingredient as $index => $item)
                <livewire:components.recipe-forms.create-list-item
                    :ingredient="$item['ingredient']"
                    :amount="$item['amount']"
                    :unit="$item['unit']"
                    :index="$index"
                    :key="$index"
                />
            @endforeach
        </div>
    @endif
    <flux:field>
        <flux:input.group class="items-end">
            <flux:input
                wire:model="ingredient"
                type="text"
                required
                autofocus
                autocomplete="01:30"
                :placeholder="__('Tomato')"
                class=""
            />
            <flux:input
                wire:model="amount"
                type="text"
                required
                autofocus
                autocomplete="01:30"
                :placeholder="__('2')"
            />
            <flux:input
                wire:model="unit"
                type="text"
                required
                autofocus
                autocomplete="01:30"
                :placeholder="__('kg')"
            />
            <flux:button class="px-6 h-full text-white" icon="plus" variant="primary" wire:click="addIngredient"></flux:button>
        </flux:input.group>
    </flux:field>
</div>

