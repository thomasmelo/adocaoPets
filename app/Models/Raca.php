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
    Especie,
    Pet
};

class Raca extends Model
{
   use HasFactory, SoftDeletes;
    protected $table = 'racas';
    protected $primaryKey = 'id_raca';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = ['raca'];

    /**
     * --------------------------------------------------
     * | Relacionamentos
     * | https://laravel.com/docs/10.x/eloquent-relationships
     * --------------------------------------------------
     */

    public function especie()
    {
        return $this->belongsTo(
            Especie::class,
            'id_especie',
            'id_especie'
        );
    }

    public function pets()
    {
        return $this->belongsTo(
            Pet::class,
            'id_raca',
            'id_raca'
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
