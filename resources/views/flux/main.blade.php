@props([
    'container' => null,
])

@php
$classes = Flux::classes('[grid-area:main]')
    ->add('px-6 py-6 lg:px-8 lg:py-8 bg-zinc-100 dark:bg-zinc-900 bg-[url(/public/assets/chef_background.svg)] bg-repeat bg-center h-screen-minus-header overflow-y-hidden') 
    ->add('[[data-flux-container]_&]:px-0') // If there is a wrapping container, let IT handle the x padding...
    ->add($container ? 'mx-auto w-full [:where(&)]:max-w-7xl' : '')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-main>
    {{ $slot }}
</div>
