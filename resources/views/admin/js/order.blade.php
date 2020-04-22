{{-- <script> --}}
$(document).ready(function(){

	$('#ordersTbl').DataTable({
			processing: true,
			serverSide: true,
			rowId: 'transactionID',

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
						data: 'dateOrder',
						name: 'dateOrder'
					},
					{
						data: 'dateFinished',
						name: 'dateFinished'
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

			]
	});

$(document).on('dblclick', '#ordersTbl tr', function(){
	var id = $(this).attr('id');

	$.ajax({
		url: "transactions/"+id,
		method: "GET",
		success:function(data){
			{{-- console.log(data); --}}
			$('#totalPrice').val(data.success.info.total);
			$('#name').val(data.success.info.name);
			$('#status').val(data.success.info.status);

			$('#date').val(data.success.info.date);
			if(data.success.info.status == 4){
				$('#Fdate').val(data.success.info.Fdate);
				$('.FinishedDate').attr('style', 'display: block;');

			}else if(data.success.info.status == 1){
				$('.actBtn').attr('style', 'display: block;');
				$('.decBtn').attr('style', 'display: block;');
			}else if(data.success.info.status == 2){
				$('.shpBtn').attr('style', 'display: block;');
				$('.cnclOrder').attr('style', 'display: block;');
			}else if(data.success.info.status == 3){
				$('.delBtn').attr('style', 'display: block;');
				$('.cnclOrder').attr('style', 'display: block;');

			}

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
	var id = $('#transID').text();

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
$(document).on('click', '.decBtn', function(){
	var id = $('#transID').text();

	Swal.fire({
		title: 'Are you sure?',
		text: "This Order will be declined.",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#B0AEAE',
		confirmButtonText: 'Confirm'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "transactions/decline/"+id,
				type: "PATCH",
				data:{
					id : id,
					_token : '{{ csrf_token()}}',
				},
				dataType: "json",
				success:function(data){
					if(data.success){
						$('#showOrders').modal('hide');
					toastr.success(data.success, 'Success!');
					}
				$('#ordersTbl').DataTable().ajax.reload();
				}
			});
		}
	});

});
$(document).on('click', '.actBtn', function(){
	var id = $('#transID').text();

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
					$('#showOrders').modal('hide');
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
	var id = $('#transID').text();

	Swal.fire({
		title: 'Are you sure?',
		text: "This order will be marked as Shipped.",
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
						$('#showOrders').modal('hide');
					toastr.success(data.success, 'Success!');
					}
				$('#ordersTbl').DataTable().ajax.reload();
				}
			});
		}
	});

});
$(document).on('click', '.delBtn', function(){
	var id = $('#transID').text();

	Swal.fire({
		title: 'Are you sure?',
		text: "This order will be Completed.",
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
						$('#showOrders').modal('hide');
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
		$('.FinishedDate').attr('style','display: none;');
		$('.actBtn').attr('style','display: none;');
		$('.shpBtn').attr('style','display: none;');
		$('.delBtn').attr('style','display: none;');
		$('.decBtn').attr('style','display: none;');
		$('.cnclOrder').attr('style','display: none;');




	});
});
