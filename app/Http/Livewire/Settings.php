<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class Settings extends Component
{
    use WithFileUploads;

    public $name, $address, $phone, $leyend, $logo, $printer, $logoPreview; 

    public function mount(){
        $info = Setting::first();
        if($info){
            $this->name = $info->name;
            $this->address = $info->address;
            $this->phone = $info->phone;
            $this->leyend = $info->leyend;
            $this->printer = $info->printer;
            $this->logoPreview = $info->logo;
            $this->logo = null;
        }
         
    }

    public function render()
    {
        return view('livewire.settings.component')->layout('layouts.theme.app');
    }
    public function Store(){
        $rules = [
            'name' => 'required|min:3|max:65',
            'phone' => 'required|max:10',
            'address' => 'required|max:255',
            'leyend' => 'required|max:50',
            'printer' => 'required|max:30',
            'logo' => 'required|image|mimes:jpg,png,jpeg|dimensions:min_width=128,min_height=128,max_width=128,max_height=128',
        ];
        $msg = [
            'nanme.required' => 'Ingresa el Nombre del Negocio',
            'nanme.min' => 'El Nombre debe tener al menos 3 caracteres',
            'nanme.min' => 'El Nombre debe tener maximo 65 caracteres',
            'phone.max' => 'El Telefono debe tener maximo 10 Caracteres',
            'address.max' => 'La Direccion debe tener maximo 255 Caracteres',
            'leyend.max' => 'La Leyenda debe tener maximo 50 Caracteres',
            'printer.max' => 'El nombre de la Impresora debe tener maximo 30 Caracteres',
            'printer.required' => 'Ingrese el Nombre de la impresora',
            'printer.max' => 'El Nombre de la impresora debe tener maximo 30 Caracteres',
            'logo.required' => 'Seleccione la Imagen del Logo',
            'logo.image' => 'El Logo debe ser un archivo de Tipo Imagen',
            'logo.mimes' => 'El Tipo de Archivo para el Logo deber JPG, PNG, JPEG',
            'logo.dimensions' => 'Las Dimenciones del Logo deben ser de 128x128',
        ];
        $this->validate($rules,$msg);

        sleep(2);

        $tempLogo = Setting::first()->logo ?? '';

        Setting::truncate();

        $config = Setting::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'leyend' => $this->leyend,
            'printer' => $this->printer,
        ]);
        if($this->logo){
            if(File::exists(public_path($tempLogo))){
                File::delete($tempLogo);
            }
            $customFileName = uniqid() . '_.' . $this->logo->extension();
            $config->logo = $customFileName;
            $config->save();
            //Guardar el logo en el directorio public de nuestro proyecto
            $this->logo->storeAs('',$customFileName, 'public2'); //nuevo Driver para guardar el llgo

            //Desplegar el nuevo Logo
            $this->logoPreview = $customFileName;
            $this->logo = null;
        }
        $this->dispatchBrowserEvent('noty',['msg' => 'CONFIGURACION GUARDADA', 'type' => 'success']);
    }
}
