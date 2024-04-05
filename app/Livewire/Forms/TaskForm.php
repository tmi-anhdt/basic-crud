<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Livewire\Form;

class TaskForm extends Form
{
    public ?Task $task = null;
    public string $content = '';
    public string $status = 'In-progress';

    public function setTask(?Task $task = null)
    {
        $this->task = $task;
        $this->content = $task->content;
        $this->status = $task->status;
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
    }

    public function rules()
    {
        return [
            'content' => $this->task ? 'bail|required' : 'bail|required|unique:tasks,content,NULL,id,user_id,' . auth()->id(),
            'status' => 'bail|required|in:In-progress,Completed,Canceled',
        ];
    }

    public function validationAttributes()
    {
        return [
            'content' => 'content',
            'status' => 'status',
        ];
    }
}