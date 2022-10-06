<div class="intro-y col-span-12">
    <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                {{$componentName}}|<span class="font-normal">{{$action}}</span>
                </h2>
            </div>
            <div class="p-5">
                <div class="preview">
                    <div x-data="{}" x-init="setTimeout(() => {$refs.first.focus()}, 900 )">
                        <label class="form-label">Nombre Proveedor</label>
                        <input wire:model="name" id="name" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="255" placeholder="Ej. Compuset">
                        @error('name')
                            <x-alert msg="{{$message}}" />
                        @enderror
                    </div>
                    <div class="sm:grid grid-cols-3 gap-4 mt-5">
                        <div>
                            <label for="form-label">Telefono</label>
                            <input type="text" wire:model="phone" id="phone" class="form-control form-control-lg border-start-0 kioskboard" maxlength="225" placeholder="Eje: +591 68403147">
                            @error('phone')
                                <x-alert msg="{{ $message }}"/>
                            @enderror
                        </div>
                        <div>
                            <label for="form-label">Direccion</label>
                            <input type="text" wire:model="address" id="address" class="form-control form-control-lg border-start-0 kioskboard" maxlength="225" placeholder="Eje: Los Alamos Nro. 15">
                            @error('address')
                                <x-alert msg="{{ $message }}"/>
                            @enderror
                        </div>
                        <div>
                            <label for="form-label">Email</label>
                            <input type="text" wire:model="email" id="email" class="form-control form-control-lg border-start-0 kioskboard" maxlength="225" placeholder="Eje: Compucenter@gmail.com">
                            @error('email')
                                <x-alert msg="{{ $message }}"/>
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