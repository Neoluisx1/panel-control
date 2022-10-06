<div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 p-4">
    <button wire:click.prevent="$set('form',true)" class="btn btn-primary shadows-md mr-2 w-full sm:w-auto">Agregar</button>

    <div class="hidden md:block mx-auto text-gray-600">-</div>

        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="relative text-gray-700 dark:text-gray-300">
                <input wire:model="search" id="search" type="text" class="form-control box placeholder-theme13 kioskboard w-full sm:w-auto" placeholder="Buscar">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 fas fa-search"></i>
                </span>
            </div>

        </div>
</div>
