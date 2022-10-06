<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirm-password',
        'profile'
        //'branchoffice_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //Reglas de Validacion

    public static function rules($id){
        if($id == 0 ){
            return [
                'name' => 'required|min:|max:50|string|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:3',
                'profile' => 'required|not_in:elegir'
            ];
        }else{
            return [
                'name' => "required|min:|max:50|string|unique:users,name,{$id}",
                'email' => "required|email|unique:users,email,{$id}",
                'profile' => 'required|not_in:elegir'
            ];
        }
    }

    public static $messages = [
        'name.required' => 'El Nombre de Usuario es Requerido',
        'name.min' => 'El Nombre de Usuario debe ser al menos de 3 caracteres',
        'name.max' => 'El Nombre de Usuario debe tener maximo 50 caracteres',
        'name.unique' => 'El Nombre de Usuario ya esta en uso',
        'email.required' => 'El Email de Usuario requerido',
        'email.email' => 'El Email de Usuario no es valido',
        'password.required' => 'La contraseña es requerida',
        'password.min' => 'La contraseña debe tener minimo 3 caracteres',
        'profile.required' => 'El perfil es requerido',
        'profile.not_in' => 'Debe seleccionar un Perfil de Usuario',
    ];

    public function imagen(){
        return $this->morphOne(Image::class, 'model')->withDefault();
    }

    //accesores && mutadores

    public function getAvatarAttribute(){
        $img = $this->image->file;
        if($img != null){
            if(file_exists('storage/avatars/', $img))
                return 'storage/avatars/'.$img;
            else
                return 'storage/default_avatar.png';
        }
        return 'storage/default_avatar.png';
    }


    //relationships
    public function sales(){
        return $this->hasMany(Order::class);
    }

    /*public function branchoffices(){
        return $this->belongsTo(BranchOffice::class);
    }*/
}
