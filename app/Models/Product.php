<?php

namespace App\Models;

use App\Traits\CartTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use CartTrait;

    protected $fillable = ['code', 'name', 'price', 'price2', 'changes', 'cost', 'stock', 'minstock', 'category_id'];
    
    public static function rules($id){
        if($id <= 0){
            return [
                'name' => 'required|min:3|max:100|string|unique:products',
                'code' => 'nullable|max:25',
                'category' => 'required|not_in:Elegir',
                'price' => 'gt:0',
                'price2' => 'gt:0',
                'stock' => 'required',
                'minstock' => 'required',
            ];
        }else{
            return [
                'name' => "required|min:3|max:100|string|unique:products,name,{$id}",
                'code' => 'nullable|max:25',
                'category' => 'required|not_in:elegir',
                'price' => 'gt:0',
                'price2' => 'gt:0',
                'stock' => 'required',
                'minstock' => 'required',
            ];
        }
    }
    public static $messages = [
        'name.required' => 'Nombre del Producto Requerido',
        'name.min' => 'Nombre del Producto debe tener al menos 3 caracteres',
        'name.max' => 'Nombre del Producto debe tener menos de 100 caracteres',
        'name.unique' => 'El nombre ya existe',
        'code.max' => 'El codigo debe tener menos de 25 caracteres',
        'category.not_in' => 'Seleccione una Categoria valida',
        'category.required' => 'Seleccione una Categoria',
        'cost.gt' => 'El costo debe ser mayor a cero',
        'price.gt' => 'El precio debe ser mayor a cero',
        'price2.gt' => 'El precio 2 debe ser mayor a cero',
        'stock.required' => 'Ingresa el Stock',
        'minstock.required' => 'Ingresa el Stock minimo',
    ];

    //relaciones
    public function sales(){
        return $this->hasMany(OrderDetail::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function images(){
        return $this->morphMany(Image::class, 'model');
    }
    public function lastestImage(){
        return $this->morphOne(Image::class, 'model')->latestOfMAny();
    }
    //accessors
    public function getImgAttribute(){
        if(count($this->images)){
            if(file_exists('storage/products/'. $this->images->last()->file))
                return 'storage/products/' . $this->images->last()->file;
            else
                return 'storage/image_not_found.png';
        }else{
            return 'storage/no_imagen_available.jpg';
        }
    }
    public function getLiveStockAttribute(){
        $stock = 0;
        $stockCart = $this->countInCart($this->id);
        if($stockCart > 0){
            $stock = $this->stock - $stockCart;
        }else{
            $stock = $this->stock;
        }
        return $stock;
    }
}
