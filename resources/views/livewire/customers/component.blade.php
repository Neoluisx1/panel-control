<div>
    @if(!$form)
    <div class="intro-y col-span-12">
    <div class="intro-y box">
    <h2 class="text-lg font-medium text-center text-theme-1 py-4">{{$componentName}}</h2>
    <x-search />
    <div class="p-5">
        <div class="preview">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr class="text-theme-1">
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nombre</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nit</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Telefono</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Ciudad</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Email</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr class="dark:bg-dark-1 {{$loop->index % 2 >0 ? 'bg-gray-200' : ''}}">
                            <td class="dark:border-dark-5">
                                <h6 class="mb-1 font-medium">{{$customer->name}}</h6>
                            </td>
                            <td class="dark:border-dark-5">
                                <h6 class="mb-1 font-medium">{{$customer->ci_nit}}</h6>
                            </td>
                            <td class="dark:border-dark-5">
                                <h6 class="mb-1 font-medium">{{$customer->phone}}</h6>
                            </td>
                            <td class="dark:border-dark-5">
                                <h6 class="mb-1 font-medium">{{$customer->city}}</h6>
                            </td>
                            <td class="dark:border-dark-5">
                                <h6 class="mb-1 font-medium">{{$customer->mail}}</h6>
                            </td>
                            <td class="dark:border-dark-5 text-center">
                                <div class="d-flex justify-content-center">
                                    @if($customer->orders->count() < 1)
                                    <button class="btn btn-danger text-white border-0" onclick="destroy('customers','Destroy','{{$customer->id}}')">
                                        <i class="fas fa-trash fa-2x"></i>
                                    </button>
                                    @endif
                                    <button class="btn btn-warning text-white border-0 ml-3" wire:click.prevent="Edit({{$customer->id}})" type="button">
                                        <i class="fas fa-edit fa-2x"></i></button>
                                </div>
                            </div>
                        </tr>
                        @empty
                        <tr class="bg-gray-200 dark:bg-dark-1">
                            <td colspan="2">
                                <h6 class="text-center">NO HAY CLIENTES</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="col-span-12 p-5">
        {{$customers->links()}}
    </div>
    </div>
    </div>
    @else
        @include('livewire.customers.form')
    @endif

    @include('livewire.sales.keyboard')
    <script>       
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

