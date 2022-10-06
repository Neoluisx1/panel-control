<div wire:ignore.self id="modalEditProduct" class="modal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    <b class="text-theme-1">Producto: {{ $product_name }}</b>
                </h2>
            </div>
            <div class="modal-body">
                <div class="sm:grid grid-cols-2 gap-2 mt-5">
                    <div>
                        <label for="form-label">Cantidad</label>
                        <input type="number" wire:model="qty" id="qty" class="form-control form-control-lg border-start-0 text-xs h-8" maxlength="225">
                        @error('qty')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                    <div>
                        <label for="form-label">Unidad de Producto</label>
                        <select wire:model="unit_product" name="unit_product" id="" class="form-control form-control-lg text-xs h-8">  
                            <option value="Elegir una Opcion">Elegir una Opcion</option>                          
                            <option value="Pieza">Pieza</option>
                            <option value="Caja">Caja</option>                            
                        </select>
                        @error('unit_product')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                </div>
                <div class="sm:grid grid-cols-6 gap-2 mt-5">
                    <label for="form-label">Costo Unitario</label>
                    <div class="flex input-group">                        
                        <div class="rounded-l w-10 flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">Bs.</div>
                        <input type="text" wire:model="cost" id="cost" class="form-control form-control-lg border-start-0 text-xs h-8" maxlength="225">
                    </div>
                    @error('cost')
                            <x-alert msg="{{ $message }}"/>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <div class="flex mt-5">
                    <button wire:click="StoreEditProduct" wire:loading.attr="disabled" class="btn btn-primary w-32 border-gray-400 dark:border-dark-5 dark:text-gray-300">
                        <span wire:loading.remove wire:target="StoreEditProduct">
                            Guardar
                        </span>
                        <span wire:loading wire:target="StoreEditProduct">
                            Procesando
                        </span>
                    </button>
                    <button onclick="closeModalEditProduct()" class="btn w-32 shadow-md ml-auto text-gray-600">Cerrar Ventana</button>
                </div>                
            </div>
        </div>
    </div>
</div>