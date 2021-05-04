<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
	use \Backpack\CRUD\app\Models\Traits\CrudTrait;
	use \App\Traits\ThumbnailTrait;

	/**
	 * Fillable attributes
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'thumbnail'];


	/**
	 * Hidden attributes
	 *
	 * @var array
	 */
	protected $hidden = ['created_at', 'updated_at'];

	/**
	 * Set thumbnail mutator
	 *
	 * Set tool tumbnail using setThumbnail
	 * from Thumbnail trailt
	 *
	 * @param string $value
	 * @return void
	 **/
	public function setThumbnailAttribute($value)
	{
		$this->setThumbnail($value, 'tools', [256, 256]);
	}

	/**
	 * Get thumbnail mutator
	 *
	 * Return tool thumbnail using getThumbnail
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
	 * 1-n relationship
	 * 
	 * The tutorials belong to this tool
	 *
	 * @return object
	 */
	public function tutorials()
	{
		return $this->belongsToMany(Tutorial::class);
	}

	/**
	 * Get the category which this tool belongs to
	 *
	 * @return App\Models\Category
	 */
	public function category()
	{
		return $this->belongsToMany(
			Category::class,
			'category_resource',
			'resource_id',
			'category_id'
		)->withPivotValue('resource_type', 'tool');
	}

	// public function getCategoryAttribute()
	// {
	// 	return $this->category->first();
	// }
}
