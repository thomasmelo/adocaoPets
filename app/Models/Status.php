<?php

/**
 * 27-09-2023
 * @author Thomas Melo
 *
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\{
    Adocao
};

class Status extends Model
{
    use SoftDeletes;

    protected $table = 'status';
    protected $primaryKey = 'id_status';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = ['status'];

    /**
     * --------------------------------------------------
     * | Relacionamentos
     * | https://laravel.com/docs/10.x/eloquent-relationships
     * --------------------------------------------------
     */

    public function adocoes()
    {
        return $this->belongsTo(
            Adocao::class,
            'id_status',
            'id_status'
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
