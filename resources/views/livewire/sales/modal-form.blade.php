<div wire:ignore.self id="modalAddCustomer" class="modal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    <b class="text-theme-1">Elegir Cliente</b>
                </h2>
            </div>
            <div class="modal-body grid gap-2">
                <div class="p-2">
                    <div class="preview">
                        <div class="mt-3">
                            <div class="sm:grid grid-cols-6 gap-5">
                                <div>
                                    <label class="form-label">Nombre y Apellidos Cliente NUEVO</label>
                                    <input wire:model="name" id="name" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="255" placeholder="Ej..Luis Miguel">
                                    @error('name')
                                    <x-alert msg="{{$message}}" />
                                    @enderror
                                </div>
                            </div>
                            <div class="sm:grid grid-cols-6 gap-5 mt-2">
                                <div>
                                    <label class="form-label">C.I. o NIT.</label>
                                    <input wire:model="ci_nit" id="ci_nit" type="text" data-kioskboard-type="numpad" class="form-control form-control-lg border-start-0 kioskboard" maxlength="11" placeholder="Ej..60457578">
                                    @error('ci_nit')
                                    <x-alert msg="{{$message}}" />
                                    @enderror
                                </div>
                            </div>
                            <div class="sm:grid grid-cols-2 gap-2 mt-2">
                                <div>
                                    <label class="form-label">Telefono o Celular</label>
                                    <input wire:model="phone" id="phone" type="text" data-kioskboard-type="numpad" class="form-control form-control-lg border-start-0 kioskboard" maxlength="10" placeholder="Ej..60457578">
                                    @error('phone')
                                    <x-alert msg="{{$message}}" />
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Correo</label>
                                    <input wire:model="mail" id="mail" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="50" placeholder="Ej..infinity@gmail.com">
                                    @error('mail')
                                    <x-alert msg="{{$message}}" />
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="sm:grid grid-cols-2 gap-2">
                                <div>
                                    <label class="form-label">Ciudad</label>
                                    <input wire:model="city" id="city" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="50" placeholder="Ej..Potosi">
                                    @error('city')
                                    <x-alert msg="{{$message}}" />
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Direccion Cliente</label>
                                    <input wire:model="address" id="address" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="50" placeholder="Ej..Potosi">
                                    @error('address')
                                    <x-alert msg="{{$message}}" />
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <x-back />
    
                            <button wire:click="Store2" wire:loading.attr="disabled" class='btn btn-primary mr-5' >
                                <span wire:loading.remove wire:target="Store">
                                    Guardar
                                </span>
                                <span wire:loading wire:target="Store">
                                    Procesando
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button onclick="closeModalAddCustomer()" class="btn btn-outline-secondary mr-5">Cerrar Ventana</button>
            </div>

        </div>
    </div>
    <script>
        KioskBoard.run('.kioskboard-disabled',{})
        document.querySelectorAll(".kioskboard").forEach(i=>i.addEventListener("change",e=>{
            switch(e.currentTarget.id){
                case 'name':
                    @this.name = e.target.value
                    break
                case 'ci_nit':
                    @this.ci_nit = e.target.value
                    break
                case 'phone':
                    @this.phone = e.target.value
                    break
                case 'city':
                    @this.city = e.target.value
                    break
                case 'mail':
                    @this.mail = e.target.value
                    break 
                case 'address':
                    @this.address = e.target.value
                    break                    
            }
        }))
    </script>
</div>