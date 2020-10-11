<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Tool extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

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
     * Generate and set the tumbnail image of the tool
     *
     * @param string $value
     * @return void
     **/
    public function setThumbnailAttribute($value)
    {
        $attribute_name = "thumbnail";
        $disk = config('filesystems.cloud') ?? 'public';
        // destination path relative to the disk above
        $destination_path = "uploads/tools";

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
            $image = Image::make($value)->encode('png')->fit(256, 256);

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
     * Return tool thumbnail from cloud or public storage
     * and default tool thumbnail if it doesn't exist
     * 
     * @param string $value
     * @return string
     **/
    public function getThumbnailAttribute($value)
    {
        // Return default thumbnail if not set
        if (!$value) return asset('images/tool-default@2x.png');

        // Return value if it's a url
        if (substr($value, 0, 4) === 'http') return $value;

        // Return from cloud if set
        if (config('filesystems.cloud')) return Storage::cloud()->url($value);

        // Return from public storage if no cloud storage
        return Storage::disk('public')->url($value);
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
}
