$(document).ready(function() {
  var cid = $('#CategoryID').val();
$.ajax({
          url: "/category="+cid,
          method: "GET",
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          success:function(data){

    $.each(data,function(key, value){
    var cat = value.categoryID;
    var shows = value.prodID;
    var showRef = '/category='+cat+'/show='+shows;
    var srcImg = "{{ URL::to('/') }}/productImg/"+value.thumbnail;

      $('#FilteredProducts').append(
        $('<li>').attr('class', 'spanProd').append(
          $('<a>').attr('href', showRef).append(
            $('<div>').attr('class', 'thumbnail').append(
              $('<div>').attr('class', 'disImgHome').append(
                $('<img>').attr({'src': srcImg, 'class': 'cimg'})
                )).append(
                $('<div>').attr('class', 'caption').append(
                  $('<h5>').text(value.brandName+' - '+value.size))
                ).append(
                $('<div>').attr('class', 'price').append(
                  $('<h5>').text(value.price.toFixed(2)).prepend(
                    $('<span>').text('₱')
                    ))
                ))));
    });

          }
      });



});
