<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Modelable;

new class extends Component {
    public $currentStep = 1;
    public $title;
    public $description;
    public $step;
    public $index;
    public $editingIndex = null;

    #[Modelable]
    public $steps = [];

    protected $listeners = [
        'stepAdded', 
        'removeStep',
        'saveStep', 
    ];

    public function getIndexByFrontendId($frontendId)
    {
        return array_search($frontendId, array_column($this->steps, 'frontend_id'));
    }

    public function removeStep($frontendId)
    {
        $index = $this->getIndexByFrontendId($frontendId);
        array_splice($this->steps, $index, 1);
        $this->steps = array_values($this->steps);
        
        foreach ($this->steps as $key => $step) {
            if ($step['step'] > $index) {
                $this->steps[$key]['step']--;
            }
        }

        $this->currentStep = count($this->steps) + 1;
    }

    public function saveStep($stepIndex, $title, $description, $frontendId)
    {
        $index = $this->getIndexByFrontendId($frontendId);
        $this->steps[$index]['title'] = $title;
        $this->steps[$index]['description'] = $description;
        $this->steps[$index]['step'] = $stepIndex;
        $this->steps[$index]['frontend_id'] = $frontendId;
        $this->currentStep++;
    }

    public function stepAdded($stepData)
    {
        array_push($this->steps, $stepData);
        $this->currentStep++;
    }

    public function render(): mixed
    {
        return view('livewire.components.recipe-forms.instructions');
    }
} ?>

<div class="grid grid-cols-1 gap-4">
    @if (!empty($steps))
        @foreach($steps as $step)
            <livewire:components.recipe-forms.create-step-item
                :title="$step['title']"
                :description="$step['description']"
                :step="$step['step']"
                :frontendId="$step['frontend_id']"
                :key="'instruction-'.$step['frontend_id']"
            />
        @endforeach
    @endif
    <livewire:components.recipe-forms.create-step 
        :currentStep="$currentStep"
        :key="'create-step-'.$currentStep"
    />

</div>