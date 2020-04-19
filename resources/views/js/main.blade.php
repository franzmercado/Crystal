$(document).ready(function() {

  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  setTimeout(function() {
      $(".alert").alert('close');
  }, 3000);


 itemCount();

$(document).on('click', '.addCart', function(){
  var id = $(this).attr('id');
  $.ajax({
     url: "{{ route('addToCart')}}",
     type: "POST",
     data:{
       id : id,
       _token : '{{ csrf_token()}}',
     },
     success:function(data){
        itemCount();
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-secondary'
    },
    buttonsStyling: true
  })

  swalWithBootstrapButtons.fire({
    title: 'Success',
    text: "1 new item have been added to your cart!",
    type: 'success',
    showCancelButton: true,
    confirmButtonText: 'Go to Cart',
    cancelButtonText: 'Continue shopping',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
        window.location.replace("http://crystal.test/carts")
    }
  })
     }
   });
  });

}); 

function itemCount(){
  $.ajax({
     url: "{{ route('countCart')}}",
     type: "GET",
     success:function(data){
       if(data < 1){
         $('#cartCtr').text('');
       }else{
         $('#cartCtr').text(data);
       }
     }
   });
}

	function openTab(evt, cityName) {
	  var i, tabcontent, tablinks;
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
	    tabcontent[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
	    tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }
	  document.getElementById(cityName).style.display = "block";
	  evt.currentTarget.className += " active";
	}
