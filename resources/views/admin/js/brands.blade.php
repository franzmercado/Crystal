$(document).ready(function() {

  $('#brandsTbl').DataTable({

			processing: true,
			serverSide: true,
			searching: false,
			ajax:{
				url: "{{ route('admin.brands.index')}}",
			},
			columns: [
						{
						data: 'brandID',
						name: 'brandID'
					},
          {
          data: 'description',
          name: 'description'
          },
					{
						data: 'action',
						name: 'action',
						orderable: false,
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
  					url: "{{ route('admin.brands.store')}}",
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
  						$('#brandsTbl').DataTable().ajax.reload();
  						$('#addBrand').modal('hide');
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
  					url: "brands/"+id,
  					success:function(data){
  						if(data.success){
  							toastr.success(data.success, 'Success!');
  						}
  						$('#brandsTbl').DataTable().ajax.reload();
  					}
  			});
  		}
  	});
  });

  $(document).on('click','.edit', function(){
	var id = $(this).attr('id');
	$('.uptBtn').attr('id', id);
	$.ajax({
	url: "brands/"+id+"/edit",
	dataType: "json",
	success:function(data){
		$('#descriptions').val(data.brand.description);
		$('#editBrand').modal('show');
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
         url: "brands/"+id,
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
         $('#brandsTbl').DataTable().ajax.reload();
         $('#editBrand').modal('hide');
         }
     });
    }
  });

	});



{{-- end close --}}
});
// reset modal data on when modal is hidden
$(document).ready(function(){
	$('#addBrand').on('hidden.bs.modal', function(e) {
		$('#addForm')[0].reset();
	});
});
