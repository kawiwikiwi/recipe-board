<div class="grid grid-cols-1 gap-4">
    <div class="flex gap-10 w-full overflow-visible">
        <div class="w-12 h-12 rounded-full bg-accent flex shrink-0 items-center justify-center">
            <span class="text-white font-semibold text-2xl">1</span>
        </div>
        <div class="grid grid-cols-1 w-full">
            <div class="grid">
                <flux:input.group>
                    <flux:input
                        wire:model="title"
                        required
                        autofocus
                        autocomplete="01:30"
                        :placeholder="__('Title')"
                        class:input="border-b-0 rounded-b-none"
                    />
                    <flux:button icon="plus" class="px-6 border-b-0 rounded-b-none"></flux:button>
                </flux:input.group>

                <flux:textarea
                    wire:model="instructions"
                    required
                    autofocus
                    autocomplete="01:30"
                    :placeholder="__('Write your instructions here...')"
                    class="border-t-0 rounded-t-none"
                />
            </div>
        </div>
    </div>
</div>