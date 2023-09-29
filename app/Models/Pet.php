<?php

/**
 * 28-09-2023
 * @author Thomas Melo
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Models\{
    Adocao,
    PetHistorico,
    Raca,
    Sexo,
};

class Pet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pets';
    protected $primaryKey = 'id_pet';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'nascimento'
    ];

    protected $fillable = [
        'nome',
        'id_raca',
        'id_sexo',
        'nascimento',
        'foto',
        'descricao',
        'observacao',
    ];

    protected $casts = [
        'nascimento' => 'date'
    ];

    /**
     * --------------------------------------------------
     * | Relacionamentos
     * | https://laravel.com/docs/10.x/eloquent-relationships
     * --------------------------------------------------
     */


    public function raca()
    {
        return $this->belongsTo(
            Raca::class,
            'id_raca',
            'id_raca'
        );
    }

    public function sexo()
    {
        return $this->belongsTo(
            Sexo::class,
            'id_sexo',
            'id_sexo'
        );
    }

    public function adocao()
    {
        return $this->belongsTo(
            Adocao::class,
            'id_pet',
            'id_pet'
        );
    }

    public function historico()
    {
        return $this->belongsTo(
            PetHistorico::class,
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
     * 28-09-2023
     * @author Thomas Melo
     *
     */
}
