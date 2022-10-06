<div wire:ignore.self id="panelProduct" class="modal modal-slide-over" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <a href="javascript:;" data-dismiss="modal">
                <i class="fas fa-times w-8 h-8 text-gray-500 fa-2x"></i>
            </a>
            <div class="modal-header p-5">
                <h2 class="font-medium text-base mr-auto">GESTION PRODUCTOS</h2>
                <x-save class="mt-4 mr-5"/>
            </div>
            <div class="modal-body mr-5">
                <div class="">
                    <div class="input-group">
                        <div class="input-group-text">NOMBRE:</div>
                        <input type="text" wire:model="name" id="name" class="form-control form-control-lg kioskboard" placeholder="Cerveza">
                    </div>
                    @error('name')
                        <x-alert msg="{{$message}}"/>
                    @enderror
                </div>
                <div class="mt-4">
                    <div class="sm:grid grid-cols-2 gap-2">
                        <div class="input-group">
                            <div class="input-group-text">COSTO:</div>
                            <input type="number" id="cost" wire:model="cost" class="form-control form-control-lg kioskboard" data-kioskboard-type="numpad" placeholder="eje: 100">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text">CODIGO:</div>
                            <input type="text" id="code" wire:model="code" class="form-control form-control-lg kioskboard" placeholder="eje: 10RS0">
                        </div>
                        @error('cost')
                            <x-alert msg="{{$message}}"/>
                        @enderror
                        @error('code')
                            <x-alert msg="{{$message}}"/>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <div class="input-group">
                        <div class="input-group-text">PRECIO 1:</div>
                        <input type="number" id="price" wire:model="price" class="form-control form-control-lg kioskboard " data-kioskboard-type="numpad" placeholder="eje: 500">
                    </div>
                </div>
                    @error('price')
                        <x-alert msg="{{$message}}"/>
                    @enderror
                <div class="mt-4">
                    <div class="input-group">
                        <div class="input-group-text">PRECIO 2:</div>
                        <input type="number" id="price2" wire:model="price2" class="form-control form-control-lg kioskboard" data-kioskboard-type="numpad" placeholder="eje: 500">
                    </div>
                </div>
                    @error('price2')
                        <x-alert msg="{{$message}}"/>
                    @enderror
                <div class="mt-4">
                    <div class="sm:grid grid-cols-2 gap-2">
                        <div class="input-group">
                            <div class="input-group-text">STOCK:</div>
                            <input type="number" id="stock" wire:model="stock" class="form-control form-control-lg kioskboard" data-kioskboard-type="numpad" placeholder="eje: 500">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text">MINIMOS:</div>
                            <input type="number" id="minstock" wire:model="minstock" class="form-control form-control-lg kioskboard" placeholder="eje: 10RS0">
                        </div>
                        @error('stock')
                            <x-alert msg="{{$message}}"/>
                        @enderror
                        @error('minstock')
                            <x-alert msg="{{$message}}"/>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <div class="input-group">
                        <div class="input-group-text">CATEGORIA:</div>
                        <select wire:model="category" class="form-select form-select-lg sm:mr-2" id="">
                            <option value="Elegir">Elegir</option>
                            @foreach ( $categories  as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <x-alert msg="{{$message}}"/>
                    @enderror
                </div>
                <div class="mt-4">
                    <div class="grid grid-flow-col auto-cols-max md:auto-cols-min grap-2">
                        <div>
                            <label for="">IMAGENES:</label>
                            <input type="file" id="" class="form-control" wire:model.defer="gallery" accept="imagex-png, image/jpeg" multiple>
                            @error('gallery')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div wire:loading wire:target="gallery" style="color:rgb(0, 4, 255);">Subiendo imagenes...</div>
                    </div>
                    @if(!empty($gallery))
                        <div class="sm:grid-cols-12 md:grid-cols-2 grid grid-cols-3 gap-2 pt-2 overflow-y-auto">
                            @foreach ($gallery as $photo)
                                <div>
                                    <img src="{{$photo->temporaryUrl() }}" alt="" class="rounded-lg" alt="image">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>            
        </div>
    </div>
</div>