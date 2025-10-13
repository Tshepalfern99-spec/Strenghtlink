<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteFeedback extends Model
{
    protected $table = 'site_feedback';

    protected $fillable = [
        'user_id','rating','category','page_url','device',
        'contact_email','consent_contact','message',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
