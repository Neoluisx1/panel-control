<div wire:ignore.self id="modalAddProvider" class="modal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    <b class="text-theme-1">Registrar nuevo Proveedor</b>
                </h2>
            </div>
            <div class="modal-body grid gap-2">
                <div x-data="{}" x-init="setTimeout(() => {$refs.first.focus()}, 900 )">
                    <label class="form-label">Nombre Proveedor</label>
                    <input wire:model="name" id="name" type="text" class="form-control form-control-lg border-start-0" maxlength="255" placeholder="Ej. Compuset">
                    @error('name')
                        <x-alert msg="{{$message}}" />
                    @enderror
                </div>
                <div class="sm:grid grid-cols-2 gap-2 mt-5">
                    <div>
                        <label for="form-label">Telefono</label>
                        <input type="text" wire:model="phone" id="phone" class="form-control form-control-lg border-start-0" maxlength="225" placeholder="Eje: +591 68403147">
                        @error('phone')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                    <div>
                        <label for="form-label">Direccion</label>
                        <input type="text" wire:model="address" id="address" class="form-control form-control-lg border-start-0" maxlength="225" placeholder="Eje: Los Alamos Nro. 15">
                        @error('address')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                </div>
                <div class="sm:grid grid-cols-6 gap-4 mt-5">
                    <div class="col-start-2 col-span-4">
                        <label for="form-label">Email</label>
                        <input type="text" wire:model="email" id="email" class="form-control form-control-lg border-start-0" maxlength="225" placeholder="Eje: Compucenter@gmail.com">
                        @error('email')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                </div>  
            </div>            
            <div class="modal-footer">
                <div class="sm:grid grid-cols-2 gap-2 mt-5">
                    <div class="text-left">
                        <button wire:click="StoreNewP" wire:loading.attr="disabled" class='btn btn-primary mr-5' >
                            <span wire:loading.remove wire:target="StoreNewP">
                                Guardar
                            </span>
                            <span wire:loading wire:target="StoreNewP">
                                Procesando
                            </span>
                        </button>
                    </div>
                    <div class="text-right">
                        <button onclick="closeModalAddProvider()" class="btn btn-outline-secondary mr-5">Cancelar</button>
                    </div>
                </div>             
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
            }
        }))
    </script>
</div>