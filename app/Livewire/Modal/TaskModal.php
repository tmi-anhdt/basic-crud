<?php

namespace App\Livewire\Modal;

use App\Models\Task;
use Livewire\Component;

class TaskModal extends Component
{
    public ?Task $task = null;
    public string $content = '';
    public string $status = 'In-progress';
    public $isOpen = true;
    public function mount(Task $task = null)
    {
        if ($task->exists) {
            $this->task = $task;
            $this->content = $task->content;
            $this->status = $task->status;
        }
    }
    public function create()
    {
        $this->openModal();
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }
    public function store()
    {
        dd("store");
    }

    public function validationAttributes()
    {
        return [
            'content' => 'content',
            'status' => 'status',
        ];
    }
    public function save()
    {
        $this->validate();

        if (empty($this->task)) {
            Task::create($this->only(['content', 'status']));
        } else {
            $this->task->update($this->only(['content', 'status']));
        }

        $this->reset();

        $this->closeModal();

        $this->dispatch('refresh-list');
    }
    public function rules()
    {
        return [
            'content' => 'bail|required|unique:tasks,content,NULL,id,user_id,' . auth()->id(),
            'status' => 'bail|required|in:In-progress,Completed,Canceled',
        ];
    }
    public function render()
    {
        return view('livewire.modal.task-modal');
    }
}