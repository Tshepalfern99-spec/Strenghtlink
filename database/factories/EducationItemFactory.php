<?php

namespace Database\Factories;

use App\Models\EducationItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EducationItemFactory extends Factory
{
    protected $model = EducationItem::class;

    public function definition(): array
    {
        $categories = ['awareness','rights','services'];
        $mediaTypes = ['none','video','image','infographic','link'];

        $title = $this->faker->unique()->sentence(6);
        $mediaType = $this->faker->randomElement($mediaTypes);

        // Sensible media_url based on type
        $mediaUrl = null;
        if ($mediaType === 'video') {
            $mediaUrl = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
        } elseif (in_array($mediaType, ['image','infographic'])) {
            $mediaUrl = 'https://images.unsplash.com/photo-1517022812141-23620dba5b4c?w=1200&q=80&auto=format&fit=crop';
        } elseif ($mediaType === 'link') {
            $mediaUrl = 'https://www.who.int/health-topics/violence-against-women';
        }

        // 60% published, 40% draft
        $isPublished = $this->faker->boolean(60);

        return [
            'title'            => $title,
            'slug'             => Str::slug($title) . '-' . Str::random(5),
            'summary'          => $this->faker->paragraph(),
            'body'             => $this->faker->paragraphs(6, true),
            'category'         => $this->faker->randomElement($categories),
            'media_type'       => $mediaType,
            'media_url'        => $mediaUrl,
            'video_transcript' => $mediaType === 'video' ? $this->faker->paragraphs(3, true) : null,

            // Files optional in seed data; leave null unless you want to place demo files in storage/app/public
            'cover_image_path' => null,     // e.g. 'education/covers/example.jpg'
            'download_path'    => null,     // e.g. 'education/downloads/rights_guide.pdf'

            'is_published'     => $isPublished,
            'published_at'     => $isPublished ? $this->faker->dateTimeBetween('-60 days', 'now') : null,
        ];
    }

    public function draft(): self
    {
        return $this->state(fn () => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }

    public function published(): self
    {
        return $this->state(fn () => [
            'is_published' => true,
            'published_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ]);
    }

    public function video(): self
    {
        return $this->state(fn () => [
            'media_type'       => 'video',
            'media_url'        => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'video_transcript' => 'Sample video transcript…',
        ]);
    }
}
