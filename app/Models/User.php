<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;
	use \Backpack\CRUD\app\Models\Traits\CrudTrait;


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'email', 'password', 'username'
	];


	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];


	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];


	/**
	 * The "booted" method of the model.
	 *
	 * @return void
	 */
	protected static function booted()
	{

		static::created(function ($user) {

			/**
			 * Create user's profile after registeration
			 */
			$user->profile()->create([
				'avatar' => $user->gravatar()
			]);
			
		});
		
	}


	/**
	 * 1-1 Relationship
	 *
	 * The profile belogns to this user
	 */
	public function profile() {
		return $this->hasOne(Profile::class);
	}


	/**
	 * 1-n Relationship
	 *
	 * The tutorials added by this user
	 */
	public function tutorials() {
		return $this->hasMany(Tutorial::class, 'added_by', 'id');
	}


	/**
	 * The bookmarks of the user
	 */
	public function bookmarks()
	{
		return $this->belongsToMany(Tutorial::class, 'bookmarks', 'user_id', 'tutorial_id');
	}


	/**
	 * The tutorials upvoted by the user
	 */
	public function upvoted()
	{
		return $this->belongsToMany(Tutorial::class, 'upvotes', 'user_id', 'tutorial_id');
	}

	/**
	 * 1-n Relationship
	 * 
	 * The Social accounts which this user owns
	 *
	 * @return object
	 */
	public function socialAccounts()
	{
		return $this->hasMany(SocialAccount::class);
	}


	/**
	 * Generate gravatar
	 * 
	 * @return string
	 */
	public function gravatar() {
		return "https://www.gravatar.com/avatar/" . md5( $this->email );
	}
}
