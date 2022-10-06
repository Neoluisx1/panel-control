<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable =['name'];

public static function rules($id)
{
    if($id <= 0){
        return ['name'=> 'required|min:3|max:50|unique:categories'];
    }else{
        return ['name'=> "required|min:3|max:50|unique:categories,name,{$id}"];
    }
}
    public static $messages =[
        'name.required'=> 'nombre requerido',
        'name.min' => 'el nombre debe tener al menos 3 caracteres',
        'name.max' => 'el nombre debe tener maximo 50 caracteres',
        'name.unique' => 'la categoria ya existe en sistema'
    ];

    //relaciones
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function image(){
        return $this->morphOne(Image::class, 'model')->withDefault();
    }

    //mutators && accessors
    public function getImgAttribute(){
        $img = $this->image->file;
        if($img != null){
            if(file_exists('storage/categories/' . $img))
                return 'storage/categories/' . $img;
            else
                return 'storage/image-not-found.png';
        }

        return 'storage/noimg.jpg';
        
    }
}

