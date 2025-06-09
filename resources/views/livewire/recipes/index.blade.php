<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\User;
use App\Models\Recipe;


new #[Layout('components.layouts.app')] class extends Component {
    public $recipes;
    public $user;

    public function render(): mixed
    {
        return view('livewire.recipes.index');
    }

    public function mount() {
        $this->user_id = Auth::user()->id;
        $this->recipes = Recipe::where('user_id', $this->user_id)->get();
    }

    public function redirectToAddRecipe(){
        $this->redirect(route('recipes.create', absolute:false), navigate:true);
    }
}; ?>

<div class="bg-[#0B0B0B]/40 min-h-full flex items-start justify-center">
    <div class="w-full p-15 flex flex-col gap-6 max-w-7xl">
        <div class="flex justify-between">
            <div class="flex mb-8 items-center justify-center ">
                <h1 class="text-4xl text-center font-semibold">My Recipes</h1>
            </div>
            <flux:button class="border-l! border-l-solid! border-l-white! border-t! border-t-solid! border-t-white! border-b! border-b-solid! border-b-white!" wire:click="redirectToAddRecipe">
                Add New Recipe
            </flux:button>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />
        
        <div class="flex flex-col gap-6">
            <div class="w-full flex flex-row gap-6">
                <div class="w-full grid items-start justify-items-center grid-cols-1 gap-4 ">
                    
                    @if($recipes->isEmpty())
                        <p class="text-gray-500 p-10">No recipes added.</p>
                    @else
                        <div class="grid grid-cols-1 gap-x-10 w-full px-10 pb-5">
                            @foreach($recipes as $recipe)
                                <livewire:components.recipe-card />
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>