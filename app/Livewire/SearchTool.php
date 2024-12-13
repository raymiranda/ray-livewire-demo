<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class SearchTool extends Component
{
    use WithPagination;

    public string $search = '';

    public bool $showSuccessMessage = false;

    public bool $showErrorMessage = false;

    public string $successMessage = '';

    public string $errorMessage = '';

    #[Layout('components.layouts.app-v3')]
    public function render()
    {
        return view('livewire.search-tool', [
            'users' => User::search($this->search)->get(),
        ]);
    }
}
