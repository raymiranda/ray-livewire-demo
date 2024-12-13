<?php

namespace App\Livewire;

use App\Models\Todo;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TodoTask extends Component
{
    public string $name;

    public string $description = '';

    public string $task_date;

    public string $task_time;

    public function addTask()
    {
        $this->resetErrorBag();

        $this->validate([
            'name' => 'required|max:255',
            'description' => 'string|nullable',
            'task_date' => 'required|date_format:Y-m-d',
            'task_time' => 'required|date_format:H:i',
        ], [
            'name.required' => 'Task name is required',
            'name.max' => 'Task name must be less than 255 characters',
            'task_date.required' => 'Task date is required',
            'task_date.date_format' => 'Task date format is invalid. Use Y-m-d.',
            'task_time.required' => 'Task time is required',
            'task_time.date_format' => 'Task time format is invalid. Use H:i.',
        ]);

        $task_datetime = $this->task_date.' '.$this->task_time;

        try {
            Todo::create([
                'task_datetime' => $task_datetime,
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->reset();

            $this->showMessage('success', 'Task added successfully.');

            // Note if the reset is done after this, the success message will not be displayed

        } catch (\Exception $e) {
            $this->showMessage('error', 'An error occurred while adding the task. Please try again.');
            Log::error($e->getMessage());
        }
    }

    public function completeTask($id)
    {
        try {
            $task = Todo::findOrFail($id);
            $task->is_done = 1;
            $task->save();

            $this->showMessage('success', 'Task completed successfully.');

        } catch (\Exception $e) {
            $this->showMessage('error', 'An error occurred while completing the task. Please try again.');
            Log::error($e->getMessage());
        }
    }

    public function deleteTask($id)
    {
        try {
            $task = Todo::findOrFail($id);
            $task->delete();

            $this->showMessage('success', 'Task deleted successfully.');

        } catch (\Exception $e) {
            $this->showMessage('error', 'An error occurred while deleting the task. Please try again.');
            Log::error($e->getMessage());
        }
    }

    private function showMessage(string $type, string $message)
    {
        if ($type === 'error') {
            session()->flash('task-submit-error', $message);
        } else {
            session()->flash('task-submit-success', $message);
        }
    }

    public function render()
    {
        $todos = Todo::all();

        return view('livewire.todo-task', compact('todos'));
    }
}
