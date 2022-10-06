<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'references',
        'status',
        'user_register',
        'user_edit',
        'branchoffice_id',
        'payment',
        'total',
    ];

    //Relaciones

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
    public static function rules(){
        return [
            'branchoffice_id' => 'required|not_in:Elegir',
            'status' => 'required|not_in:Elegir',
            'provider_id' => 'required',
            'references' => 'required',
        ];
    }
    public static $messages = [
        'branchoffice_id.required' => 'El campo sucursal es obligatorio',
        'branchoffice_id.not_in' => 'Debe Seleccionar una Sucursal o Almacen',
        'status.required' => 'El campo Estado es obligatorio',
        'status.not_in' => 'Debe Seleccionar un Estado de la compra',
        'provider_id.required' => 'El campo proveedor es obligatorio',
        'references.required' => 'El campo referencia es obligatorio',
    ];    
}
