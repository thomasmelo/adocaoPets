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
    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value),
            set: fn ($value) => preg_replace('/\D/', '', $value),
        );
    }


    /**
     * ----------------------------------------------------
     * | Outros Métodos
     * -------------------------------
     */



    public function enderecoCompleto()
    {
        $endereco  = '<i class="fa-solid fa-location-dot"></i> ';
        $endereco.= $this->endereco . ' , Nº ' . $this->numero;
        $endereco .= ', ' . $this->bairro . '<br> Cep: ' . $this->cep;
        $endereco .= ' - ' . $this->cidade . ' / ' . $this->uf;
        return $endereco;
    }

    public function contatos()
    {
        $contatos  = '';
        if ($this->ddd)
            $contatos .= '<i class="fa-solid fa-mobile-screen"></i> ' . $this->ddd . ' ' . $this->celular;
       if ($this->email)
            $contatos .= '<br><i class="fa-solid fa-envelope"></i> ' . $this->email;
        return $contatos;
    }


    /**
     * 28-09-2023
     * @author Thomas Melo
     *
     */
}
