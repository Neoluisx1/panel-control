<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
    <div class="intro-y col-span-12 lg:col-span-9">

        <div class="post intro-y overflow-hidden box">
            <div class="post__tabs nav nav-tabs flex-col sm:flex-row bg-gray-300 dark:bg-dark-2 text-gray-600" role="tablist">

                <a wire:click="setTabActive('tabProducts')"
                title="Productos Agregados"
                data-toggle="tab"
                data-target="#tabProducts"
                href="javascript:;"
                class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center {{$tabProducts ? 'active' : '' }}"
                id="content-tab"
                role="tab" >
                <i class="fas fa-list mr-2"></i> DETALLE DE VENTA
            </a>

            <a wire:click="setTabActive('tabCategories')" title="Seleccionar Categoría" data-toggle="tab" data-target="#tabCategory" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center {{$tabCategories ? 'active' : '' }}" id="meta-title-tab" role="tab" aria-selected="false">
             <i class="fas fa-th-large mr-2"></i> CATEGORÍAS
         </a>

     </div>
     <div class="post__content tab-content">
        <div id="tabProducts" class="tab-pane {{$tabProducts ? 'active' : '' }}" role="tabpanel" aria-labelledby="content-tab">
            <div class="p-5" id="striped-rows-table">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr class="text-theme-6">
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold" width="60%">DESCRIPCIÓN</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold">PRECIO</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold text-center" width="17%">CANT</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold">IMPORTE</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold"></th>
                                </tr>
                            </thead>
                            <tbody> 
                                @forelse($contentCart as $item)
                                <tr class="bg-gray-200 dark:bg-dark-1 text-lg">
                                    <td class="border-b dark:border-dark-5 ">
                                        <button onclick="openModal({{$item->id}},'{{$item->changes}}','{{$item->name}}')" class="btn btn-outline-secondary text-theme-1">{{$item->name}}</button>
                                        <div>
                                            <small>{{$item->changes}}</small>
                                        </div>
                                    </td>
                                    <td class="border-b dark:border-dark-5 text-center">${{number_format($item->price,2)}}</td>
                                    <td class="border-b dark:border-dark-5 text-center">
                                        <div class="input-group mt-2">
                                            <input wire:keydown.enter="updateQty({{$item->id}}, $event.target.value )" value="{{$item->qty}}" data-kioskboard-type="numpad" data-type="qty" type="text" class="form-control text-center kioskboard" id="r{{$item->id}}">
                                            <div wire:click="updateQty({{$item->id}}, document.getElementById('r'+ {{$item->id}} ).value )" class="input-group-text {{ $item->livestock > 0 ? '' : 'hidden' }}">
                                                <i class="fas fa-redo fa-lg"></i>
                                            </div>
                                        </div>
                                        <div><small class="text-xs text-theme-1">{{$item->livestock}}</small></div>
                                    </td>
                                    <td class="border-b dark:border-dark-5 text-center">
                                     ${{number_format($item->price * $item->qty,2)}}
                                 </td>
                                    <td>
                                        <div class="inline-flex" role="group" style="font-size: 1.6em!important;">
                                            <button  wire:click.prevent="removeFromCart({{$item->id}})" class=" btn btn-danger"><i class="fas fa-trash "></i></button>
                                            <button  wire:click.prevent="decreaseQty({{$item->id}})" class="btn btn-warning ml-4"><i class="fas fa-minus "></i></button>
                                            <button  wire:click.prevent="increaseQty({{$item->id}})"
                                             class="btn btn-success ml-4 {{ $item->livestock > 0 ? '' : 'hidden' }}" >
                                             <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">AGREGA PRODUCTOS AL CARRITO</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="tabCategory" class="tab-pane p-5 {{$tabCategories ? 'active' : '' }}" role="tabpanel" aria-labelledby="content-tab">

            <div class="intro-y grid grid-cols-12 gap-3 sm:gap-4 mt-2">

                @if(!$showListProducts)
                @foreach($categories as $category)
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
                    <div wire:click="getProductsByCategory({{ $category->id}})" class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">

                        <a href="javascript:;" class="w-3/5 file__icon file__icon--image mx-auto">
                            <div class="file__icon--image__preview image-fit ">
                                <img alt="img" src="{{ asset($category->img) }}">
                            </div>
                        </a>
                        <a href="javascript:;" class="block font-medium mt-4 text-center truncate">{{$category->name}}</a>

                    </div>
                </div>
                @endforeach
                @else
                @forelse($productsList as $product)
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
                    <div wire:click="add2Cart({{$product->id}})" class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">

                        <a href="javascript:;" class="w-3/5 file__icon file__icon--image mx-auto">
                            <div class="file__icon--image__preview image-fit">
                                <img alt="img" src="{{ asset($product->img) }}">
                            </div>
                        </a>
                        <a href="javascript:;" class="block font-medium mt-4 text-center truncate">{{$product->name}}</a>
                        <h1 class="text-center">${{ number_format($product->price,2) }}</h1>
                    </div>
                </div>
                @empty
                <div class="col-span-12">
                    <h1 class="text-center text-theme-6 w-full">No hay productos en la categoría seleccionada</h1>
                </div>
                @endforelse
                @endif


            </div>
        </div>
    </div>
 </div>

 </div>
 <!-- END: Post Content -->
 <!-- BEGIN: Post Info -->
 <div class="col-span-12 lg:col-span-3">
    <div class="intro-y box p-5">
        <div>
            <h2 class="text-2xl text-center mb-3">Resumen de Venta</h2>
            <button onclick="openModalCustomer()" class="btn btn-outline-dark w-full mb-3">{{$customerSelected}}</button>
        </div>
        <div class="mt-3">
            <h1 class="text-2xl font-bold">Articulos</h1>
            <h3 class="text-2xl">{{$itemsCart}}</h3>
        </div>
        <div class="mt-3">
            <h1 class="text-2xl font-bold">TOTAL</h1>
            <h3 class="text-2xl">${{number_format($totalCart,2)}}</h3>
        </div>
        <div class="mt-6">
            <h1 class="text-2xl font-bold">TIPO DE PAGO</h1>
            <select wire:model="pay" class="form-select form-select-lg sm:mr-2" id="">
                <option value="elegir">Tipo de Pago</option>
                <option value="EFECTIVO">Efectivo</option>
                <option value="TARJETA DE DEBITO">Tarjeta de debito</option>
            </select>
            @error('pay')
            <x-alert msg="{{ $message }}"/>
            @enderror
        </div>
        <div class="mt-6">
            @if($pay=='EFECTIVO')
                <div class="input-group">
                    <div id="input-group-3" class="input-group-text"><i class="fas fa-dollar-sign fa-2x"></i></div>
                    <input wire:model="cash" id="cash" type="number"  class="form-control form-control-lg kioskboard" placeholder="0.00">
                </div>
                <h1>Ingresar el Efectivo</h1>
            @else
            <div class="input-group">
                    <div id="input-group-3" class="input-group-text"><i class="fas fa-dollar-sign fa-2x"></i></div>
                    <input wire:model="cash" id="cash" type="number"  class="form-control form-control-lg kioskboard" placeholder="{{number_format($totalCart,2)}}">
                </div>
            @endif
        </div>
        <div class="mt-8">
            @if($totalCart >0 && ($cash>= $totalCart))
            <div class="">
                <button wire:loading.attr="disabled" wire:target="storeSale" wire:click.prevent="storeSale()" class="btn btn-primary w-full"><i class="fas fa-database mr-2"></i> Guardar Venta</button>
            </div>
                <button wire:loading.attr="disabled" wire:target="storeSale" wire:click.prevent="storeSale(true)" class="btn btn-outline-primary w-full mt-5"><i class="fas fa-receipt mr-2"></i> Guardar e Imprimir</button>

            @endif

            @if($totalCart >0)
            <button onclick="Cancel()" class="btn btn-danger w-full mt-5">
             <i class="fas fa-trash mr-2"> </i>
            Cancelar Venta</button>
            @endif

        </div>

    </div>
 </div>
 <!-- END: Post Info -->
 @include('livewire.sales.modal-changes')
 @include('livewire.sales.modal-customers')
 @include('livewire.sales.script')
 @include('livewire.sales.modal-form')



 @include('livewire.sales.keyboard')


 </div>
