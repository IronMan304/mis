<?php

namespace App\Http\Livewire\Tool;

use App\Models\Department;
use App\Models\Tool;
use Livewire\Component;

class ToolList extends Component
{
    public $toolId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentTool' => '$refresh',
        'deleteTool',
        'editTool',
        'deleteConfirmTool'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createTool()
    {
        $this->emit('resetInputFields');
        $this->emit('openToolModal');
    }

    public function editTool($toolId)
    {
        $this->toolId = $toolId;
        $this->emit('toolId', $this->toolId);
        $this->emit('openToolModal');
    }

    // public function setResult($toolId)
    // {
    //     $this->toolId = $toolId;
    //     $this->emit('toolId', $this->toolId);
    //     $this->emit('openResultModal');
    // }

    public function deleteTool($toolId)
    {
        Tool::destroy($toolId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $tools  = Tool::all();
        } else {
            $tools  = Tool::where('name', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.tool.tool-list', [
            'tools' => $tools
        ]);
    }
}
