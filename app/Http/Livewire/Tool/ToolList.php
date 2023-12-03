<?php

namespace App\Http\Livewire\Tool;

use App\Models\ToolName;
use App\Models\Status;
use Livewire\Component;
use App\Models\Department;

class ToolList extends Component
{
    public $toolId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentToolName' => '$refresh',
        'deleteToolName',
        'editToolName',
        'deleteConfirmToolName'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createToolName()
    {
        $this->emit('resetInputFields');
        $this->emit('openToolNameModal');
    }

    public function editToolName($toolId)
    {
        $this->toolId = $toolId;
        $this->emit('toolId', $this->toolId);
        $this->emit('openToolNameModal');
    }

    public function deleteToolName($toolId)
    {
        ToolName::destroy($toolId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $toolnames  = ToolName::all();
        } else {
            $toolnames  = ToolName::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.tool.tool-list', [
            'toolnames' => $toolnames,
        ]);
    }
}
