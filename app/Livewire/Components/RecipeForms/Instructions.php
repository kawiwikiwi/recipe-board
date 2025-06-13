<?php

namespace App\Livewire\Components\RecipeForms;

use Livewire\Component;

class Instructions extends Component
{
    
    public $steps = [];
    public $title;
    public $description;
    public $currentStep = 1;

    public function addStep()
    {
        $this->steps[] = [
            'step' => $this->currentStep,
            'title' => $this->title,
            'description' => $this->description,
        ];

        // Clear input fields
        $this->title = '';
        $this->description = '';
        $this->currentStep++;
    }

    public function removeStep($index)
    {
        unset($this->steps[$index]);
        $this->steps = array_values($this->steps);
        
        // Re-index steps
        foreach ($this->steps as $i => $step) {
            $this->steps[$i]['step'] = $i + 1;
        }
    }
    public function render()
    {
        return view('livewire.components.recipe-forms.instructions');
    }
}
