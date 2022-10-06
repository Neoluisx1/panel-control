<div>
    @if(!$form)
    <div class="intro-y col-span-12">
        <div class="intro-y box">
            <h2 class="text-lg font-medium text-center text-theme-1 py-4">Sucursales</h2>
            <x-search />
            <div class="p-5">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr class="text-theme-1">
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nombre</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Direccion</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Vendedores Asignados</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($branch as $bo)
                                <tr class="dark:bg-dark-1 {{$loop->index % 2 >0 ? 'bg-gray-200' : ''}}">                                    
                                    <td class="dark:border-dark-5">
                                        <h6 class="mb-1 font-medium">{{$bo->name}}</h6>
                                    </td>
                                    <td class="dark:border-dark-5">
                                        <h6 class="mb-1 font-medium">{{$bo->address}}</h6>
                                    </td>
                                    <td class="dark:border-dark-5">
                                        <h6 class="mb-1 font-medium">{{$bo->users->count()}}</h6>
                                    </td>                                    
                                    <td class="dark:border-dark-5">
                                        <div class="d-flex ">
                                            @if($bo->users->count() < 1)                                            
                                                <button class="btn btn-danger text-white border-0" onclick="destroy('branchoffices','Destroy',{{$bo->id}})" type="button">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                            <button class="btn btn-warning text-white border-0 ml-3" wire:click.prevent="Edit({{$bo->id}})" type="button">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-success text-white border-0 ml-3" wire:click.prevent="Asignados({{$bo->id}})" type="button" title="Ver Asignaciones">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-gray-200 dark:bg-dark-1">
                                    <td colspan="2">
                                        <h6 class="text-center">NO HAY SUCURSALES REGISTRADAS</h6>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-span-12 p-5">
                {{$branch->links()}}
            </div>
        </div>    
    </div>    
    @else
        @include('livewire.branchoffices.form')
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