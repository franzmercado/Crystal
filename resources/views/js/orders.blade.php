{{-- <script> --}}
$(document).ready(function(){

  $(document).on('click', '.cnlOrder', function(){
  	var id = $(this).attr('rel');
  	Swal.fire({
  		title: 'Are you sure?',
  		text: "This Order will be Cancelled.",
  		type: 'warning',
  		showCancelButton: true,
  		cancelButtonColor: '#B0AEAE',
      confirmButtonColor: '#d33',
  		confirmButtonText: 'Confirm'
  	}).then((result) => {
  		if (result.value) {
  			$.ajax({
  				url: "orders/cancel/"+id,
  				type: "PATCH",
  				data:{
  					id : id,
  					_token : '{{ csrf_token()}}',
  				},
  				dataType: "json",
  				success:function(data){
  					if(data.success){
  					toastr.success(data.success, 'Success!');
  					}
  				$('#purchaseTbl').DataTable().ajax.reload();
  				}
  			});
  		}
  	});

  });

});
