(function($){$(function(){

console.log('repetitor profile 2');
$('#slide').click(function(){
    $('#slide ul').slideToggle();
});

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

})})(jQuery)
