<div>
    <div class=" col-span-12">
        <div class="intro-y box">
            <h2 class="text-lg font-medium text-center text-theme-1 py-4">
                REPORTE DE VENTAS
            </h2>
            <div class="grid grid-cols-12 gap-5 p-5">
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 ">
                    <div class="relative ">
                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">
                            <i class="fas fa-calendar fa-2x" class="w-5 h-5"></i>
                        </div>
                        <input wire:model="startDate" id="f1" type="text" class="form-control form-control-lg text-center mydp">
                    </div>
                    <div class="font-normal">Fecha Inicial</div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 ">
                    <div class="relative ">
                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">
                            <i class="fas fa-calendar fa-2x" class="w-5 h-5"></i>
                        </div>
                        <input wire:model="endDate" id="f2" type="text" class="form-control form-control-lg text-center mydp">
                    </div>
                    <div class="font-normal">Fecha Final</div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-2 ">
                    <button onclick="openModalUser()" class="btn btn-dark w-full">{{$userId}}</button>
                    <div class="font-normal">Usuario</div>
                </div>

                <div class="col-span-12 sm:col-span-6 xl:col-span-4 ">
                    @if($startDate !='' && $endDate !='')
                    <button wire:click.prevent="getReport" class="btn btn-primary " >Consultar</button>
                    @endif
                </div>
            </div>
            <div class="p-5" id="striped-rows-table">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr class="text-theme-1">
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">FOLIO</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">TOTAL</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">ITEMS</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">USUARIO</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">CLIENTE</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">FECHA</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr class="dark:bg-dark-1 {{$loop->index % 2 >0 ? 'bg-gray-200' : '' }} font-normal">
                                    <td class="text-center"> {{ $order->id }} </td>
                                    <td class="text-center"> ${{ number_format($order->total,2) }} </td>
                                    <td class="text-center"> {{ $order->items }} </td>
                                    <td class="text-center"> {{ $order->user->name }} </td>
                                    <td class="text-center"> {{ $order->customer->name }} </td>
                                    <td class="text-center"> {{ $order->created_at }} </td>
                                    <td class="dark:border-dark-5 text-center">
                                        <button wire:click.prevent="rePrint({{ $order->id }})" type="button" class="ms-3 btn btn-warning text-white bg-light border-0 ml-3"><i class="fas fa-print fa-2x"></i></button>
                                        <button wire:click.prevent="viewDetails({{ $order->id }})" type="button" class="ms-3 btn btn-warning text-white bg-light border-0 ml-3"><i class="fas fa-eye fa-2x"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-gray-200 dark:bg-dark-1">
                                    <td colspan="7">
                                        <h6 class="text-center">SIN INFORMACIÓN</h6>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="font-large bg-theme-26   text-white">
                                    <td>TOTALES</td>
                                    <td class="text-center">${{number_format($orders->sum('total'),2) }}</td>
                                    <td class="text-center">{{$orders->sum('items')}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-span-12 p-5">
                @if(count($orders) > 0)
                {{$orders->links()}}
                @endif
            </div>
        </div>
    </div>   
    @include('livewire.reports.detail')
    @include('livewire.reports.modal-users')
    @include('livewire.sales.keyboard')

    <script>
        document.querySelectorAll('.mydp').forEach(function(el) {
            const myDatePicker = MCDatepicker.create({
                el : '#' + el.getAttribute('id'),
                autoClose: true,
                customOkBTN: 'ACEPTAR',
                customClearBTN: 'Borrar',
                customCancelBTN: 'CANCELAR',
                dateFormat: 'YYYY-MM-DD',
                customWeekDays: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
                customMonths: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            })
            myDatePicker.onSelect((date, formatedDate) => {
                if (myDatePicker.el == '#f1')
                    @this.startDate = formatedDate
                else
                    @this.endDate = formatedDate
                })
        })              
        function openModalUser() {
            var modal = document.getElementById('modalUser')
            modal.classList.add('overflow-y-auto', 'show')
            modal.style.cssText = "margin-top: 0px; margin-left: -100px; z-index: 1000;"            
        }
        function closeModalUser() {
            var modal = document.getElementById('modalUser')
            modal.classList.add('overflow-y-auto', 'show')
            modal.style.cssText = ""
        }
        function openModalDetail() {
            var modal = document.getElementById('modalDetail')
            modal.classList.add('overflow-y-auto', 'show')
            modal.style.cssText = "margin-top: 0px; margin-left: -100px; z-index: 1000"
        }
        function closeModalDetail() {
            var modal = document.getElementById('modalDetail')
            modal.classList.add('overflow-y-auto', 'show')
            modal.style.cssText = ""
        }
        window.addEventListener('open-modal-detail', event => {
            openModalDetail()
        })
        window.addEventListener('close-modal-user', event => {
            closeModalUser()
        })
        
        const inputSearch = document.getElementById('usersearch')
        inputSearch.addEventListener('change', (e) => {
            @this.usersearch=e.target.value
        })   
           
    </script>
</div>