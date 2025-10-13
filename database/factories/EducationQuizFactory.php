<?php

namespace Database\Factories;

use App\Models\EducationQuiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationQuizFactory extends Factory
{
    protected $model = EducationQuiz::class;

    public function definition(): array
    {
        return [
            'title'     => 'Quick Knowledge Check',
            'questions' => [
                [
                    'q' => 'What does GBV stand for?',
                    'choices' => ['General Business Value','Gender-Based Violence','Global Budget Variance'],
                    'answer' => 1,
                    'explain'=> 'GBV stands for Gender-Based Violence.',
                ],
                [
                    'q' => 'Which of these can be a form of GBV?',
                    'choices' => ['Economic abuse','Cyber harassment','Both of the above'],
                    'answer' => 2,
                    'explain'=> 'GBV has many forms including economic and cyber abuse.',
                ]
            ],
        ];
    }
}
