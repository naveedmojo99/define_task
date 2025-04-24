<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['Laravel', 'PHP', 'Wellness', 'Coding', 'Adventure', 'Tips', 'Fitness', 'Tutorials'];

        foreach ($tags as $name) {
            Tag::create(['name' => $name]);
        }
    }
}
