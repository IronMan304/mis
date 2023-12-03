<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeCustomerModal', () => {
		$('#customerModal').modal('hide');
	});

	window.livewire.on('openCustomerModal', () => {
		$('#customerModal').modal('show');
	});

	window.livewire.on('closeCustomerAccountModal', () => {
		$('#customerAccountModal').modal('hide');
	});

	window.livewire.on('openCustomerAccountModal', () => {
		$('#customerAccountModal').modal('show');
	});
	// window.livewire.on('hidePatientAccountButton', () => {
	// 	$('#patientAccountButton').modal('hide');
	// });

	// window.livewire.on('showPatientAccountButton', () => {
	// 	$('#patientAccountButton').modal('show');
	// });

	// window.livewire.on('closeSignatureModal', () => {
	// 	$('#signatureModal').modal('hide');
	// });

	// window.livewire.on('openSignatureModal', () => {
	// 	$('#signatureModal').modal('show');
	// });

	// window.livewire.on('closePatientResultViewModal', () => {
	// 	$('#patientResultViewModal').modal('hide');
	// });

	// window.livewire.on('openPatientResultViewModal', () => {
	// 	$('#patientResultViewModal').modal('show');
	// });
</script>
