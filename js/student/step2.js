(function($){$(function(){
console.log('step 2');
var baseUrl = '../';
var repetitor_id = $('#repetitor_id').val();
var student_id = $('#student_id').val();

$('.switch').each(function(){
	//$(this).parent().next('div').hide();
	$(this).click(function(){
		if ($(this).hasClass('switch-down')){
			$(this).removeClass('switch-down');
			$(this).addClass('switch-up');
			//$(this).parent().next('div').slideDown();
		} else{
			$(this).removeClass('switch-up');
			$(this).addClass('switch-down');
			//$(this).parent().next('div').slideUp();
		}
	})
});

$('#subject').change(function(){
	$.ajax({
	    url: baseUrl+'student/getRepetitorSpec',
	    type:'post',
		data: 'repetitor_id=' + repetitor_id + '&subject_id=' + $('#subject').val(),
	    success: function(data){
			console.log(data);
	        var spec = JSON.parse(data);
			var list ='';
			for (var i = 0; i < spec.length; i++) {

				list += '<option value='+spec[i]['id']+'>'+spec[i]['specialization']+'</option>';
			}
			$('#specialization').html(list);
	    },
	});
});

$('#step3').click(function(){
	var about = $('#about').val().trim();
	if (about.length>1000){
		errdiag('Предупреждение', 'Описание должно быть не более 1000 знаков');
		return false;
	}
	$('#step_form').trigger('submit');
	// $.ajax({
	//     url: baseUrl+'student/setExercise',
	//     type:'post',
	// 	data: 'repetitor_id=' + repetitor_id+ '&student_id='+ student_id + '&subject_id=' + subject_id + '&specialization_id=' + specialization_id + '&date='+date +'&about='+about,
	//     success: function(ex_id){
	// 		if (ex_id == 0){
	// 			errdiag('Ошибка', 'Запись с датой не найдена');
	// 		} else{
	// 			document.location = '/index.php/student/step3/'+ex_id;
	// 		}
	//     },
	// });
	return false;
})

})})(jQuery)
