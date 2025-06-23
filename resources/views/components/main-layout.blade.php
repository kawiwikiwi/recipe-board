<div class="flex items-start justify-center animate-flip-up h-[calc(100vh_-_7.5rem)]">
    <div class="w-full border border-alternate-600/20 rounded-2xl max-h-[calc(100vh_-_6.75rem)] flex flex-col max-w-7xl bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm">
        <div class="bg-accent bg-clip-border border-top-none rounded-t-2xl border-b-6 border-b-accent-900 shadow-xl pb-5 pt-10 px-14 ">
            
            {{ $backButton }}

            <div class="items-center flex justify-between">
                <div class="flex items-center justify-center ">
                    <h1 class="-mb-2 text-3xl md:text-[2.75rem] text-shadow-lg text-shadow-accent-700 text-white text-center  font-stretch-ultra-expanded font-bold">{{ $title }}</h1>
                </div>
                <div class="flex flex-nowrap gap-3 sm:-mb-5  md:-mb-5 lg:-mb-7 ">
                    {{ $headerButtons }}
                </div>
            </div>
        </div>

        {{ $content }}
        
    </div>
</div>