<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Builder, Model, Relations\HasMany
};
use Illuminate\Support\Collection,
    Laratrust\Traits\LaratrustUserTrait,
    Illuminate\Notifications\Notifiable,
    Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable,
        LaratrustUserTrait;

    const ROLE_USER = 'user';
    const ROLE_MANAGER = 'manager';
    
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = ['password'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Entity scopes go below
     */

    /**
     * @param $query
     * @param $roleName
     * @return Builder
     */
    public function scopeGetUserByRoleName($query, $roleName): Builder
    {
        return $query->whereHas('roles', function($q) use ($roleName) {
            return $q->where('name', $roleName);
        });
    }


    /**
     * Entity mutators and accessors go below
     */

    // @todo:

    /**
     * Entity public methods go below
     */
    /**
     * Return user role name
     *
     * @return string
     */
    public function getRole() :string
    {
        return $this->roles()->first()->name;
    }

    /**
     * Return all user with role manager
     * @return Collection
     */
    public static function getManagers(): Collection
    {
        return self::getUserByRoleName(User::ROLE_MANAGER)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function getLastMessage(): ?Model
    {
        return $this->messages()->orderByDesc('id')->first();
    }
}
