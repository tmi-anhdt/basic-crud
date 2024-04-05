<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\TaskForm;
use App\Models\Task;
use LivewireUI\Modal\ModalComponent;

class TaskModal extends ModalComponent
{
    public ?Task $task = null;
    public TaskForm $form;

    public function mount(Task $task = null)
    {
        if ($task->exists) {
            $this->form->setTask($task);
        }
    }

    public function save()
    {
        $this->form->save();

        $this->closeModal();

        $this->dispatch('refresh-list');
    }

    public function render()
    {
        return view('livewire.modal.task-modal');
    }
}