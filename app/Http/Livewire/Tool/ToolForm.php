<?php

namespace App\Http\Livewire\Tool;

use Livewire\Component;
use App\Models\Tool;
use App\Models\Department;

class ToolForm extends Component
{
    public $toolId, $name;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'toolId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function toolId($toolId)
    {
        $this->toolId = $toolId;
        $tool = Tool::whereId($toolId)->first();
        $this->name = $tool->name;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'name' => 'required',
        ]);

        if ($this->toolId) {
            $tool = Tool::find($this->toolId);
            $tool->update([
                'name' => $this->name,
            ]);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Tool::create([
                'name' => $this->name,
            ]);
            $action = 'edit';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeToolModal');
        $this->emit('refreshParentTool');
        $this->emit('refreshTable');
    }

    public function render()
    {
     
        return view('livewire.tool.tool-form');
    }
}
