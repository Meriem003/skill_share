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
            ['nom' => 'Python', 'description' => 'Compétences en programmation informatique'],
            ['nom' => 'Java', 'description' => 'Compétences en design graphique et UI/UX'],
            ['nom' => 'c', 'description' => 'Compétences en mathématiques'],
            ['nom' => 'Laravel', 'description' => 'Compétences linguistiques'],
            ['nom' => 'JavaScript', 'description' => 'Compétences en mathématiques'],
            ['nom' => 'React', 'description' => 'Compétences linguistiques'],
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
