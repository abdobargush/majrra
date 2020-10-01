<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = ['provider', 'provider_user_id'];


    /**
     * Inverse 1-1 relationship
     * 
     * The user who owns this social account
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
