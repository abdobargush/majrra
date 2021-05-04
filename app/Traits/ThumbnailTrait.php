<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Add Thumnial functionality to models
 */
trait ThumbnailTrait
{

	/**
	 * Set thumbnail mutator
	 *
	 * Generate and set the tumbnail image
	 *
	 * @param string $value
	 * @param string $directory
	 * @param array $size [width, height]
	 * @return void
	 **/
	private function setThumbnail(?string $value, string $directory, array $size)
	{
		$attribute_name = "thumbnail";
		$disk = config('filesystems.cloud') ?? 'public';
		// destination path relative to the disk above
		$destination_path = "uploads/{$directory}";

		// if the image was erased
		if ($value == null) {
			// delete the image from disk
			Storage::disk($disk)->delete($this->getRawOriginal($attribute_name));

			// set null in the database column
			$this->attributes[$attribute_name] = null;
		}

		// if a base64 was sent, store its path in the db
		if (Str::startsWith($value, 'data:image')) {
			// 0. Make the image
			$image = Image::make($value)->encode('png')->fit($size[0], $size[1]);

			// 1. Generate a filename.
			$filename = md5($value . time()) . '.png';

			// 2. Store the image on disk.
			Storage::disk($disk)->put("{$destination_path}/{$filename}", $image->stream());

			// 3. Delete the previous image, if there was one.
			Storage::disk($disk)->delete("{$destination_path}/" . $this->getRawOriginal($attribute_name));

			// 4. Save the path to the database
			$this->attributes[$attribute_name] = "{$destination_path}/{$filename}";
		}
	}


	/**
	 * Get thumbnail mutator
	 *
	 * Return thumbnail from cloud or public storage
	 * and default thumbnail if it doesn't exist
	 * 
	 * @param string|null $value
	 * @param string $default thumbnail placeholder
	 * @return string
	 **/
	private function getThumbnail(?string $value, string $default): string
	{
		// Return default thumbnail if not set
		if (!$value) return asset($default);

		// Return value if it's a url
		if (substr($value, 0, 4) === 'http') return $value;

		// Return from cloud if set
		if (config('filesystems.cloud')) return Storage::cloud()->url($value);

		// Return from public storage if no cloud storage
		return Storage::disk('public')->url($value);
	}
}
