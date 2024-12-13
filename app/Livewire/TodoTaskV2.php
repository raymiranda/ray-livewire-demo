<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;

class TodoTaskV2 extends Component
{
    public string $name;
    public string $description = '';
    public string $task_date;
    public string $task_time;
    public bool $showSuccessMessage = false;
    public bool $showErrorMessage = false;
    public string $successMessage = '';
    public string $errorMessage = '';

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

        $task_datetime = $this->task_date . ' ' . $this->task_time;

        try {
            Todo::create([
                'task_datetime' => $task_datetime,
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->reset();

            $this->showMessage('success', 'Task added successfully.');

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
            $this->showErrorMessage = true;
            $this->errorMessage = $message;
        } else {
            $this->showSuccessMessage = true;
            $this->successMessage = $message;
        }
    }

    #[Layout('components.layouts.app-v2')]
    public function render()
    {
        $todos = Todo::all();

        return view('livewire.todo-task-v2', compact('todos'));
    }
}