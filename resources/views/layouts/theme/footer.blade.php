<script src="{{asset('dist/js/app.js')}}"></script>
<script src="{{asset('js/snackbar.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/alpine.js')}}"></script>
<script src="{{asset('dist/apexcharts.js')}}"></script>
<script src="{{asset('dist/apexcharts.amd.js')}}"></script>
<script src="{{asset('dist/apexcharts.common.js')}}"></script>
<script src="{{asset('dist/apexcharts.esm.js')}}"></script>
<script src="{{asset('dist/apexcharts.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/datalist-css/dist/datalist-css.min.jss"></script>

<script>
    window.addEventListener('noty',event => {
        Snackbar.show({
            text: event.detail.msg,
            actionText: 'CERRAR',
            actionTectColor: '#fff',
            backgroundColor: event.detail.type === 'success' ? '#2187EC' : '#e7515a',
            pos: 'top-right'
        });
    })
    function destroy(componentName, methodName = 'Destroy', rowId){
        swal({
            title: 'Confirmas eliminar el Registro',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#e7515a',
            cancelButtonText: 'Cerrar',
            padding: '2em'
        }).then(function(result){
            if(result.value){
                window.livewire.emitTo(componentName, methodName, rowId)
                swal.close()
            }
        })
    }
</script>
