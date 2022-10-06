<div class="intro-y col-span-12">
    <div class="intro-y box">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                REGISTRAR |<span class="font-normal"> Compra Nueva</span>
            </h2>
        </div>
        <div class="p-3">
            <small>Por favor, complete la información en los campos de entrada de abajo. Son necesarias las etiquetas de los campos marcados con *.</small>
        </div>
        <div class="p-5">
            <div class="sm:grid grid-cols-3 gap-4 mb-15">
                <div>
                    <label for="form-label">Fecha *</label>
                    <input type="text" wire:model="date_register" id="date_register" class="text-xs h-8 form-control form-control-lg border-start-0 kioskboard" maxlength="225" placeholder="Eje: +591 68403147">
                    @error('date_register')
                        <x-alert msg="{{ $message }}"/>
                    @enderror
                </div>
                <div>
                    <label for="form-label">Referencia *</label>
                    <input type="text" wire:model="references" id="references" class="text-xs h-8 form-control form-control-lg border-start-0 kioskboard" maxlength="225" placeholder="Eje: Los Alamos Nro. 15">
                    @error('references')
                        <x-alert msg="{{ $message }}"/>
                    @enderror
                </div>
                <div>
                    <label for="form-label">Almacen *</label>
                    <select wire:model="provider_id" id="provider_id" name="" class="form-control form-control-lg text-xs h-8">
                        <option value="Elegir">Elegir</option>
                        @foreach ($branchoffices as $bo)
                            <option value="{{ $bo->id }}">{{ $bo->name }}</option>                            
                        @endforeach
                    </select>                    
                    @error('provider_id')
                        <x-alert msg="{{ $message }}"/>
                    @enderror
                </div>
            </div> 
            <div class="sm:grid grid-cols-3 gap-4 mb-15 mt-5">
                <div>
                    <label for="form-">Estado *</label>    
                    <select wire:model="status" id="status" name="" class="form-control form-control-lg text-xs h-8">
                        <option value="Elegir">Elegir</option>
                        <option value="Recibido">Recibido</option>
                        <option value="Pendiente">Pendiente</option>
                    </select>
                    @error('status')
                        <x-alert msg="{{ $message }}"/>
                    @enderror
                </div>                 
            </div> 
            <div class="alert alert-danger-soft show text-white flex items-center mb-2 mt-5" role="alert">Por favor, seleccione éstos datos antes de agregar cualquier producto a la Compra.</div>
            <div class="sm:grid grid-cols-3 gap-4 mb-15 mt-5">
                <div id="input-group" class="p-5">
                    <div class="preview">
                        <label for="form-label">Proveedor *</label>  
                        <div class="flex">
                            <select wire:model="provider_id" id="provider_id" data-search="true" class="form-control form-control-lg text-xs h-8">
                                <option value="Elegir">Seleccione Proveedor</option>
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn h-8" onclick="openModalAddProvider()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg> 
                            </button>                             
                            @error('provider_id')
                                <x-alert msg="{{ $message }}"/>
                            @enderror 
                        </div>
                    </div>                    
                </div>                               
            </div> 
            <div class="sm:grid grid-cols-6 gap-6 mb-15 mt-5">
                <div class="flex input-group p-3" style="background-color: rgb(226 232 240);">
                    <div class="rounded-l w-10 flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">@</div>
                    <input list="browserdata" type="text" wire:model="product_id" id="browser" class="form-control form-control-lg border-start-0" placeholder="Por favor, añade productos a la lista de las Compras.">
                    <datalist id="browserdata">
                        <option value="Internet Explorer">
                        <option value="Firefox">
                        <option value="Chrome">
                        <option value="Opera">
                        <option value="Safari">
                    </datalist>
                    <button type="button">
                        <div id="input-group" class="input-group-text">                             
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg> 
                        </div>
                    </button>                        
                </div>
            </div>
            <div class="sm:grid grid-cols-6 gap-6 mb-15 mt-5 text-xs">
                Lista de Productos de la Compra
                <table class="table -mt-3">
                    <thead>
                        <tr class="bg-theme-1 text-white">
                            <th>Producto (Codigo - Nombre)</th>
                            <th>Costo Unitario</th>
                            <th>Cantidad</th>
                            <th>Descuento</th>
                            <th>Subtotal (Bs.)</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                            <th>Total (Bs.)</th>
                            <th></th>
                            <th>0.00</th>
                            <th>0.00</th>
                            <th>0.00</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="sm:grid grid-cols-6 gap-6 mb-15 mt-5 text-xs">
                <div class="form-check w-full sm:w-auto sm:mr-auto mt-3 sm:mt-0">
                    <label class="form-check-label ml-0 sm:ml-2" for="show-example-5">Mas Opciones</label>
                    @if ($more_options == true)
                    <input wire:change.prevent="$set('more_options',false)" id="show-example-5" data-target="#select-options" class="show-code form-check-switch mr-0 ml-3" type="checkbox">
                    @else
                        <input wire:change.prevent="$set('more_options',true)" id="show-example-5" data-target="#select-options" class="show-code form-check-switch mr-0 ml-3" type="checkbox" checked>
                    @endif
                </div>
            </div>
            @if (!$more_options)
            <div class="sm:grid grid-cols-3 gap-4 mb-15 mt-5">
                <div>
                    <label for="form-label">Descuento (5.5 %)</label>
                    <input type="text" wire:model="discount" id="discount" class="text-xs h-8 form-control form-control-lg border-start-0 kioskboard" maxlength="225" placeholder="Eje: +591 68403147">
                    @error('discount')
                        <x-alert msg="{{ $message }}"/>
                    @enderror
                </div>
                <div>
                    <label for="form-label">Envio a:</label>
                    <input type="text" wire:model="send_to" id="send_to" class="text-xs h-8 form-control form-control-lg border-start-0 kioskboard" maxlength="225" placeholder="Eje: Los Alamos Nro. 15">
                    @error('send_to')
                        <x-alert msg="{{ $message }}"/>
                    @enderror
                </div>
                <div>
                    <label for="form-label">Terminos de Pago</label>
                    <select wire:model="payment_terms" id="payment_terms" name="" class="form-control form-control-lg text-xs h-8">
                        <option value="Elegir">Elegir</option>
                        @foreach ($branchoffices as $bo)
                            <option value="{{ $bo->id }}">{{ $bo->name }}</option>                            
                        @endforeach
                    </select>                    
                    @error('payment_terms')
                        <x-alert msg="{{ $message }}"/>
                    @enderror
                </div>
            </div>
            @endif
            <div class="sm:grid grid-cols-4 gap-4 mb-15 mt-5">
                Nota
                <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" placeholder="Ingrese notas de la Venta"></textarea>
            </div>
            <div class="sm:grid grid-cols-3 gap-4 mb-15 mt-5 justify-items-center">
                <x-save />
                <x-back />             
            </div>           
        </div>
    </div>  

</div>
