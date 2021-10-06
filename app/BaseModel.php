<?php

namespace App;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * @package getAttribute
     * @author  Payam Yasaie <payam@yasaie.ir>
     *
     * @param string $key
     *
     * @return Carbon|Verta|mixed
     * @throws \Exception
     */
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

        return $value;
    }
}
