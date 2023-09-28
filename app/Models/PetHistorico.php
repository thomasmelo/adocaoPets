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
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Models\{
    Pet,
    User
};

class PetHistorico extends Model
{
   use HasFactory, SoftDeletes;

    protected $table = 'pet_historico';
    protected $primaryKey = 'id_pet_historico';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_user',
        'id_pet',
        'historico',
    ];

    // protected $casts = [ ];

    /**
     * --------------------------------------------------
     * | Relacionamentos
     * | https://laravel.com/docs/10.x/eloquent-relationships
     * --------------------------------------------------
     */
    public function usuario()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }

    public function pet()
    {
        return $this->belongsTo(
            Pet::class,
            'id_pet',
            'id_pet'
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
