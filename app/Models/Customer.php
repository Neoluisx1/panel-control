<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Type;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=['name','ci_nit','phone','city','mail','address'];

    public function orders(){
        return $this->hasMany((Order::class));
    }

    public static function rules($id){
        if($id <=0){
            return['name'=>'required|min:3|string|unique:customers',
                    'ci_nit'=> 'required|max:11|unique:customers',
                    'phone'=> 'nullable|max:10',
                    'city'=> 'nullable|max:65',
                    'mail' => 'nullable|max:50'];
        }else{
            return['name'=>"required|min:3|string|unique:customers,name,{$id}",
            'ci_nit'=> "required|max:11|unique:customers,ci_nit,{$id}",
            'phone'=> 'nullable|max:10',
            'city'=> 'nullable|max:65',
            'mail' => 'nullable|max:50'
        ];
        }
    }

    public static $messages=[
        'name.required'=>'Nombre requerido',
        'name.min'=>'El nombre debe tener al menos 3 caracteres',
        'name.unique'=>'El nombre ya existe',
        'ci_nit.max' => 'El nit debe tener maximo 11 caracteres',
        'ci_nit.unique'=>'El nit ya existe',
        'ci_nit.required'=>'Debe Ingresar su NIT o C.I.',
        'phone.max' => 'El telefono debe tener maximo 10 caracteres',
        'city.max' => 'La ciudad debe tener maximo 65 caracteres',
        'mail'=> 'El correo debe tener un maximo de 50 caracteres'
    ];
}
