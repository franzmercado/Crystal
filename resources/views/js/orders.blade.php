{{-- <script> --}}
$(document).ready(function(){

	$('#purchaseTbl').DataTable({
			processing: true,
			serverSide: true,
			ajax:{
				url: "{{ route('orders')}}",
			},
			columns: [
						{
						data: 'transactionID',
						name: 'transactionID',
						orderable: false
					},
					{
						data: 'items',
						name: 'items',
            orderable: false

					},
          {
						data: 'dOrder',
						name: 'dOrder'
					},
          {
            data: 'dDelivered',
            name: 'dDelivered'
          },

					{
						data: 'total',
						name: 'total',
						render: $.fn.DataTable.render.number(',','.','2'),
					},
          {
            data: 'status',
            name: 'status'
          },
					{
						data: 'action',
						name: 'action',
						orderable: false,
						className: "text-center",
					},
			]
	});

  $(document).on('click', '.cnlOrder', function(){
  	var id = $(this).attr('id');
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
