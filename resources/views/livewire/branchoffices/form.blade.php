<div class="intro-y col-span-12">
    <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                {{$componentName}}|<span class="font-normal">{{$action}}</span>
                </h2>
            </div>
            <div class="p-5">
                <div class="preview">
                    <div class="sm:grid grid-cols-2 gap-2">
                        <div>
                            <label class="form-label">NOMBRE SUCURSAL</label>
                            <input wire:model="name" id="name" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="255" placeholder="Ej..Central">
                            @error('name')
                                <x-alert msg="{{$message}}"/>
                            @enderror
                        </div>                   
                        <div>
                            <label class="form-label">TELEFONO O CELULAR</label>
                            <input wire:model="phone" id="phone" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="255" placeholder="Ej..+591 68403147">
                            @error('phone')
                                <x-alert msg="{{$message}}"/>
                            @enderror
                        </div>
                    </div>  
                    <div class="sm:grid grid-cols-2 gap-2 mt-3">
                        <div>
                            <label class="form-label">DIRECCION</label>
                            <input wire:model="address" id="address" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="255" placeholder="Ej..Los Alamos Nro. 15">
                            @error('address')
                                <x-alert msg="{{$message}}"/>
                            @enderror
                        </div>                   
                        <div>
                            <label class="form-label">LEYENDA</label>
                            <input wire:model="leyend" id="leyend" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="255" placeholder="Ej..Siempre los Primeros">
                            @error('leyend')
                                <x-alert msg="{{$message}}"/>
                            @enderror
                        </div>
                    </div>                                     
                    <div class="mt-5">
                        <x-back />

                        <x-save />
                    </div>
                </div>
            </div>
    </div>
    <script>
        KioskBoard.run('#categoryName',{})
        const inputCatName = document.getElementById('categoryName')
        if(inputCatName){
            inputCatName.addEventListener('change',(e) => {
                @this.name = e.target.value
            })
        }
    </script>
</div>