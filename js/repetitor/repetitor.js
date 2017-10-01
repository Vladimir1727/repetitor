(function($){$(function(){
console.log('repetitor 2');

$('#rep-online').click(function(){
	if ($(this).hasClass('off')){
		$(this).removeClass('off');
		$(this).addClass('on');
		setRepetitorStatus(1);
	} else{
		$(this).removeClass('on');
		$(this).addClass('off');
		setRepetitorStatus(0);
	}
});

function setRepetitorStatus(status){
	$.ajax({
	    url: baseUrl+'repetitor/setStatus',
	    type:'post',
		data: 'status=' + status,
	    success: function(data){
			console.log(data);
		}
	});
}

})})(jQuery)
