<?php

namespace App\Http\Livewire\Tool;

use Livewire\Component;
use App\Models\ToolName;
use App\Models\Department;

class ToolForm extends Component
{
    public $toolNameId, $description;
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
        $this->status = $tool->status;
        $this->quantity = $tool->quantity;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'category' => 'required',
            'name' => 'required',
        ]);

        if ($this->toolId) {
            $tool = Tools::find($this->toolId);
            $tool->update([
                'name' => $this->name,
                // 'status' => $this->status,
                'quantity' => $this->quantity,
            ]);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Tools::create([
                'name' => $this->name,
                // 'status' => $this->status,
                'quantity' => $this->quantity,
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
