<div class="intro-y col-span-12">
    <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                Configuraciones
                </h2>
            </div>
            <div class="p-5">
                <div class="preview grid grid-cols-12 gap-5">
                    <div class="col-span-12">
                        <label for="" class="form-label">Nombre del Negocio:</label>
                        <input wire:model="name" type="text" class="form-control kiosboard" placeholder="Nombre Negocio">
                        @error('name')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                    <div class="col-span-12">
                        <label for="" class="form-label">Dirreccion:</label>
                        <input wire:model="address" type="text" class="form-control kiosboard" placeholder="Nombre Negocio">
                        @error('address')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <label for="" class="form-label">Telefono:</label>
                        <input wire:model="phone" type="text" class="form-control kiosboard" placeholder="Nombre Negocio">
                        @error('phone')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <label for="" class="form-label">Leyenda:</label>
                        <input wire:model="leyend" type="text" class="form-control kiosboard" placeholder="Nombre Negocio">
                        @error('leyend')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <label for="" class="form-label">Impresora:</label>
                        <input wire:model="printer" type="text" class="form-control kiosboard" placeholder="Nombre Negocio">
                        @error('printer')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                    <div class="col-span-12">
                        <label for="" class="form-label">Imagen (Logo Tickets)</label>
                        <input wire:model="logo" accept="image/x-png,image/jpeg,image/jpg" type="file" class="form-control kiosboard" placeholder="Nombre Negocio">
                        @error('logo')
                            <x-alert msg="{{ $message }}"/>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer">
                        @if ($logoPreview)
                            <img class="rounded-lg recent-product-img" data-action="zoom" src="{{ asset($logoPreview) }}" width="200" alt="">
                            <div class="dark:text-gray-400">Logo Actual</div>
                        @endif
                    </div>
                    <div class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer">
                        @if ($logo)
                            <img class="rounded-lg recent-product-img" data-action="zoom" src="{{ $logo->temporaryUrl() }}" width="200" alt="">
                            <div class="dark:text-gray-400">Logo Nuevo</div>
                        @endif
                    </div>
                    <div class="col-span-12">
                        <x-save/>
                    </div>
                </div>
            </div>
    </div>    
</div>