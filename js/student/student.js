(function($){$(function(){
console.log('student');

$('#student-online').click(function(){
	if ($(this).hasClass('off')){
		$(this).removeClass('off');
		$(this).addClass('on');
		setStudentStatus(1);
	} else{
		$(this).removeClass('on');
		$(this).addClass('off');
		setStudentStatus(0);
	}
});

function setStudentStatus(status){
	$.ajax({
	    url: baseUrl+'student/setStatus',
	    type:'post',
		data: 'status=' + status,
	    success: function(data){
			console.log(data);
		}
	});
}

})})(jQuery)
