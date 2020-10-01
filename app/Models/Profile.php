<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	use \Backpack\CRUD\app\Models\Traits\CrudTrait;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'bio', 'link', 'avatar'];

	/**
	 * 1-1 Relationship
	 *
	 * The user who owns this profile.
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Trim slashes from the link.
	 *
	 * @param [string] $value
	 * @return string
	 */
	public function getLinkAttribute($value) {
		return trim($value, '/');
	}

	/**
	 * Get user's avatar
	 *
	 * @param integer $size
	 * @param string $default
	 * @return string
	 */
	public function getAvatar($size=64, $default='retro')
	{
		return $this->avatar . "?s={$size}&d={$default}";
	}
}
