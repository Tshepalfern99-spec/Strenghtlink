<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    public function resources()
    {
        return $this->hasMany(Resource::class, 'resource_category_id');
    }
}
