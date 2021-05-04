<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
	use \Backpack\CRUD\app\Models\Traits\CrudTrait;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title', 'url', 'filters', 'added_by'
	];


	/**
	 * The relationships that should always be loaded.
	 *
	 * @var array
	 */
	protected $with = ['addedBy', 'addedBy.profile'];


	/**
	 * Return the domain from tutorial's url
	 *
	 * @return string
	 */
	public function getDomainAttribute()
	{
		return parse_url($this->url)['host'];
	}

	/**
	 * Decode filters from db
	 *
	 * @param string $value
	 * @return array
	 */
	public function getFiltersAttribute($value)
	{
		return json_decode($value, true);
	}


	/**
	 * Check if tutorial is bookmarked by the current user
	 *
	 * @return boolean
	 */
	public function getIsBookmarkedAttribute()
	{
		return auth()->user()->bookmarks->contains($this) ?? false;
	}


	/**
	 * Check if tutorial is bookmarked by the current user
	 *
	 * @return boolean
	 */
	public function getIsUpvotedAttribute()
	{
		return auth()->user()->upvoted->contains($this) ?? false;
	}


	/**
	 * Get upvotes count
	 *
	 * @return int
	 */
	public function upvotesCount()
	{
		return DB::table('upvotes')->where('tutorial_id', $this->id)->count();
	}


	/**
	 * n-1 relationship
	 * 
	 * The tool which the tutorial is listed under
	 *
	 * @return void
	 */
	public function tools()
	{
		return $this->belongsToMany(Tool::class);
	}


	/**
	 * n-1 relationship
	 * 
	 * The user added the tutorial
	 *
	 * @return void
	 */
	public function addedBy()
	{
		return $this->belongsTo(User::class, 'added_by');
	}


	public function category()
	{
		return $this->belongsToMany(
			Category::class,
			'category_resource',
			'resource_id',
			'category_id'
		)->first() ?? $this->tool->category();
	}
}
