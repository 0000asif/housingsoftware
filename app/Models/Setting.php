<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'fav_icon',
        'site_title',
        'short_description',
        'helpline_number',
        'contract_number',
        'institute_email',
        'principle_email',
        'messenger_link',
        'fb_link',
        'instagram_link',
        'youtube_link',
        'linkedin',
        'address',
        'map',

        // Meta Section
        'meta_title',
        'meta_description',
        'keywords',
        'meta_url',
        'meta_img',
        'copyright_text',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
