<div class="flex items-start justify-center animate-flip-up">
    <div class="w-full border border-alternate-600/20 rounded-2xl max-h-[91vh] flex flex-col max-w-7xl pb-6 bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm h-screen">
        <div class="bg-accent bg-clip-border border-top-none rounded-t-2xl border-b-6 border-b-accent-900 shadow-xl pb-5 pt-10 px-14 ">
            
            {{ $backButton }}

            <div class="items-center flex justify-between">
                <div class="flex items-center justify-center ">
                    <h1 class="-mb-2 text-[2.75rem] text-shadow-lg text-shadow-accent-700 text-white text-center  font-stretch-ultra-expanded font-bold">{{ $title }}</h1>
                </div>
                <div class="flex flex-nowrap gap-3 -mb-10 ">
                    {{ $headerButtons }}
                </div>
            </div>
        </div>

        {{ $content }}
        
    </div>
</div>