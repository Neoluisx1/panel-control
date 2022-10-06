<div>
    <div class="intro-y col-span-12">
        <div class="intro-y box">
            <h2 class="text-lg-font-medium text-center text-theme-1 py-4">
                {{$componentName}}
            </h2>
            <div class="intro-y col-span-12 flex flex-wrap col-span-12 sm:flex-nowrap items-center mt-2 p-4">
                <button class="btn btn-primary shadow-md ml-2" onclick="openPanel('add')">Agregar</button>
                <div class="hidden md:block mx-auto text-gray-600">-</div>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-gray-700 dark:text-gray-300">
                        <input type="text" class="form-control w-56 box pr-10 placeholder-theme-13 kioskboard" id="search" wire:model="search" placeholder="Buscar por:">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 fas fa-search"></i>
                    </div>
                </div>
            </div>
            
            <div class="p-5">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr class="text-theme-1">
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" width="10%"></th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" width="30%">DESCRIPCION</th>                                    
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">CATEGORIA</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">COSTO</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">PRECIO</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">STOCK</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr class="dark:bg-dark-1 {{$loop->index % 2 > 0 ? 'bg-gray-200' : ''}}">
                                        <td class="text-center">
                                            <span>
                                                <img src="{{ asset( $product->img) }}" data-action='zoom' alt="" heigth="70" width="80" class="rounded">
                                            </span>
                                        </td>
                                        <td class="dark:border-dar-5">
                                            <h6 class="mb-1 font-medium">{{$product->name}}</h6>
                                            <small class="font-normal">{{$product->sales->count()}} Ventas</small>
                                        </td>                                        
                                        <td>{{ strtoupper($product->category)}}</td>
                                        <td>{{ number_format($product->cost,2)}}</td>
                                        <td>{{ number_format($product->price,2)}}</td>
                                        <td>{{$product->stock}}</td>
                                        
                                        <td class="dark:border-dark-5 text-center">
                                            <div class="d-flex justify-content-center">
                                                @if($product->sales->count() < 1) 
                                                    <button class="btn btn-danger text-white border-0" onclick="destroy('products','Destroy','{{$product->id}}')"><i class="fas fa-trash"></i></button>                                                    
                                                @endif  
                                                    <button class="btn btn-warning text-white border-0 ml-3" wire:click.prevent="Edit({{$product->id}})" title="Editar" type="button">
                                                        <i class="fas fa-edit"></i>
                                                    </button>                                                                                     
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-gray-200 dark:bg-dark-1">
                                        <td colspan="2">
                                            <h6 class="text-center">
                                                NO HAY PRODUCTOS REGISTRADOS.
                                            </h6>
                                        </td>
                                    </tr>
                                @endforelse                               
                            </tbody>
                        </table>
                        {{$products->links()}}
                    </div>    
                </div>    
            </div>            
        </div>
    </div>
    @include('livewire.products.panel')    
    @include('livewire.sales.keyboard')
<script>    
    function openPanel(action = ''){
        if(action == 'add'){
            @this.resetUI()
        }
        var modal = document.getElementById('panelProduct')
        modal.classList.add('overflow-y-auto','show')
        modal.style.cssText = "margin-top: 0px; margin-left:0px; padding-left:17px; z-index:100"
    }
    function closePanel(action = ''){
        var modal = document.getElementById('panelProduct')
        modal.classList.add('overflow-y-auto','show')
        modal.style.cssText = ""
    }
    window.addEventListener('open-modal', event =>{
        openPanel()
    })
    window.addEventListener('noty', event =>{
        if(event.detail.action == 'close-modal') closePanel()
    })
    KioskBoard.run('.kioskboard',{})
    
    document.querySelectorAll(".kioskboard").forEach(i => i.addEventListener("change", e =>{
        switch(e.currentTarget.id){
            case 'name':
                @this.name = e.target.value
                break
            case 'cost':
                @this.cost = e.target.value
                break
            case 'code':
                @this.code = e.target.value
                break
            case 'price':
                @this.price = e.target.value
                break
            case 'price2':
                @this.price2 = e.target.value
                break
            case 'stock':
                @this.stock = e.target.value
                break
            case 'minstock':
                @this.minstock = e.target.value
                break
            default:
        }
    }))
    document.addEventListener('click',(e) => {
            if(e.target.id == 'search'){
                KioskBoard.run('#search',{})

                document.getElementById('search').blur()
                document.getElementById('search').focus()

                const inputSearch = document.getElementById('search')
                inputSearch.addEventListener('change',(e) => {
                    @this.search = e.target.value
                })
            }
        })
</script>
</div>