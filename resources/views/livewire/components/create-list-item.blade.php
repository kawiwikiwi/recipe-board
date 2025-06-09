<div>
    <flux:field>
        <flux:input.group class="items-end">
            <flux:input
                type="text"
                :value="$ingredient"
                readonly
            />
            <flux:input
                type="text"
                :value="$amount"
                readonly
            />
            <flux:input
                type="text"
                :value="$unit"
                readonly
            />
            <flux:button class="px-2" icon="x-mark" color="danger" wire:click="remove"></flux:button>
        </flux:input.group>
    </flux:field>
</div>

<!-- <flux:input.group class="items-end">
                    <flux:input
                        wire:model="ingredient"
                        type="text"
                        required
                        label="Ingredient"
                        autofocus
                        autocomplete="01:30"
                        :placeholder="__('Tomato')"
                        class=""
                    />
                    <flux:input
                        wire:model="amount"
                        type="text"
                        required
                        label="Amount"
                        autofocus
                        autocomplete="01:30"
                        :placeholder="__('Tomato')"
                    />
                    <flux:input
                        wire:model="unit"
                        type="text"
                        required
                        label="Unit"
                        autofocus
                        autocomplete="01:30"
                        :placeholder="__('Tomato')"
                    />
                    <flux:button class="px-2" icon="plus" wire:click="addIngredient"></flux:button>
                </flux:input.group> -->
