<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

new #[Layout('components.layouts.app')] class extends Component {

    public $recipes;
    public $recipe;
    public $search;
    public $toggleFilterIcon = 'outline';
    public $showFilters = false;
    public $allergyTags = [];
    public $cuisineTags = [];
    public $dietaryTags = [];

    public function getRecipes()
    {
        $this->recipes = Recipe::where('is_published', '=', 1)
            ->when($this->search != null, function ($query) {
                $query->where('title', 'LIKE', '%' . $this->search . '%')
                      ->orWhereHas('ingredient', function ($query) {
                          $query->where('name', 'LIKE', '%' . $this->search . '%');
                      })
                      ->orWhereHas('cuisineTag', function ($query) {
                          $query->where('cuisine_type', 'LIKE', '%' . $this->search . '%');
                      });
            })
            ->when(count($this->allergyTags) > 0, function ($query) {
                $query->whereHas('allergyTag', function ($query) {
                    $query->whereIn('allergy_requirement', $this->allergyTags);
                });
            })
            ->when(count($this->cuisineTags) > 0, function ($query) {
                $query->whereHas('cuisineTag', function ($query) {
                    $query->whereIn('cuisine_type', $this->cuisineTags);
                });
            })
            ->when(count($this->dietaryTags) > 0, function ($query) {
                $query->whereHas('dietaryTag', function ($query) {
                    $query->whereIn('dietary_requirement', $this->dietaryTags);
                });
            })
            ->get();
        return $this->recipes;
    }

    public function removeFilters()
    {
        $this->allergyTags = [];
        $this->cuisineTags = [];
        $this->dietaryTags = [];
        $this->search = '';
        
        $this->getRecipes();
    }

    public function mount() {
        $this->user_id = Auth::user()->id;
        $this->recipes = $this->getRecipes();
    }

    public function getRecipeTime($recipe)
    {
        if (!empty($recipe->cook_time) && !empty($recipe->prep_time)) {
            $cook = \Carbon\CarbonInterval::createFromFormat('H:i', $recipe->cook_time);
            $prep = \Carbon\CarbonInterval::createFromFormat('H:i', $recipe->prep_time);
            $total = $cook->add($prep);
            return $total->format('%H hrs %I mins');
        } elseif (!empty($recipe->cook_time)) {
            $cook = \Carbon\CarbonInterval::createFromFormat('H:i', $recipe->cook_time);
            return $cook->format('%H hrs %I mins');
        } elseif (!empty($recipe->prep_time)) {
            $prep = \Carbon\CarbonInterval::createFromFormat('H:i', $recipe->prep_time);
            return $prep->format('%H hrs %I mins');
        }
        return null;
    }

    public function toggleFilter()
    {
        $this->toggleFilterIcon = $this->toggleFilterIcon === 'outline' ? 'solid' : 'outline';
        $this->showFilters = $this->showFilters === false ? true : false;
    }
    
}; 
?>

<div class="flex flex-col gap-5 overflow-y-auto h-[calc(100vh-7.5rem)] bg-zinc-900/50 backdrop-blur-sm ">
    <div class="grid grid-cols-1 py-2 items-center ">
        <div class="relative">
            <div class="absolute top-0 left-0 bg-accent max-w-fit px-6 py-3 max-h-14 rounded-br-4xl rounded-tl-2xl">
                <h1 class="text-3xl text-white mr-1 text-shadow-md/50 text-shadow-accent-800"> Recipes </h1>
            </div>
        </div>

        <div class="flex justify-center items-center gap-4 mx-50 mt-2">
            <flux:input.group class="max-w-xl! lg:max-w-2xl!">
                <flux:input
                    placeholder="Search..."
                    clearable
                    type="search"
                    icon="magnifying-glass"
                    class=""
                    class:input="bg-zinc-900! h-12!"
                    wire:model.live="search"
                    wire:keydown.enter="getRecipes"
                >
                </flux:input>
                <flux:button
                    icon="magnifying-glass"
                    variant="primary" 
                    class="h-12!" 
                    wire:click="getRecipes"
                >
                    Search
                </flux:button>
            </flux:input.group>

            <flux:button
                icon="funnel"
                variant="filled"
                icon:variant="{{ $toggleFilterIcon }}"
                wire:click="toggleFilter" 
                class="bg-zinc-900! h-12! px-5! border-alternate-700/50!"
            />
        </div>

        <div 
            wire:show="showFilters"
            class="grid grid-cols-[2fr_min-content_1.5fr] gap-2 items-start mt-2 p-5 bg-zinc-900/50 backdrop-blur-sm border-b border-zinc-300/30"
        >
            <div class="w-full grid grid-cols-[max-content_max-content_max-content_max-content_max-content] gap-2 justify-between mt-2">
                <flux:heading class="text-xl! col-span-5!">
                    Allergies
                </flux:heading>

                <flux:checkbox value="celery" label="Celery" wire:model.live="allergyTags" />
                <flux:checkbox value="crustaceans" label="Crustaceans" wire:model.live="allergyTags" />
                <flux:checkbox value="eggs" label="Eggs" wire:model.live="allergyTags" />
                <flux:checkbox value="fish" label="Fish" wire:model.live="allergyTags" />
                <flux:checkbox value="gluten" label="Gluten" wire:model.live="allergyTags" />
                <flux:checkbox value="lupin" label="Lupin" wire:model.live="allergyTags" />
                <flux:checkbox value="milk" label="Milk" wire:model.live="allergyTags" />
                <flux:checkbox value="molluscs" label="Molluscs" wire:model.live="allergyTags" />
                <flux:checkbox value="mustard" label="Mustard" wire:model.live="allergyTags" />
                <flux:checkbox value="nuts" label="Nuts" wire:model.live="allergyTags" />
                <flux:checkbox value="peanuts" label="Peanuts" wire:model.live="allergyTags" />
                <flux:checkbox value="sesame" label="Sesame" wire:model.live="allergyTags" />
                <flux:checkbox value="soybeans" label="Soybeans" wire:model.live="allergyTags" />
                <flux:checkbox value="sulphites" label="Sulphites" wire:model.live="allergyTags" />


                <flux:heading class="text-xl! col-span-5! mt-2!">
                    Dietary Preferences
                </flux:heading>

                <flux:checkbox value="vegetarian" label="Vegetarian" wire:model.live="dietaryTags"/>
                <flux:checkbox value="vegan" label="Vegan" wire:model.live="dietaryTags"/>
                <flux:checkbox value="pescatarian" label="Pescatarian" wire:model.live="dietaryTags"/>
                <flux:checkbox value="halal" label="Halal" wire:model.live="dietaryTags"/>
                <flux:checkbox value="kosher" label="Kosher" wire:model.live="dietaryTags"/>
                <flux:checkbox value="gluten_free" label="Gluten-Free" wire:model.live="dietaryTags"/>
                <flux:checkbox value="dairy_free" label="Dairy-Free" wire:model.live="dietaryTags"/>
                <flux:checkbox value="low_calorie" label="Low Calorie" wire:model.live="dietaryTags"/>
                <flux:checkbox value="low_carb" label="Low Carb" wire:model.live="dietaryTags"/>
                <flux:checkbox value="low_fat" label="Low Fat" wire:model.live="dietaryTags"/>
                <flux:checkbox value="low_sugar" label="Low Sugar" wire:model.live="dietaryTags"/>
                <flux:checkbox value="low_sodium" label="Low Sodium" wire:model.live="dietaryTags"/>
                <flux:checkbox value="high_protein" label="High Protein" wire:model.live="dietaryTags"/>
                <flux:checkbox value="keto" label="Keto" wire:model.live="dietaryTags"/>

            </div>

            <flux:separator vertical class="mx-2" />

            <div class="flex flex-col gap-2">
                <flux:heading class="text-xl!">
                    Cuisine
                </flux:heading>
                <div class="w-full grid grid-cols-3 gap-y-2 mt-2">
                    <flux:checkbox value="african" label="African" wire:model.live="cuisineTags" />
                    <flux:checkbox value="american" label="American" wire:model.live="cuisineTags" />
                    <flux:checkbox value="brazilian" label="Brazilian" wire:model.live="cuisineTags" />
                    <flux:checkbox value="british" label="British" wire:model.live="cuisineTags" />
                    <flux:checkbox value="caribbean" label="Caribbean" wire:model.live="cuisineTags" />
                    <flux:checkbox value="chinese" label="Chinese" wire:model.live="cuisineTags" />
                    <flux:checkbox value="french" label="French" wire:model.live="cuisineTags" />
                    <flux:checkbox value="greek" label="Greek" wire:model.live="cuisineTags" />
                    <flux:checkbox value="indian" label="Indian" wire:model.live="cuisineTags" />
                    <flux:checkbox value="italian" label="Italian" wire:model.live="cuisineTags" />
                    <flux:checkbox value="japanese" label="Japanese" wire:model.live="cuisineTags" />
                    <flux:checkbox value="korean" label="Korean" wire:model.live="cuisineTags" />
                    <flux:checkbox value="mediterranean" label="Mediterranean" wire:model.live="cuisineTags" />
                    <flux:checkbox value="mexican" label="Mexican" wire:model.live="cuisineTags" />
                    <flux:checkbox value="middle-eastern" label="Middle Eastern" wire:model.live="cuisineTags" />
                    <flux:checkbox value="spanish" label="Spanish" wire:model.live="cuisineTags" />
                    <flux:checkbox value="thai" label="Thai" wire:model.live="cuisineTags" />
                    <flux:checkbox value="turkish" label="Turkish" wire:model.live="cuisineTags" />
                </div>

                <div class="flex justify-end gap-2 mt-2">
                    <flux:button
                        icon="funnel-x"
                        variant="filled"
                        size="xs"
                        wire:click="removeFilters"
                        class="bg-zinc-900! h-10! px-3! text-sm! border-none! py-2!"
                    >
                        Clear
                    </flux:button>
                    <flux:button
                        icon="funnel-plus"
                        variant="primary"
                        size="xs"
                        wire:click="getRecipes"
                        class="h-10! px-3! text-sm! border-alternate-700/50! py-2!"
                    >
                        Apply
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
    @if($recipes->isEmpty())
        <div class="flex flex-col items-center justify-center h-full">
            <p class="text-gray-500 p-10">No recipes found.</p>

        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 justify-items-center max-h-full overflow-y-auto gap-30 w-full p-10 pb-5">
            @foreach($recipes as $recipe)
                <x-recipe-card-layout>
                    <x-slot:title>
                        {{ $recipe->title }}
                    </x-slot:title>

                    <x-slot:deleteButton>
                        
                    </x-slot:deleteButton>

                    <x-slot:favourite>
                        <flux:button
                            class="h-10! w-10! p-4! bg-transparent! border-none!"
                            wire:click="toggleFavorite"
                        >
                            <flux:icon name="heart" class="text-accent-500 h-8 w-8" />
                        </flux:button>
                        <flux:heading class="text-lg!">
                            {{ $likeCount ?? 0}}
                        </flux:heading>
                    </x-slot:favourite>

                    <x-slot:recipeTime>
                        <flux:text class="text-center text-md">
                            {{ $this->getRecipeTime($recipe) ?? 'N/A' }}
                        </flux:text>
                    </x-slot:recipeTime>

                    <x-slot:recipeServes>
                        <flux:text class="text-center text-md">
                            {{ $recipe->serves ?? 'N/A' }}
                        </flux:text>
                    </x-slot:recipeServes>

                    <x-slot:actionButtons>
                        <flux:button 
                            icon="clipboard-list"
                            variant="primary"
                            size="sm"
                            wire:click="viewRecipe({{ $recipe->id }})" 
                            class="rounded-full! w-46! border! border-white!"
                        >
                            View Recipe
                        </flux:button>
                    </x-slot:actionButtons>
                </x-recipe-card-layout>
            @endforeach
        </div>
    @endif
</div>
