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
                    <select wire:model="branchoffice_id" id="branchoffice_id" name="" class="form-control form-control-lg text-xs h-8">
                        <option value="Elegir">Elegir</option>
                        @foreach ($branchoffices as $bo)
                            <option value="{{ $bo->id }}">{{ $bo->name }}</option>                            
                        @endforeach
                    </select>                    
                    @error('branchoffice_id')
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
                                <option value="Seleccionar Proveedor">Seleccione Proveedor</option>
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
                    <input list="browserdata" type="text" wire:model="search" id="search" class="w-full p-4 text-sm rounded-lg border-solid border-2" placeholder="Por favor, añade productos a la lista de las Compras.">
                    <datalist id="browserdata" class="dataes text-red-600">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
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
                            <th></th>
                            <th>Costo Unitario</th>
                            <th width="15%">Cantidad</th>
                            <th>Subtotal (Bs.)</th>
                            <th width="6%" class="text-right"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                              </svg>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contentCartp as $item)
                        <tr class="text-xs dark:bg-dark-1 {{$loop->index % 2 >0 ? 'bg bg-gray-200' : ''}}" style="line-height: 0rem;">
                            <td class="border-b dark:border-dark-5">
                                {{ $item->name }}                                
                            </td>
                            <td>
                                <a wire:click.prevent="editProduct({{$item->id}})" class="text-rigth">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </td>
                            <td>
                                {{ number_format($item->cost,2) }}
                            </td>
                            <td>
                                <input wire:change.prevent="updateQty({{$item->id}}, $event.target.value )" type="number" value="{{ $item->qty }}" class="text-center text-xs h-6 form-control form-control-lg border-start-0 kioskboard">                                
                            </td>
                            <td>
                                Bs. {{number_format($item->cost * $item->qty,2)}}
                            </td>
                            <td>
                                <a wire:click.prevent="removeFromCartp({{$item->id}})" class="h-8" title="Eliminar Producto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg> 
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">AGREGA PRODUCTOS AL CARRITO DE COMPRAS</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                            <th>Total (Bs.)</th>
                            <th></th>
                            <th></th>
                            <th class="text-center">{{ $itemsCart }}</th>
                            <th>Bs. {{ number_format($totalCart,2) }}</th>
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
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="storePurchase" wire:click.prevent="storePurchase()" >Guardar</button>
                
                <x-back />             
            </div>           
        </div>
    </div>  
    @include('livewire.purchasesadd.addmodalprovider')    
    @include('livewire.purchasesadd.modal_edit_product')
    <script>
        window.addEventListener('openModalEditProduct', event => {
			openModalEditProducts()
        })
        function openModalEditProducts() {
            var modal = document.getElementById("modalEditProduct")
            modal.classList.add("overflow-y-auto", "show")
            modal.style.cssText = "margin-top: 0px; margin-left: 0px;  z-index: 1000; width: 77vw;"
	    }
        window.addEventListener('closeModalEditProduct', event => {
			closeModalEditProduct()
        })
        function closeModalEditProduct() {
		var modal = document.getElementById("modalEditProduct")
		modal.classList.remove("overflow-y-auto", "show")
		modal.style.cssText = ""             
	    }
        function openModalAddProvider() {
        var modal = document.getElementById("modalAddProvider")
        modal.classList.add("overflow-y-auto", "show")
        modal.style.cssText = "margin-top: 0px; margin-left: 0px;  z-index: 1000;"
        }
        function closeModalAddProvider() {
            var modal = document.getElementById("modalAddProvider")
            modal.classList.remove("overflow-y-auto", "show")
            modal.style.cssText = ""             
        }
        window.addEventListener('closeModalAddProvider', event => {
			closeModalAddProvider()
        })
        const inputProduct = document.getElementById('search')
            inputProduct.addEventListener('change', (e) => {
                let id = e.target.value
                window.livewire.emit('addProduct', id)
            })        
    </script>    
</div>
