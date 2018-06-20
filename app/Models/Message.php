<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia\{
    HasMedia,
    HasMediaTrait
};

/**
 * Class Message
 * @package App\Models
 */
class Message extends EloquentModel implements HasMedia
{
    use HasMediaTrait;
    /**
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'new',
        'answered',
        'timezone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [];

    /**
     * The relationships that should be touched on save.
     * @var array
     */
    protected $touches = [];

    /**
     * The relations to eager load on every query.
     * @var array
     */
    protected $with = [];

    /**
     * The accessors to append to the model's array form.
     * @var array
     */
    protected $appends = [];

    /**
     * Entity relations go below
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // @todo:

    /**
     * Entity scopes go below
     */

    // @todo:

    /**
     * Entity mutators and accessors go below
     */
    /**
     * @return mixed
     */
    public function getPathFileAttribute()
    {
        return $this->getFirstMediaUrl();
    }

    // @todo:

    /**
     * Entity public methods go below
     */
    /**
     * Return date next message
     *
     * @return string
     */
    public function getNextMessageDate(): string
    {
        return $this->created_at->timezone($this->timezone)->addDay()->format('Y-m-d H:i:s');
    }

    /**
     * @return bool
     */
    public function hasFile(): bool 
    {
        return $this->hasMedia();
    }

    /**
     * @param $file
     * @param $extension
     * @return \Spatie\MediaLibrary\Models\Media
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\InvalidBase64Data
     */
    public function saveFile($file, $extension)
    {
        return $this->addMediaFromBase64($file)
            ->usingFileName(time() . '_' . rand(100, 999) ."." . $extension)
            ->toMediaCollection();
    }
}
