<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'The Future of Laravel in 2025',
                'description' => 'A detailed look at where Laravel is heading and what to expect.',
                'image' => 'articles/laravel-future.jpg',
                'category_name' => 'Technology',
                'tag_names' => ['Laravel', 'PHP', 'Coding'],
            ],
            [
                'title' => '10 Best Wellness Habits for 2025',
                'description' => 'Simple habits that can drastically improve your well-being.',
                'image' => 'articles/wellness-habits.jpg',
                'category_name' => 'Health',
                'tag_names' => ['Wellness', 'Fitness'],
            ],
            [
                'title' => 'Top 5 Places to Visit in 2025',
                'description' => 'These destinations are a must-see for travel lovers.',
                'image' => 'articles/travel-2025.jpg',
                'category_name' => 'Travel',
                'tag_names' => ['Adventure', 'Tips'],
            ],
        ];

        foreach ($articles as $data) {
            // Find related category
            $category = Category::where('name', $data['category_name'])->first();

            // Create the article
            $article = Article::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'image' => $data['image'],
                'category_id' => $category?->id,
            ]);

            // Attach related tags
            $tagIds = Tag::whereIn('name', $data['tag_names'])->pluck('id');
            $article->tags()->sync($tagIds);
        }
    }
}
