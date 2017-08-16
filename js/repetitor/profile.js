(function($){$(function(){

console.log('repetitor profile 8');

/*$('#slide').click(function(){
    $('#slide ul').slideToggle();
});*/

$('#rep-online').click(function(){
    var s = $('#rep-online');
    if (s.hasClass('on')){
        s.removeClass('on');
        s.addClass('off');
    } else {
        s.removeClass('off');
        s.addClass('on');
    }
});

function warp(block){
    $('section.warp aside').each(function(){
        $(this).hide();
    });
    $(block).show();
    $('main.rep-profile section.menu li a').each(function(){
        $(this).removeClass('active');
    });
    $(block+'-but').addClass('active');
}

$('#present-but').click(function(){
    warp('#present');
    return false;
});

$('#personal-but').click(function(){
    warp('#personal');
    return false;
});

$('#subject-but').click(function(){
    warp('#subject');
    return false;
});

$('#pay-but').click(function(){
    warp('#pay');
    return false;
});

})})(jQuery)
