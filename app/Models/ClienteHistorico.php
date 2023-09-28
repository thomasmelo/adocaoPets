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
    Cliente,
    User
};

class ClienteHistorico extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cliente_historico';
    protected $primaryKey = 'id_cliente_historico';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_user',
        'id_cliente',
        'historico',
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
