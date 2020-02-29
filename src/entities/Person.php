<?php

namespace Fc9\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'person';

    /**
     * Attributes that can be assigned in bulk.,
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'avatar',
        'birth_date',
        'type',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the address record associated with the person.
     */
    public function address()
    {
        return $this->hasOne('Fc9\Auth\Entities\Address');
    }

    /**
     * Get the membership record associated with the person.
     */
    public function membership()
    {
        return $this->hasOne('Fc9\Auth\Entities\Membership');
    }

}
