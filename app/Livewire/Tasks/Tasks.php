<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Tasks extends Component
{
    use WithPagination;

    public function delete(?Task $task)
    {
        if (empty($task))
            session()->flash('error', 'Task not found');
        $task->delete();

        $this->reset();
    }

    public function render()
    {
        $tasks = Auth::user()->tasks()->paginate(5);

        return view('livewire.tasks.tasks', [
            'records' => $tasks,
            'i' => (request()->input('page', 1) - 1) * 5,
        ]);
    }

    #[On('refresh-list')]
    public function refresh()
    {
    }
}