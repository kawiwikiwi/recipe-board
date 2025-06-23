<div class="flex items-start justify-center animate-flip-up h-[calc(100vh_-_7.5rem)]">
    <div class="w-full border border-alternate-600/20 rounded-2xl max-h-[calc(100vh_-_6.75rem)] flex flex-col max-w-4xl bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm">
        <div class="bg-accent bg-clip-border border-top-none rounded-t-2xl border-b-6 border-b-accent-900 shadow-xl pb-5 pt-10 px-14 ">
            
            <flux:button 
                wire:click="redirectToDashboard"
                icon="arrow-uturn-left" 
                variant="ghost" 
                class="absolute! left-0! text-white! top-0! py-5! px-7! h-12! inset-shadow-md bg-accent-700/50! hover:bg-[color-mix(in_oklab,_var(--color-accent-700),_transparent_10%)]! rounded-bl-none rounded-tr-none rounded-br-3xl rounded-tl-2xl!"
            >
            </flux:button>

            <div class="items-center flex justify-between">
                <div class="flex items-center justify-center ">
                    <h1 class="-mb-2 text-[2.75rem] text-shadow-lg text-shadow-accent-700 text-white text-center  font-stretch-ultra-expanded font-bold">Settings</h1>
                </div>
                <div class="flex flex-nowrap gap-3 -mb-10 ">
                    
                </div>
            </div>
        </div>

        <div class="p-4 flex items-start max-md:flex-col">
            <div class="me-10 w-full pb-4 md:w-[220px]">
                <flux:navlist>
                    <flux:navlist.item :href="route('settings.profile')" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('settings.password')" wire:navigate>{{ __('Password') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('settings.appearance')" wire:navigate>{{ __('Appearance') }}</flux:navlist.item>
                </flux:navlist>
            </div>

            <flux:separator class="md:hidden" />

            <div class="flex-1 self-stretch max-md:pt-6">
                <flux:heading class="text-xl!">{{ $heading ?? '' }}</flux:heading>
                <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

                <div class="mt-5 w-full max-w-lg pb-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
        
    </div>
</div>
