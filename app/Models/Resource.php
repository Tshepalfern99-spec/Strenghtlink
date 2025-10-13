<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'resource_category_id', 'name', 'phone', 'email', 'website',
        'address', 'city', 'province', 'postal_code', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ResourceCategory::class, 'resource_category_id');
    }

    /** Basic filter scope for q / category / city / province */
    public function scopeFilter($query, array $filters)
    {
        $q = $filters['q'] ?? null;
        $cat = $filters['category_id'] ?? null;
        $city = $filters['city'] ?? null;
        $prov = $filters['province'] ?? null;

        if ($q) {
            $query->where(function ($qq) use ($q) {
                $qq->where('name', 'like', "%{$q}%")
                   ->orWhere('address', 'like', "%{$q}%")
                   ->orWhere('city', 'like', "%{$q}%")
                   ->orWhere('province', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%")
                   ->orWhere('phone', 'like', "%{$q}%");
            });
        }
        if ($cat)   { $query->where('resource_category_id', $cat); }
        if ($city)  { $query->where('city', 'like', "%{$city}%"); }
        if ($prov)  { $query->where('province', 'like', "%{$prov}%"); }

        return $query;
    }
}
