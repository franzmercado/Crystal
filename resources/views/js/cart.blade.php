$(document).ready(function() {


  $.ajax({
            url: "{{ route('getCarts')}}",
            method: "GET",
            dataType: "json",
            success:function(data){
              if(!$.trim(data)){
                $('.pcdBtn').attr('style', 'display:none;');
                $('#subShip').text(0.00);
                $('#total').text(0.00);
                $('.cartItems').append(
                  $('<li>').attr('class', 'list-group-item').append(
                    $('<p>').text('Your Cart is empty!')
                    ));
              }else{
                $.each(data,function(key, value){
                  {{-- console.log(value); --}}

                  $('.pcdBtn').removeAttr('style');
                  var i = key + 1;

                  var cat = value.categoryID;
                  var shows = value.prodID;
                  var showRef = '/category='+cat+'/show='+shows;
                  var srcImg = "{{ URL::to('/') }}/productImg/"+value.thumbnail;

                  $('.cartItems').append(
                    $('<li>').attr('class', 'list-group-item cartItem').append(
                      $('<div>').attr('class', 'row').append(
                        $('<div>').attr('class', 'float-left').append(
                          $('<div>').attr('class', 'form-check'))).append(
                            $('<img>').attr({'src': srcImg, 'class': 'float-left', 'width': '60px'})
                            ).append(
                            $('<div>').attr('class', 'col-md-6 cartItemDesc').append(
                              $('<a>').attr('href', showRef).append(
                                $('<h5>').text(value.brandName)
                                ).append(
                                $('<p>').text('Category: '+value.description)
                                ).append(
                                $('<p>').text('Size: '+ value.size)
                                ).append(
                                $('<p>').text('Stock: '+value.quantity)
                                ))).append(
                                $('<div>').attr('class', 'col-md-2').append(
                                  $('<label>').text('Price')
                                  ).append(
                                  $('<input>').attr({'type': 'text', 'class': 'form-control valPrices', 'name': 'valPrice[]', 'readonly': true, 'value': value.price.toFixed(2)})
                                  ).append(
                                  $('<button>').attr({'type': 'button', 'class': 'btn btn-danger btn-sm delBtn', 'id': value.id}).append(
                                    $('<i>').attr('class', 'fa fa-trash-alt fa-lg')
                                    ).append(
                                    $('<input>').attr({'type': 'hidden', 'class' : ' ctr', 'name': 'ctr', 'value': 0})
                                    )
                                  )
                                ).append(
                                $('<div>').attr('class', 'col-md-2').append(
                                      $('<label>').text('Qty.').append(
                                        $('<input>').attr({'type': 'number', 'class' : 'form-control mt-2 valQty', 'name': 'valQtys[]','id': value.price,'rel': value.id, 'value': value.qty, 'min': 1,'max': value.quantity , 'steps': 1, 'onkeydown': 'return false'})
                                        ).append(
                                        $('<input>').attr({'type': 'hidden', 'class' : ' hidProd', 'name': 'prod[]', 'value': value.prodID})
                                        )))));
                  });
                  compute_cart();
              }

            }
        });



  $(document).on('click', '.delBtn', function(){
    var id = $(this).attr('id');
    $.ajax({
        url: "carts/del/"+id,
        method: "POST",
        dataType: "json",
        success:function(data){
          itemCount();
          if(data < 1){
            $('.pcdBtn').attr('style', 'display:none;');
            $('#subShip').text(0.00);
            $('#total').text(0.00);
            $('.cartItems').append(

              $('<li>').attr('class', 'list-group-item').append(
                $('<p>').text('Your Cart is empty!')
                ));
            itemCount();
          }
        }
    });
    $(this).closest('li').remove();
    compute_cart();
  });

$(document).on('click', '.orderBtn', function(){
  let con = $(this).attr('rel');
  var total = $('#total').val();

if(con == 1){
  Swal.fire({
    title: 'Are you sure?',
    text: "",
    type: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#B0AEAE',
    confirmButtonColor: '#d33',
    confirmButtonText: 'Confirm'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "{{ route('placeOrder')}}",
        method: "POST",
        success:function(data){
          itemCount();
        Swal.fire({
          title: 'Success!',
          text: data.success,
          type: 'success'
        }).then((result) => {
          if (result.value) {
            window.location = '/orders';
          }
        });
        }
      });
    }
  });
}else{
  $('#address').focus();
}

});

$(document).on('click', '#butsub', function(e){

    $.ajax({
      url: "{{ route('checkStocks')}}",
      method: "GET",
      success:function(data){
        if(data === 'true'){
          $('#cartForm').submit();
        }else{
          $.each(data, function(k,v) {
            let errormsg = v+" has not enough stocks!"
            toastr.error(errormsg, 'Error!');
          });
        }
      }
    });

});


  $(document).on('change', '.valQty', function(){
  var prodID =  $(this).attr('rel');
  var qty = $(this).val();

  $.ajax({
    url : "{{route('changeQty')}}",
    method: "POST",
    dataType: "json",
    data: {
      prod: prodID,
      qty: qty
    },
    success:function(data){
        compute_cart();
    }
  });


  });


});

function compute_cart(){
  var st = 0;
  $('.valQty').each(function(){
    var i = $(this).val();
    var pr =$(this).attr('id');
    st = st + (pr * i);
  });
  if(st >= 1000){
    $('#subTotal').text(st.toFixed(2));
    $('#subShip').text(0.00);
    $('#total').text(st.toFixed(2));
    $('.ctr').val(st);
  }else{
    pt = st + 50;
    $('#subTotal').text(st.toFixed(2));
    $('#subShip').text(50.00);
    $('#total').text(pt.toFixed(2));
    $('.ctr').val(pt);

  }
}
