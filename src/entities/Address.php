<?php

namespace Fc9\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
        'person_id',
        'country',
        'state', #province
        'city',
        'zip_code',
        'street',
        'number',
        'sector',
        'complement',
        'type',
        'created_at',
        'updated_at',
    ];
}
