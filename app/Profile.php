<?php

namespace App;

/**
 * Class    Profile
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-27
 *
 * @package App
 * @mixin \Eloquent
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property string $data
 *
 * @property-read User $user
 */
class Profile extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
