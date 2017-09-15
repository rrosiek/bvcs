<?php
namespace Bvcs;

use Illuminate\Database\Eloquent\Model;

final class Member extends Model
{
    /**
     * @var string
     */
    protected $table = 'members';

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'last_name',
        'first_name',
        'is_active',
    ];
}
