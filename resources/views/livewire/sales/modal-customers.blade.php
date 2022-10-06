<div wire:ignore.self id="modalCustomer" class="modal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    <b class="text-theme-1">Elegir Cliente</b>
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
                                        <input wire:model="searchcustomer" id="customer-search" type="text" class="form-control form-control-lg kioskboard" placeholder="Buscar por C.I. o por NIT" >
                                    </div>


                                    <table class="table">
                                        <thead>
                                            <tr class="text-theme-6">
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold" width="80%"></th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($customers as $customer)
                                            <tr class="dark:bg-dark-1 text-lg {{$loop->index % 2 > 0 ? 'bg-gray-200' : ''}}">
                                                <td class="border-b dark:border-dark-5 ">
                                                    {{$customer->name}}
                                                </td>
                                                <td>
                                                    {{$customer->ci_nit}}
                                                </td>
                                                <td>
                                                    <button wire:click.prevent="$set('customerSelected', '{{$customer->name}}')" class="btn btn-outline-primary">Seleccionar</button>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">NO HAY CLIENTES REGISTRADOS</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <button onclick="openModalAddCustomer()" class="btn btn-success mb-3">Registrar CLIENTE</button>
                                                </td>
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
                <button onclick="closeModalCustomer()" class="btn btn-outline-secondary mr-5">Cerrar Ventana</button>
            </div>

        </div>
    </div>
</div>