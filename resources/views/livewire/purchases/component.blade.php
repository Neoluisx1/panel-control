<div>
    @if (!$form)
    <div class="intro-y col-span-12">
        <div class="intro-y box">
        <h2 class="text-lg font-medium text-center text-theme-1 py-4">LISTA DE COMPRAS</h2>
        <x-searched />
        <div class="p-5">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead class="text-xs" style="height: 10px;">
                            <tr class="text-theme-1">                            
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">FECHA</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">REFERENCIA</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">PROVEEDOR</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">ESTADO</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">TOTAL</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">PAGADO</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">BALANCE</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">ESTADO DE PAGO</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchases as $p)
                            <tr class="text-xs dark:bg-dark-1 {{$loop->index % 2 >0 ? 'bg bg-gray-200' : ''}}" style="line-height: 0rem;">                            
                                <td style="padding: 0.4rem 0.75rem;">{{$p->created_at}}</td>
                                <td style="padding: 0.4rem 0.75rem;">{{$p->references}}</td>
                                <td style="padding: 0.4rem 0.75rem;">{{$p->provider}}</td>
                                <td style="padding: 0.4rem 0.75rem;" class="{{ ($p->status === 'Recibido') ? 'text-theme-9' : 'text-theme-6'}}"> {{ $p->status }}</td>                            
                                <td style="padding: 0.4rem 0.75rem;">{{$p->total}}</td>
                                <td style="padding: 0.4rem 0.75rem;">{{$p->payment}}</td>
                                <td style="padding: 0.4rem 0.75rem;">{{$p->total - $p->payment}}</td>
                                <td style="padding: 0.4rem 0.75rem;" class="{{ ($p->payment === 'Pagado') ? 'text-theme-6' : 'text-theme-9'}}">{{$p->pay_status}}</td>
                                <td style="padding: 0.4rem 0.75rem;" class="dark:border-dark-5 text-center">
                                    <div class="d-flex justify-content-center">                                    
                                        <div class="dropdown">
                                            <button class="dropdown-toggle btn btn-primary shadow-md flex items-center h-5" aria-expanded="false"> Acciones <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4 ml-2"><polyline points="6 9 12 15 18 9"></polyline></svg> </button>
                                            <div class="dropdown-menu w-40 h-5 text-xs" id="_07cpqda58">
                                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor"><path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" /><path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" /></svg> Editar Compra </a>
                                                    <a href="purchases_details/{{$p->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text w-4 h-4 mr-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Detalle Compra </a>
                                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg> Ver Pagos </a>
                                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg> Añadir Pagos </a>
                                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg> Eliminar Compra </a>
                                                </div>
                                            </div>
                                        </div>                                  
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-gray-200 dark:bg-dark-1">
                                <td colspan="2">
                                    <h6 class="text-center">NO HAY CATEGORIAS REGISTRADAS</h6>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-span-12 p-5">
            {{$purchases->links()}}
        </div>        
    </div>
    @elseif (!$show === true)
        @include('livewire.purchases.edit')
    @else
        @include('livewire.purchases.form')
    @endif
        @include('livewire.sales.keyboard')
    <script>
        function openModalAddProvider() {
        var modal = document.getElementById("modalAddProvider")
        modal.classList.add("overflow-y-auto", "show")
        modal.style.cssText = "margin-top: 0px; margin-left: -100px;  z-index: 1000;"
        }
        function closeModalAddProvider() {
            var modal = document.getElementById("modalAddProvider")
            modal.classList.remove("overflow-y-auto", "show")
            modal.style.cssText = ""             
        }
        window.addEventListener('closeModalAddProvider', event => {
			closeModalAddProvider()
         })
        document.addEventListener('click',(e) => {            
            if(e.target.id == 'search'){
                KioskBoard.run('#search',{})

                document.getElementById('search').blur()
                document.getElementById('search').focus()

                const inputSearch = document.getElementById('search')
                inputSearch.addEventListener('change',(e)=>{
                @this.search = e.target.value})
            }
        })  
    </script>
</div>