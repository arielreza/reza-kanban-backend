<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password123'),
        ]);

        User::factory()->create([
            'name' => 'Testing Member',
            'email' => 'user1@example.com',
            'password' => bcrypt('password123'),
        ]);

        $tasks = [
            [
                'title' => 'Menyiapkan kebutuhan aplikasi',
                'description' => 'Analisis kebutuhan sistem',
                'priority' => 'Medium',
                'status' => 'Backlog',
                'deadline' => '2026-07-15',
            ],
            [
                'title' => 'Membuat desain halaman',
                'description' => 'Desain UI/UX di Figma',
                'priority' => 'High',
                'status' => 'Backlog',
                'deadline' => '2026-07-16',
            ],
            [
                'title' => 'Membuat halaman login',
                'description' => 'Slicing halaman login',
                'priority' => 'High',
                'status' => 'To Do',
                'deadline' => '2026-07-18',
            ],
            [
                'title' => 'Membuat layout kanban',
                'description' => 'Bikin grid 4 kolom',
                'priority' => 'Medium',
                'status' => 'To Do',
                'deadline' => '2026-07-19',
            ],
            [
                'title' => 'Membuat fitur tambah card',
                'description' => 'Fungsi CRUD tambah data',
                'priority' => 'High',
                'status' => 'In Progress',
                'deadline' => '2026-07-20',
            ],
            [
                'title' => 'Setup project awal',
                'description' => 'Inisialisasi Vite + React',
                'priority' => 'Low',
                'status' => 'Done',
                'deadline' => '2026-07-10',
            ],
        ];

        foreach ($tasks as $task) {
            \App\Models\Task::create(array_merge($task, ['user_id' => $admin->id]));
        }
    }
}
