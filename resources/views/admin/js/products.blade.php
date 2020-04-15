{{-- <script> --}}

$(document).ready(function(){
	$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

	$('#productsTbl').DataTable({
			processing: true,
			serverSide: true,
			ajax:{
				url: "{{ route('admin.manageProducts')}}",
			},
			columns: [
						{
						data: 'thumbnail',
						name: 'thumbnail',
						render: function(data, type, full, meta){
							return "<img src={{ URL::to('/') }}/productImg/"+ data +" width='70px' height='100px' class='img-thumbnail'/>";
						},
						orderable: false,
					},
					{
						data: 'brandName',
						name: 'brandName'
					},
					{
						data: 'category',
						name: 'category'
					},

					{
						data: 'price',
						name: 'price',
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
	$('#productRestockTbl').DataTable({
			processing: true,
			serverSide: true,
			ajax:{
				url: "{{ route('admin.restockProduct')}}",
			},
			columns: [
						{
						data: 'thumbnail',
						name: 'thumbnail',
						render: function(data, type, full, meta){
							return "<img src={{ URL::to('/') }}/productImg/"+ data +" width='70px' height='100px' class='img-thumbnail'/>";
						},
						orderable: false,
					},
					{
						data: 'brandName',
						name: 'brandName'
					},
					{
						data: 'category',
						name: 'category'
					},

					{
						data: 'quantity',
						name: 'quantity',
					},
					{
						data: 'action',
						name: 'action',
						orderable: false,
						className: "text-center",
					},
			]
	});


	$('#addProduct').on('submit', function(e){
		e.preventDefault();
		Swal.fire({
		  title: 'Are you sure?',
		  text: "",
		  type: 'info',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#B0AEAE',
		  confirmButtonText: 'Confirm'
		}).then((result) => {
		  if (result.value) {

				 $.ajax({
						url: "{{ route('admin.storeProduct')}}",
						method: "POST",
						data: new FormData(this),
						contentType: false,
						cache: false,
						processData: false,
						dataType: "json",
						success:function(data){
							if(data.errors){
								for(var i = 0; i < data.errors.length; i++){
								toastr.error(data.errors[i], 'Error!');
								}
							}
							if(data.success){
								toastr.success(data.success, 'Success!');
								$('#addProduct')[0].reset();
							}
						}
				});
		  }
		});
	});

$(document).on('click', '.clr', function(){
	Swal.fire({
		title: 'Are you sure?',
		text: "",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#B0AEAE',
		confirmButtonText: 'Confirm'
	}).then((result) => {
		if (result.value) {
			$('#addProduct')[0].reset();
		}
	});
});
$(document).on('click', '.edtBtn', function(){
var id = $(this).attr('id');
$('.uptProd').attr('id', id);
	$.ajax({
		url: "products/"+id,
		method: "GET",
		success:function(data){
			$('#Description').val(data.success.description);
			$('#Productname').val(data.success.brandName);
			$('#Category').val(data.success.categoryID);
			$('#size').val(data.success.size);
			$('#price').val(data.success.price);
		}
	});

$('#edtProduct').modal('show');
});

$(document).on('click','.delBtn', function(){
	var id = $(this).attr('id');
	Swal.fire({
		title: 'Are you sure?',
		text: "This record will be removed.",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#B0AEAE',
		confirmButtonText: 'Confirm'
	}).then((result) => {
		if (result.value) {
			$.ajax({
					type: 'DELETE',
					url: "products/del/"+id,
					success:function(data){
						if(data.success){
							toastr.success(data.success, 'Success!');
						}
						$('#productsTbl').DataTable().ajax.reload();
					}
			});
		}
	});
});

$(document).on('click', '.restk', function(){
	var id = $(this).attr('id');
	$('.stkBtn').attr('id', id);
	$('#restockMpdal').modal('show');
});


$('#restockForm').on('submit', function(e){
	e.preventDefault();
	var id = $('.stkBtn').attr('id');

	$.ajax({
		url: "restock/"+id,
		method:"POST",
		data:new FormData(this),
		contentType: false,
		cache: false,
		processData: false,
		dataType: "json",
		success:function(data){
			if(data.success){
			toastr.success(data.success, 'Success!');
			}
		$('#productRestockTbl').DataTable().ajax.reload();
		$('#restockMpdal').modal('hide');
		$('#restockForm')[0].reset();
		}
	});

});

$('#editProdForm').on('submit', function(e){
	e.preventDefault();
	var id = $('.uptProd').attr('id');

	$.ajax({
		url: "products/update/"+id,
		method:"POST",
		data:new FormData(this),
		contentType: false,
		cache: false,
		processData: false,
		dataType: "json",
		success:function(data){
			if(data.errors){
				for(var i = 0; i < data.errors.length; i++){
				toastr.error(data.errors[i], 'Error!');
				}
			}
			if(data.success){
			toastr.success(data.success, 'Success!');
			}
		$('#productsTbl').DataTable().ajax.reload();
		$('#edtProduct').modal('hide');
		}
	});

});
});
