<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin="anonymous" />
        <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Afacad:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet"></link>  
    </head>
    <body class="h-screen-minus-header bg-white dark:bg-zinc-800">
        <flux:header container class="h-4! sticky top-0 w-full border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <a href="{{ route('dashboard') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <img src="/assets/logo.png" class="w-15 fill-current text-black dark:text-white" />
                <div class="font-[Aclonica] font-medium text-[#3F2D20] dark:text-white text-shadow-md">
                    <p class="text-m -mb-3 ml-4">The</p>
                    <p class="text-2xl">Recipe Board</p>
                </div>
            </a>

            <flux:spacer />

            <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item 
                        class="!h-10 [&>div>svg]:size-5" 
                        icon="magnifying-glass" 
                        :href="route('recipes.search')"
                        wire:navigate 
                        :label="__('Search')" />
                </flux:tooltip>

                <flux:tooltip :content="__('Favourite Recipes')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="heart"
                        :href="route('recipes.favourites')"
                        wire:navigate
                        label="Favourite Recipes"
                    />
                </flux:tooltip>
                
                <flux:tooltip :content="__('My Recipes')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="book-open-text"
                        :href="route('recipes.index')"
                        wire:navigate
                        label="My Recipes"
                    />
                </flux:tooltip>

                @if(auth()->user()->is_admin)
                    <flux:tooltip :content="__('Admin Recipes')" position="bottom">
                        <flux:navbar.item 
                            class="!h-10 [&>div>svg]:size-5" 
                            icon="shield-check" 
                            :href="route('recipes.admin-index')"
                            wire:navigate 
                            :label="__('Admin Recipes')" />
                    </flux:tooltip>
                @endif
            </flux:navbar>

            <!-- Desktop User Menu -->
            <flux:dropdown position="top" align="end">
                <flux:profile
                    class="cursor-pointer"
                    :initials="auth()->user()->initials()"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <flux:navlist.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            
        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
