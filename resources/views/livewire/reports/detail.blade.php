<div wire:ignore.self id="modalDetail" class="modal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    <b class="text-theme-1">DETALLES DE LA VENTA # {{ $details[0]->order->id ?? 0}}</b>
                </h2>
            </div>

            <div class="modal-body grid gap-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="p-5" id="striped-rows-table">
                            <div class="preview">
                                <div class="overflow-x-auto">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-theme-6">
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold">PRODUCTO</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold">PRECIO</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold">CANT</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold">IMPORTE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($details as $detail)
                                            <tr class="dark:bg-dark-1 text-lg {{$loop->index % 2 > 0 ? 'bg-gray-200' : ''}}">
                                                <td class="border-b dark:border-dark-5">
                                                    {{ ($detail->product->name) }}
                                                    <div>
                                                        <small>{{$detail->changes}}</small>
                                                    </div>
                                                </td>
                                                <td class="border-b dark:border-dark-5 text-center">
                                                    {{number_format($detail->price,2)}}
                                                </td>
                                                <td class="border-b dark:border-dark-5 text-center">
                                                    {{ number_format($detail->quantity,0)}}
                                                </td>
                                                <td class="border-b dark:border-dark-5 text-center">
                                                    {{number_format($detail->price * $detail->quantity,2)}}
                                                </td>                                                
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4" class="text-center">NO HAY DETALLES REGISTRADOS</td>
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
                <button onclick="closeModalDetail()" class="btn btn-outline-secondary mr-5">Cerrar Ventana</button>
            </div>

        </div>
    </div>
</div>