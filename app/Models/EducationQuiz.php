<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationQuiz extends Model
{
    protected $fillable = ['education_item_id','title','questions'];
    protected $casts = ['questions' => 'array'];

    public function item() {
        return $this->belongsTo(EducationItem::class, 'education_item_id');
    }
}
