{{-- <script> --}}
$(document).ready(function(){

	$('#ordersTbl').DataTable({
			processing: true,
			serverSide: true,
			ajax:{
				url: "{{ route('admin.transactions')}}",
			},
			columns: [
						{
						data: 'transactionID',
						name: 'transactionID',
						orderable: false,
					},
					{
						data: 'name',
						name: 'name'
					},
					{
						data: 'status',
						name: 'status'
					},

					{
						data: 'total',
						name: 'total',
						render: $.fn.DataTable.render.number(',','.','2'),
					},
					{
						data: 'action',
						name: 'action',
						orderable: false,
						className: "text-center",
					},
			]
	});

$(document).on('click', '.shwOrder', function(){
	var id = $(this).attr('id');

	$.ajax({
		url: "transactions/"+id,
		method: "GET",
		success:function(data){
			console.log(data);
			$('#totalPrice').val(data.success.info.total);
			$('#name').val(data.success.info.name);
			$('#date').val(data.success.info.date);
			$('#contactnum').val('0'+data.success.info.contact);
			$('#address').val(data.success.info.address);

			$.each(data.success.list,function(key, value){
				$('#showORdersTbl > tbody:last-child').append(
				$('<tr>').append(
					$('<td>').text(value.brandName)
					).append(
					$('<td>').text(value.quantity)
					)
				);
			});
		}
	});

	$('.modal-title').text(id);
$('#showOrders').modal('show');
});

$(document).on('click', '.cnclOrder', function(){
	var id = $(this).attr('id');
	Swal.fire({
		title: 'Are you sure?',
		text: "This Transaction will be Cancelled.",
		type: 'info',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#B0AEAE',
		confirmButtonText: 'Confirm'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "transactions/cancel/"+id,
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
				$('#ordersTbl').DataTable().ajax.reload();
				}
			});
		}
	});

});

$(document).on('click', '.actBtn', function(){
	var id = $(this).attr('id');
	Swal.fire({
		title: 'Are you sure?',
		text: "This order will be Accepted.",
		type: 'info',
		showCancelButton: true,
		cancelButtonColor: '#B0AEAE',
		confirmButtonText: 'Confirm'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "transactions/accept/"+id,
				type: "PATCH",
				data:{
					id : id,
					_token : '{{ csrf_token()}}',
				},
				dataType: "json",
				success:function(data){
					if(data.success){
					toastr.success(data.success, 'Success!');
				}else{
					toastr.error(data.error, 'Error!');

				}
				$('#ordersTbl').DataTable().ajax.reload();
				}
			});
		}
	});

});
$(document).on('click', '.shpBtn', function(){
	var id = $(this).attr('id');
	Swal.fire({
		title: 'Are you sure?',
		text: "This order will be Accepted.",
		type: 'info',
		showCancelButton: true,
		cancelButtonColor: '#B0AEAE',
		confirmButtonText: 'Confirm'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "transactions/ship/"+id,
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
				$('#ordersTbl').DataTable().ajax.reload();
				}
			});
		}
	});

});
$(document).on('click', '.delBtn', function(){
	var id = $(this).attr('id');
	Swal.fire({
		title: 'Are you sure?',
		text: "This order will be Accepted.",
		type: 'info',
		showCancelButton: true,
		cancelButtonColor: '#B0AEAE',
		confirmButtonText: 'Confirm'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "transactions/deliver/"+id,
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
				$('#ordersTbl').DataTable().ajax.reload();
				}
			});
		}
	});

});

	$('#showOrders').on('hidden.bs.modal', function(){
		$('#showORdersTbl > tbody > tr').remove();

	});
});
