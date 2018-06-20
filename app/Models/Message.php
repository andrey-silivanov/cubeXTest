<?php
declare(strict_types = 1);

namespace App\Models;

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

    // @todo:

    /**
     * Entity scopes go below
     */

    // @todo:

    /**
     * Entity mutators and accessors go below
     */

    // @todo:

    /**
     * Entity public methods go below
     */

    public function getNextMessageDate()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }
}
