<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
	use \Backpack\CRUD\app\Models\Traits\CrudTrait;
	use \Spatie\Sluggable\HasSlug;
	use \App\Traits\ThumbnailTrait;

	/**
	 * Guarded attributes.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * Hidden attributes.
	 *
	 * @var array
	 */
	protected $hidden = ['created_at', 'updated_at'];

	/**
	 * Set thumbnail mutator
	 *
	 * Set category tumbnail using setThumbnail
	 * from Thumbnail trailt
	 *
	 * @param string $value
	 * @return void
	 **/
	public function setThumbnailAttribute($value)
	{
		$this->setThumbnail($value, 'categories', [400, 300]);
	}

	/**
	 * Get thumbnail mutator
	 *
	 * Return category thumbnail using getThumbnail
	 * from Thumbnail trait
	 * 
	 * @param string $value
	 * @return string
	 **/
	public function getThumbnailAttribute($value)
	{
		return $this->getThumbnail($value, 'images/tool-default@2x.png');
	}

	/**
	 * Get the path to the resource
	 *
	 * @return string
	 */
	public function getPathAttribute()
	{
		return route('categories.show', $this->slug);
	}


	/**
	 * Get the options for generating the slug.
	 * 
	 * @return \Spatie\Sluggable\SlugOptions
	 */
	public function getSlugOptions(): SlugOptions
	{
		return SlugOptions::create()
			->generateSlugsFrom(['title', 'id'])
			->saveSlugsTo('slug')
			->usingLanguage('ar');
	}

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}

	/**
	 * 1-n relationship
	 * 
	 * The tools belong to this category
	 *
	 * @return object
	 */
	public function tools()
	{
		return $this->belongsToMany(
			Tool::class,
			'category_resource',
			'category_id',
			'resource_id'
		)->wherePivot('resource_type', 'tool');
	}

	/**
	 * 1-n relationship
	 * 
	 * The tutorials belong to this category
	 *
	 * @return object
	 */
	public function tutorials()
	{
		return $this->belongsToMany(
			Tool::class,
			'category_resource',
			'category_id',
			'resource_id'
		)->wherePivot('resource_type', 'tutorial');
	}
}
