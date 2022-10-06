<script>
	function Cancel() {
		swal({
			title: '¿DESEAS CANCELAR LA VENTA?',
			text: "",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#e7515a',
			cancelButtonText: 'Cerrar',
			padding: '2em'
		}).then(function(result) {
			if (result.value) {
				window.livewire.emit('cancelSale')
				swal.close()
			}
		})
	}	



	function openModal(prodId, currentChanges, productName) {
		console.log(prodId, currentChanges, productName)
		var modal = document.getElementById("modalChanges")
		document.getElementById('changesProduct').value = currentChanges
		@this.productIdSelected = prodId
		@this.productChangesSelected = currentChanges
		@this.productNameSelected = productName
		modal.classList.add("overflow-y-auto", "show")
		modal.style.cssText = "margin-top: 0px; margin-left: -100px;  z-index: 1000;"
	}

	function closeModal() {
		var modal = document.getElementById("modalChanges")
		modal.classList.remove("overflow-y-auto", "show")
		modal.style.cssText = ""             
	}

	function openModalCustomer() {
		var modal = document.getElementById("modalCustomer")
		modal.classList.add("overflow-y-auto", "show")
		modal.style.cssText = "margin-top: 0px; margin-left: -100px;  z-index: 1000;"
	}
	//Modal para registrar usuarios nuevos en sales
	function openModalAddCustomer() {
		var modal = document.getElementById("modalAddCustomer")
		modal.classList.add("overflow-y-auto", "show")
		modal.style.cssText = "margin-top: 0px; margin-left: -100px;  z-index: 1000;"
	}
	function closeModalAddCustomer() {
		var modal = document.getElementById("modalAddCustomer")
		modal.classList.remove("overflow-y-auto", "show")
		modal.style.cssText = ""             
	}

	function closeModalCustomer() {
		var modal = document.getElementById("modalCustomer")
		modal.classList.remove("overflow-y-auto", "show")
		modal.style.cssText = ""
	}

         // events listeners
         window.addEventListener('close-modal-changes', event => {
         	closeModal()
         })
         window.addEventListener('close-customer-modal', event => {
         	closeModalCustomer()
         })
		 //evento para cerrar modal para agregar cliente en ventas
		 window.addEventListener('closeModalAddCustomer', event => {
			closeModalAddCustomer()
         })

         // sync properties values
         const input = document.getElementById('customer-search')
         input.addEventListener('change', (e) => {
         	@this.searchcustomer = e.target.value;
         })
         const inputCash = document.getElementById('cash')
         inputCash.addEventListener('change', (e) => {
         	@this.cash = e.target.value;
         })


         document.addEventListener('click', (e) => {
         	//console.log(e.target.getAttribute('data-kioskboard-type'))
         	if (e.target.getAttribute('data-type') === 'qty') {
         		KioskBoard.run('#' + e.target.id, {})
         		document.getElementById(e.target.id).blur()
         		document.getElementById(e.target.id).focus()

         	}
         })


     </script>