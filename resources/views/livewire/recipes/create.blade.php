<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;



new #[Layout('components.layouts.app')] class extends Component {


    public $basics = [];
    public $ingredients = [];
    public $instructions = [];
    public $dietary_tags = [];
    public $allergy_tags = [];
    public $cuisine_tags = [];

    public $user_id;

    public $listeners = [
        'setBasicsData',
    ];
    
    public function render(): mixed
    {
        return view('livewire.recipes.create');
    }

    public function redirectToMyRecipes()
    {
        $this->redirect(route('recipes.index', absolute: false), navigate: true);
    }

    public function saveRecipe()
    {
        $validated = $this->validate([
            'basics.title' => 'required|string|max:255',
            'basics.makes' => 'nullable|integer',
            'basics.serves' => 'nullable|integer',
            'basics.cook_time' => 'nullable|integer',
            'basics.prep_time' => 'nullable|integer',
            'basics.difficulty' => 'required|string|max:50',
            'basics.description' => 'nullable|string|max:1000',
        ]);

        $this->user_id = Auth::user()->id;
        logger(Auth::user());

        $recipe = Recipe::create([
            'user_id' => $this->user_id,
            'title' => $validated['basics']['title'],
            'makes' => $validated['basics']['makes'] ?? null,
            'serves' => $validated['basics']['serves'] ?? null,
            'cook_time' => $validated['basics']['cook_time'] ?? null,
            'prep_time' => $validated['basics']['prep_time'] ?? null,
            'difficulty' => $validated['basics']['difficulty'],
            'description' => $validated['basics']['description'] ?? null,
            'is_published' => false,
        ]);
    }
}; ?>

<div class="flex items-start justify-center animate-flip-up">
    <div class="w-full border border-alternate-600/20 rounded-2xl max-h-[91vh] flex flex-col max-w-7xl pb-6 bg-white/80 dark:bg-zinc-900/50 backdrop-blur-sm h-screen">
        <div class="bg-accent bg-clip-border border-top-none rounded-t-2xl shadow-xl pb-6 pt-10 px-14 ">
            <flux:button x-on:click="$flux.modal('leave-page').show()" icon="arrow-uturn-left" variant="ghost" class="absolute! left-0! top-0! py-5! px-7! bg-accent-700/50! hover:bg-[color-mix(in_oklab,_var(--color-accent-700),_transparent_10%)]! rounded-bl-none rounded-tr-none rounded-br-3xl rounded-tl-2xl!" size="sm">
       
            </flux:button>
            <div class="items-center flex justify-between">
                <div class="flex items-center justify-center ">
                    <h1 class="text-4xl text-white text-center text-shadow-lg/50 text-shadow-accent-800 font-stretch-ultra-expanded font-bold">Create Your Recipe</h1>
                </div>
                <div class="flex flex-nowrap gap-3">
                    <flux:button icon="save" class="border! border-accent-50! bg-accent-700/50! hover:bg-[color-mix(in_oklab,_var(--color-accent-700),_transparent_10%)]! text-white!" size="sm" wire:click="saveRecipe">
                        Save
                    </flux:button>
                    <flux:button icon="wand-sparkles" class="border! border-accent-50! bg-alternate-600! hover:bg-[color-mix(in_oklab,_var(--color-alternate-700),_transparent_10%)]!" size="sm" wire:click="publishRecipe">
                        Publish
                    </flux:button>
                </div>
            </div>
        </div>

        <flux:modal name="leave-page" class="border-2 border-accent! min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Are you sure you want to leave this page?</flux:heading>

                    <flux:text>Any unsaved changes will be lost.</flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />
                    
                    <flux:button x-on:click="$flux.modal('leave-page').close()" variant="ghost" size="sm">Cancel</flux:button>

                    <flux:button variant="primary" size="sm" wire:click="redirectToMyRecipes">
                        Leave Page
                    </flux:button>
                </div>
            </div>
        </flux:modal>

        <form class="mx-14 grid grid-cols-1 pt-10 gap-10 flex-1 overflow-y-scroll">
            <livewire:components.create-recipe-card title="Recipe Basics" type="basics" wire:model="basics"/>
            <livewire:components.create-recipe-card title="Ingredients" type="ingredients"/>
            <livewire:components.create-recipe-card title="Instructions" type="instructions" />
            <livewire:components.create-recipe-card title="Tags" type="tags" />
        </form>
    </div>
</div>
