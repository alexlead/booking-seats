'use strict';
$( document ).ready(function() {
    

    var callendLiVis = 0;
    var pageLi = 0;
    var orderVisible ="";
/* ---------------*/    
$('td.chooseenable').click(function(){
    $.post(
  "/wp-admin/admin-ajax.php",
  {
    action: "alwpgetIntervals",
    selecteddate: $(this).attr('data-ajax')
  },
  function(data){
      $('#allIntevals').html(data);
  }
);
    $('.selected').removeClass('selected');
    $(this).addClass('selected');
    $('span.orderDate').text($(this).attr('data-date'));
    $('span.orderTime').text('');
    $('span.orderSeats').text('');
    $('#order0').val($(this).attr('data-ajax'));
    $('#order1').val('');
    $('#order2').val('');
    
    $('.nextBut:eq(0)').addClass('enStep');
    
 if($(this).attr('data-ajax')==dt||$(this).attr('data-ajax')==dt1){
     $("[for='order[3]'] span").show();
     $('#order3').attr('required','required');
     $("[for='order[4]'] span").hide();
     $('#order4').removeAttr('required');
    }else{
        $("[for='order[4]'] span").show();
        $('#order4').attr('required','required');
        $("[for='order[3]'] span").hide();
        $('#order3').removeAttr('required');
    };
});
    
/* ---------------*/    

$('#calendBefore').click(function(){ 
    $('#bookingcalendar ul li').css('display', 'none');
       if (callendLiVis>0){
            callendLiVis--;
        }
    $('#bookingcalendar ul li').eq(callendLiVis).css('display', 'block');
});
    
$('#calendAfter').click(function(){ 
    $('#bookingcalendar ul li').css('display', 'none');
       if (callendLiVis<2){
            callendLiVis++;
        }
    $('#bookingcalendar ul li').eq(callendLiVis).css('display', 'block');
});
/* ---------------*/    
    $('.nextBut').click(function(){
        if($(this).hasClass("enStep")){
        $('#bookingForm>ul>li').css('display', 'none');
        $('#bookingForm>ul>li').eq($(this).index('.nextBut')+1).css('display', 'block');
        }
    });
    
    $('.prevBut').click(function(){
            $('#bookingForm>ul>li').css('display', 'none');
            $('#bookingForm>ul>li').eq($(this).index('.prevBut')).css('display', 'block');
          });
    
   /* ---------------*/    
    
    $('#contFormSubm').submit(function(){ 
        $.post(
          "/wp-admin/admin-ajax.php",
            "action=alwpsaveBooking&"+$(this).serialize(),
          function(data){
              if (!(data=='ok')){
              alert(data);
              } else {
                    $('#bookingForm>ul>li').css('display', 'none');
                    $('#bookingForm>ul>li').eq(3).css('display', 'block');   
              }
              
      });
    });

});