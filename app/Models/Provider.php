<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email'
    ];
    public function purchase(){
        return $this->hasMany(Purchase::class);
    }

    public static function rules($id){
        if($id <= 0){
            return [
                'name' => 'required|min:3|max:100|string|unique:providers',
                'address' => 'nullable|max:100',
                'phone' => 'nullable|max:25',
                'email' => 'required|max:100|unique:providers',
            ];
        }else{
            return [
                'name' => "required|min:3|max:100|string|unique:providers,name,{$id}",
                'address' => 'nullable|max:100',
                'phone' => 'nullable|max:25',
                'email' => "required|max:100|unique:providers,email,{$id}",
            ];
        }
    }
    public static $messages = [
        'name.required' => 'Nombre del Proveedor es Requerido',
        'name.min' => 'Nombre del Proveedor debe tener al menos 3 caracteres',
        'name.max' => 'Nombre del Proveedor debe tener menos de 100 caracteres',
        'name.unique' => 'El nombre ya existe',
        'address.max' => 'La direccion debe tener menos de 100 caracteres',
        'email.unique' => 'Este Correo ya fue registrado',
        'email.required' => 'El Correo es requerido',
    ];
}
