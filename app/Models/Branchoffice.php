<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branchoffice extends Model
{
    use HasFactory;

    protected $fillable =['name','phone','address','leyend','logo'];

    public static function rules($id){
        if($id <= 0){
            return [
                'name' => 'required|min:5|max:60|unique:branchoffices',
                'phone' => 'required',
                'address' => 'required',
                'leyend' => 'required',
            ];
        }else{
            return [
                'name' => "required|min:5|max:60|unique:branchoffices,name,{$id}",
                'phone' => 'required',
                'address' => 'required',
                'leyend' => 'required',
            ];
        }
    }
    public static $messages = [
        'name.required' => 'El Nombre de la Sucursal es requerido',
        'name.min' => 'El Nombre de la Sucursal debe tener al menos 5 caracteres',
        'name.max' => 'El Nombre de la Sucursal debe tener como maximo 5 caracteres',
        'name.unique' => 'El Nombre de la Sucursal ya esta en uso',
        'phone.required' => 'El Telefono de la Sucursal es requerido',
        'address.required' => 'La Direccion de la Sucursal es requerido',
        'leyend.required' => 'La Leyenda de la Sucursal es requerido',
    ];

    //relacion con usuarios registrados

    public function users(){
        return $this->hasMany(User::class);
    }
}
