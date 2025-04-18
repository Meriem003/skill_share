<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SkillsSeeder extends Seeder
{
    public function run()
    {
        $skills = [
            ['nom' => 'programmation', 'description' => 'Compétences en programmation informatique'],
            ['nom' => 'design', 'description' => 'Compétences en design graphique et UI/UX'],
            ['nom' => 'mathematiques', 'description' => 'Compétences en mathématiques'],
            ['nom' => 'langues', 'description' => 'Compétences linguistiques'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        User::create([
            'fullname' => 'meryam',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}
