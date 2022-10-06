<div>
    @if(!$form)
    <div class="intro-y col-span-12">
    <div class="intro-y box">
    <h2 class="text-lg font-medium text-center text-theme-1 py-4">PROVEEDORES</h2>
    <x-search />
    <div class="p-5">
        <div class="preview">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr class="text-theme-1">                            
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">NOMBRE</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">TELEFONO</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">DIRECCION</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">EMAIL</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($providers as $provider)
                        <tr class="dark:bg-dark-1 {{$loop->index % 2 >0 ? 'bg-gray-200' : ''}}">                            
                            <td>{{$provider->name}}</td>
                            <td>{{$provider->phone}}</td>
                            <td>{{$provider->address}}</td>
                            <td>{{$provider->email}}</td>
                            <td class="dark:border-dark-5 text-center">
                                <div class="d-flex justify-content-center">
                                    @if($provider->purchase->count() < 1)
                                    <button class="btn btn-danger text-white border-0" onclick="destroy('providers','Destroy',{{$provider->id}})" type="button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                    <button class="btn btn-warning text-white border-0 ml-3" wire:click.prevent="Edit({{$provider->id}})" type="button">
                                        <i class="fas fa-edit"></i></button>
                                </div>
                            </div>
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
        {{$providers->links()}}
    </div>
    </div>
    </div>
    @else
        @include('livewire.providers.form')
    @endif

        @include('livewire.sales.keyboard')
    <script>
        document.addEventListener('click', (e)=>{
            if(e.target.id == 'search'){
                KioskBoard.run('#search',{})

                document.getElementById('search').blur()
                document.getElementById('search').focus()

                const inputSearch = document.getElementById('search')
                inputSearch.addEventListener('change',(e)=>{
                @this.search=e.target.value
                })
            }
        })        
    </script>
</div>
