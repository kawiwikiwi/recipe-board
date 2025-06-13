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
            <flux:button class="px-6" variant="danger" icon="x-mark" wire:click="remove"></flux:button>
        </flux:input.group>
    </flux:field>
</div>