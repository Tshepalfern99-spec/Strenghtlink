<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EducationItem;
use App\Models\EducationQuiz; // enable if you have it

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        // 12 mixed items
        EducationItem::factory()->count(6)->published()->create();
        EducationItem::factory()->count(3)->draft()->create();
        EducationItem::factory()->count(3)->video()->published()->create();

        
       
        $withQuiz = EducationItem::published()->inRandomOrder()->take(2)->get();
        foreach ($withQuiz as $item) {
            $quiz = \Database\Factories\EducationQuizFactory::new()->make()->toArray();
            $item->quiz()->create($quiz);
        }
       

        // (Optional) Put example files in storage to test cover/download rendering:
         \Storage::disk('public')->put('education/covers/demo.jpg', file_get_contents('https://picsum.photos/800/400'));
        \Storage::disk('public')->put('education/downloads/rights_guide.pdf', '%PDF-1.3 test ...');
        EducationItem::first()?->update([
             'cover_image_path' => 'education/covers/demo.jpg',
           'download_path'    => 'education/downloads/rights_guide.pdf',
        ]);
    }
}
