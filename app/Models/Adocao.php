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
    AdocaoHistorico,
    Cliente,
    Pet,
    Status,
    User
};

class Adocao extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'adocoes';
    protected $primaryKey = 'id_adocao';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'dt_inicio'
    ];

    protected $fillable = [
        'id_user',
        'id_status',
        'id_pet',
        'id_cliente',
        'dt_inicio',
        'descricao',
    ];

    protected $casts = [
        'dt_inicio' => 'date'
    ];

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

    public function status()
    {
        return $this->belongsTo(
            Status::class,
            'id_status',
            'id_status'
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

    public function cliente()
    {
        return $this->belongsTo(
            Cliente::class,
            'id_cliente',
            'id_cliente'
        );
    }


    /**
     * ---------------------------------------------------
     * | Mutators
     * | https://laravel.com/docs/10.x/eloquent-mutators
     * ---------------------------------------------------
     */

    protected function descricao(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower(trim($value)),
        );
    }

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
