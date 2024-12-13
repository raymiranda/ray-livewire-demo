<?php

namespace Database\Seeders;

use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Todo::create([
                'task_datetime' => Carbon::now()->addDays($i),
                'name' => 'Task ' . $i,
                'description' => 'Description for task ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
