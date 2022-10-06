<div class="intro-y col-span-12">
    <div class="intro-y box">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
            {{$componentName}}|<span class="font-normal">{{$action}}</span>
            </h2>
        </div>
        <div class="p-5">
            <div class="preview">
                <div class="mt-3">
                    <div class="sm:grid grid-cols-3 gap-4">
                        <div>
                            <label for="form-label">NOMBRE</label>
                            <input type="text" wire:model="name" id="name" class="form-control form-control-lg border-start-0 kioskboard" maxlength="225" placeholder="Eje: Juan Choque">
                            @error('name')
                                <x-alert msg="{{ $message }}"/>
                            @enderror
                        </div>
                        <div>
                            <label for="form-label">EMAIL</label>
                            <input type="text" wire:model="email" id="email" class="form-control form-control-lg border-start-0 kioskboard" maxlength="225" placeholder="Eje: juan@gmail.com">
                            @error('email')
                                <x-alert msg="{{ $message }}"/>
                            @enderror
                        </div>
                        <div>
                            <label for="form-label">PASSWORD</label>
                            <input type="password" wire:model="password" id="password" data-kioskboard-type="numpad" class="form-control form-control-lg border-start-0 kioskboard" maxlength="225" placeholder="**********">
                            @error('password')
                                <x-alert msg="{{ $message }}"/>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:grid grid-cols-3 gap-4 mt-5">
                        <div class="bg-amber-500">
                            <label for="" class="form-label">PERFIL</label>
                            <select wire:model="profile" class="form-select form-select-lg sm:mr-2" id="">
                                <option value="elegir">Elegir un Perfil</option>
                                <option value="Admin">Administrador</option>
                                <option value="Employee">Empleado</option>
                            </select>
                            @error('profile')
                                <x-alert msg="{{ $message }}"/>
                            @enderror
                        </div>
                        <div class="bg-amber-500">
                            <label for="" class="form-label">ASIGNAR A:</label>
                            <select wire:model="branchoffice" class="form-select form-select-lg sm:mr-2" id="">
                                <option value="elegir">Elegir una Sucursal</option>
                                @foreach($branchoffices as $bo)
                                    <option value="{{ $bo->id }}">{{ $bo->name }}</option>
                                @endforeach
                            </select>
                            @error('branchoffice')
                                <x-alert msg="{{ $message }}"/>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-6 text-center gap-5">
                        <x-back/>

                        <x-save/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        KioskBoard.run('.kioskboard',{})

        document.querySelectorAll(".kioskboard").forEach(i => i.addEventListener("change", e => {
            switch(e.currentTarget.id){
                case 'name':
                    @this.name = e.target.value
                    break
                case 'email':
                    @this.email = e.target.value
                    break
                case 'password':
                    @this.password = e.target.value
                    break
            }
        }))
    </script>
</div>