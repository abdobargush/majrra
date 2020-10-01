<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmittedTutorial extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    /**
     * The attributes that aren't mass assignable
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Json encode tools array before save
     *
     * @param array $value
     * @return string
     */
    public function setToolsAttribute($value) {
        $this->attributes['tools'] = json_encode($value);
    }

    /**
     * Json encode filters array before save
     *
     * @param array $value
     * @return string
     */
    public function setFiltersAttribute($value) {
        $this->attributes['filters'] = json_encode($value);
    }

    /**
     * Decode filters from db
     *
     * @param string $value
     * @return array
     */
    public function getToolsAttribute($value) {
        return json_decode($value, true);
    }

    /**
     * Decode filters from db
     *
     * @param string $value
     * @return array
     */
    public function getFiltersAttribute($value) {
        return json_decode($value, true);
    }

    /**
     * n-1 relationship
     * 
     * The user added the tutorial
     *
     * @return object
     */
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    
}
