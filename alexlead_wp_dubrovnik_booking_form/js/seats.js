$('.intEnable').click(function(){
    $('.intSel').removeClass('intSel');
    $(this).addClass('intSel');
    
    $('#order1').val($(this).attr('data-interval'));
    $('#order2').val('');
    
    $('span.orderTime').text($(this).attr('data-name'));
    $('span.orderSeats').text('');
        $('.nextBut:eq(1)').removeClass('enStep');
    
    var k = $(this).attr('data-free-seats');
    $('.seatEnable').removeClass('seatEnable');
    $('.seatsOrder').removeClass('seatsOrder');
    $('.seatsHover').removeClass('seatsHover');
    
    for(var i=0; i<k; i++ ){
    $('.seat').eq(i).addClass('seatEnable');
    }
    
});
    $('.seat').click(function(){
        
        if ($(this).hasClass('seatEnable')){
        
        $('.seatsOrder').removeClass('seatsOrder');
        $('.seatsHover').removeClass('seatsHover');
        
        for(var j=0; j<= $(this).index(); j++){
        $('.seat').eq(j).addClass('seatsOrder');
        }
        var seatQTY = $(this).index()+1;
        $('#order2').val(seatQTY);
        $('span.orderSeats').text(seatQTY);
        
        $('.nextBut:eq(1)').addClass('enStep');    
        }
        });
        
        
    $('.seat').hover(function(){
        
        if ($(this).hasClass('seatEnable')){
        
        for(var j=0; j<= $(this).index(); j++){
        $('.seat').eq(j).addClass('seatsHover');
        }
        
        }
        },
        function(){
            $('.seatsHover').removeClass('seatsHover');
        });


 