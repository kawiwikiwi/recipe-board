<?php

use Livewire\Volt\Component;

new class extends Component {
    
    public $steps = [];
    public $currentStep = 1;
    public $title;
    public $description;
    public $step;
    public $index;
    public $editingIndex = null;

    protected $listeners = ['stepAdded', 'removeStep', 'editStep', 'saveStep', 'cancelEdit'];

    public function stepAdded($step)
    {
        $this->steps[] = $step;
        $this->currentStep++;
    }

    public function removeStep($index)
    {
        unset($this->steps[$index]);
        $this->steps = array_values($this->steps);

        // Decrement the 'step' value for all steps after the removed one
        for ($i = $index; $i < count($this->steps); $i++) {
            if (isset($this->steps[$i]['step'])) {
                $this->steps[$i]['step'] = $this->steps[$i]['step'] - 1;
            }
        }

        // Adjust the editing index if necessary
        // If the current editing index is the one being removed, reset it
        if ($this->editingIndex === $index) {
            $this->editingIndex = null;
        } elseif ($this->editingIndex > $index) {
            $this->editingIndex--;
        }

        // Decrement the current step if the last step was removed
        $this->currentStep = count($this->steps) + 1;
    }

    public function editStep($index)
    {
        $this->editingIndex = $index;
    }

    public function cancelEdit()
    {
        $this->editingIndex = null;
    }

    public function saveStep($index, $title, $description)
    {
        $this->steps[$index]['title'] = $title;
        $this->steps[$index]['description'] = $description;
        $this->editingIndex = null;
    }

    public function render(): mixed
    {
        return view('livewire.components.recipe-forms.instructions');
    }


    
} ?>

<div class="grid grid-cols-1 gap-4">
    @if (!empty($steps))
        @foreach($steps as $index => $step)
            <livewire:components.recipe-forms.create-step-item
                :title="$step['title']"
                :description="$step['description']"
                :step="$step['step']"
                :index="$index"
                :editingIndex="$editingIndex"
                :key="$index.'-'.$editingIndex"
            />
        @endforeach
    @endif
    <livewire:components.recipe-forms.create-step 
        :currentStep="$currentStep"
        :key="'create-step-'.$currentStep"
    />

</div>