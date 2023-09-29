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
    ClienteHistorico,
    Sexo,
};

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'nascimento'
    ];

    protected $fillable = [
        'nome',
        'cpf',
        'id_sexo',
        'nascimento',
        'ddd',
        'celular',
        'email',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
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
    public function adocao()
    {
        return $this->belongsTo(
            Adocao::class,
            'id_cliente',
            'id_cliente'
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

    public function historico()
    {
        return $this->belongsTo(
            ClienteHistorico::class,
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
     * 28-09-2023
     * @author Thomas Melo
     *
     */
}
