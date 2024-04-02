<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tasks extends Component
{
    use WithPagination;
    public ?Task $task = null;
    public string $content = '';
    public string $status = 'In-progress';
    public $openModal = false;
    public function create()
    {
        $this->resetAttributes();
        $this->openModal();
    }
    public function openModal()
    {
        $this->openModal = true;
    }
    public function closeModal()
    {
        $this->resetValidation();
        $this->openModal = false;
    }
    public function resetAttributes()
    {
        $this->task = null;
        $this->content = '';
        $this->status = 'In-progress';
    }
    public function edit(Task $task = null)
    {
        if ($task->exists) {
            $this->task = $task;
            $this->content = $task->content;
            $this->status = $task->status;
        }
        $this->openModal();
    }
    public function save()
    {
        $this->validate();

        if (empty($this->task)) {
            Task::create([
                'content' => $this->content,
                'status' => $this->status,
                'user_id' => auth()->user()->id,
            ]);
            session()->flash('success', 'Task created successfully.');
        } else {
            $this->task->update($this->only(['content', 'status']));
            session()->flash('success', 'Task updated successfully.');
        }

        $this->reset();

        $this->closeModal();

        // $this->dispatch('refresh-list');
    }
    public function delete(Task $task)
    {
        if (empty($task))
            session()->flash('error', 'Task not found');
        $task->delete();
    }
    public function rules()
    {
        return [
            'content' => $this->task ? 'bail|required' : 'bail|required|unique:tasks,content,NULL,id,user_id,' . auth()->id(),
            'status' => 'bail|required|in:In-progress,Completed,Canceled',
        ];
    }
    public function validationAttributes(): array
    {
        return [
            'content' => 'content',
            'status' => 'status',
        ];
    }
    public function render()
    {
        $tasks = Auth::user()->tasks()->paginate(5);

        return view('livewire.tasks.tasks', [
            'records' => $tasks,
            'i' => (request()->input('page', 1) - 1) * 5,
        ]);
    }
}
