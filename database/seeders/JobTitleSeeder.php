<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobTitleSeeder extends Seeder
{
    function getInitial($name): string
    {
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper($word[0]);
        }
        return $initials;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobTitles = [
            'Senior Manager',
            'General Manager',
            'Director General',
            'Division Manager',
            'Assistant Manager'
        ];
        foreach ($jobTitles as $jobTitle) {

            \App\Models\JobTitle::query()->updateOrCreate([
                'name' => $jobTitle,
                'abbreviation' => $this->getInitial($jobTitle)
            ]);
        }
    }
}
