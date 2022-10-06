<div>
    @if(!$form)
    <div class="intro-y col-span-12">
    <div class="intro-y box">
    <h2 class="text-lg font-medium text-center text-theme-1 py-4">{{$componentName}}</h2>
    <x-search />
    <div class="p-5">
        <div class="preview">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr class="text-theme-1">
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nombre</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nit</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Telefono</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Ciudad</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Email</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ACTION</th>
                        </tr>
                    </thead>

                </table>
            </div>

        </div>
    </div>
    <div class="col-span-12 p-5">

    </div>
    </div>
    </div>

    <script>
        document.addEventListener('click',(e) => {
            if(e.target.id == 'search'){
                KioskBoard.run('#search',{})

                document.getElementById('search').blur()
                document.getElementById('search').focus()

                const inputSearch = document.getElementById('search')
                inputSearch.addEventListener('change',(e)=>{
                @this.search = e.target.value})
            }
        })
    </script>
</div>

