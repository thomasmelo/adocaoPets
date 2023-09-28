<?php

/**
 * 27-09-2023
 * @author Thomas Melo
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sexo extends Model
{
    use SoftDeletes;

    protected $table = 'sexos';
    protected $primaryKey = 'id_sexo';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = ['sexo'];


    /**
     * ---------------------------------------------------
     * | Mutators
     * | https://laravel.com/docs/10.x/eloquent-mutators
     * ---------------------------------------------------
     */



    /**
     * ----------------------------------------------------
     * | Outros Métodos
     * -------------------------------
     */

    /**
     * 27-09-2023
     * @author Thomas Melo
     *
     */
}
