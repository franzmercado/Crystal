$(document).ready(function() {


	$('#categoryTbl').DataTable({

			processing: true,
			serverSide: true,
			searching: false,
			ajax:{
				url: "{{ route('admin.categories.index')}}",
			},
			columns: [
						{
						data: 'id',
						name: 'id'
					},
          {
          data: 'description',
          name: 'description'
          },
					{
						data: 'action',
						name: 'action',
						orderable: false,
						className: "text-center",
					},
			]
	});

$('#addForm').on('submit', function(e){
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
					url: "{{ route('admin.categories.store')}}",
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
						}
						$('#categoryTbl').DataTable().ajax.reload();
						$('#addCategory').modal('hide');
					}
			});
	  }
	});
});

$(document).on('click','.delete', function(){
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
					url: "categories/"+id,
					success:function(data){
						if(data.success){
							toastr.success(data.success, 'Success!');
						}else{
							toastr.error(data.error, 'Error!');

						}
						$('#categoryTbl').DataTable().ajax.reload();
					}
			});
		}
	});
});

$(document).on('click','.edit', function(){
	var id = $(this).attr('id');
	$('.uptBtn').attr('id', id);
	$.ajax({
	url: "categories/"+id+"/edit",
	dataType: "json",
	success:function(data){
		$('#descriptions').val(data.category.description);
		$('#editCategory').modal('show');
	}
	});
});

$('#editForm').on('submit', function(e){
	e.preventDefault();
	var id = $('.uptBtn').attr('id');

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
			$.ajax({
				 url: "categories/"+id,
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
				 $('#categoryTbl').DataTable().ajax.reload();
				 $('#editCategory').modal('hide');

				 }
		 });
	  }
	});

	});



{{-- end close --}}
});

// reset modal data on when modal is hidden
$(document).ready(function(){
	$('#addCategory').on('hidden.bs.modal', function(e) {
		$('#addForm')[0].reset();
	});
});
