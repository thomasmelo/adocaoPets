<?php

/**
 * 27-09-2023
 * @author Thomas Melo
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\{
    Raca
};

class Especie extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'especies';
    protected $primaryKey = 'id_especie';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = ['especie'];

    /**
     * --------------------------------------------------
     * | Relacionamentos
     * | https://laravel.com/docs/10.x/eloquent-relationships
     * --------------------------------------------------
     */

    public function racas()
    {
        return $this->belongsTo(
            Raca::class,
            'id_especie',
            'id_especie'
        );
    }

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

