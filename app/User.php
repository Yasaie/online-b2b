<?php

namespace App;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Routing\Route;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class    User
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-03
 *
 * @package App
 * @mixin \Eloquent
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string password
 * @property string mobile
 *
 * @property-read Profile $profile
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens,
        Notifiable,
        HasRoles,
        HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'mobile', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $user_profile = [
        'phone',
        'address',
        'company'
    ];

    public $profile_data = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (self $table) {
            if ($table->profile_data) {
                foreach ($table->profile_data as $name => $data)
                $table->profile()->updateOrCreate(
                    compact('name'),
                    compact('data')
                );
            }
        });
    }

    public function setAttribute($name, $data)
    {
        if (!in_array($name, $this->user_profile)) {
            parent::setAttribute($name, $data);
        } else {
            $this->profile_data[$name] = $data;
        }
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, ['updated_at', 'created_at'])) {
            Verta::setStringFormat('Y-m-d - H:i');
            $date = app()->getLocale() == 'fa'
                ? new Verta($value)
                : new Carbon($value);

            return $date;
        }

        if ($value) {
            return $value;
        } elseif ($profile = $this->profile()->where('name', $key)->first()) {
            return $profile->data;
        }

        return null;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function profile()
    {
        return $this->hasMany(Profile::class);
    }

    public function canUpdate(Route $route)
    {
        $permission = preg_replace('/.(\w+)$/', '.update', $route->getName());
        return $this->can($permission);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('draft')
            ->acceptsFile(function (File $file) {
                $acceptable = [
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                ];
                return in_array($file->mimeType, $acceptable);
            });
    }

    /**
     * @return mixed
     */
    public function getRoleLocales()
    {
        return $this->roles->map(function ($r) {
            return trans('roles.' . $r->name);
        });
    }
}
