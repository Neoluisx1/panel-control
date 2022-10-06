<div wire:ignore.self id="modalUser" class="modal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    <b class="text-theme-1">Elegir Usuario</b>
                </h2>
            </div>

            <div class="modal-body grid gap-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="p-5" id="striped-rows-table">
                            <div class="preview">
                                <div class="overflow-x-auto">
                                   
                                    <div class="input-group">
                                        <div id="input-group-3" class="input-group-text"><i class="fas fa-search"></i></div>
                                        <input wire:model="usersearch" id="usersearch" type="text" class="form-control form-control-lg kioskboard" placeholder="Buscar" >
                                    </div>


                                    <table class="table">
                                        <thead>
                                            <tr class="text-theme-6">
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold" width="80%"></th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($users as $user)
                                            <tr class="dark:bg-dark-1 text-lg {{$loop->index % 2 > 0 ? 'bg-gray-200' : ''}}">
                                                <td class="border-b dark:border-dark-5 ">
                                                    {{$user->name}}
                                                </td>
                                                <td>
                                                    <button wire:click.prevent="$set('userId', '{{ $user->name . ' | ' . $user->id}}')" class="btn btn-outline-primary">Seleccionar</button>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">NO HAY CLIENTES REGISTRADOS</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer text-right">
                <button onclick="closeModalUser()" class="btn btn-outline-secondary mr-5">Cerrar Ventana</button>
            </div>

        </div>
    </div>
</div>