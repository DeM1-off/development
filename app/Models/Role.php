<?php


namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Notifications\Notifiable;


/**
 * Class Role
 * @package App\Model
 *
 *
 *
 * @property int $level
 */



class Role extends Model
{
    protected $table = 'role_admin';

    public function role(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
