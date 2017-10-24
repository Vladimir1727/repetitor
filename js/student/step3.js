(function($){$(function(){
console.log('step 3 1');
var baseUrl = '../';
var min_sum = $('#min_sum').val();

function get_check(id){//проверка ckeckbox элементов
	var c = $('#'+id);
	if (c.prop('checked')){
		return 1;
	} else {
		return 0;
	}
}

function save_pay(next_form, form_ex){
	$.ajax({
		url: baseUrl+'student/saveExercises',
		type:'post',
		data: $('#pay_form').serialize(),
		success: function(ex_id){
				$(form_ex).val(ex_id);
				$('#main_ex').val(ex_id);
				$(next_form).trigger('submit');
		}
	});
}

$('#pay').click(function(){
	var sum = parseInt($('#sum').val());
	if (!sum){
		sum = 0;
	}
	if (sum < min_sum){
		errdiag('Предупреждение', 'Вносимая сумма должна быть не менее '+min_sum+' $');
		return false;
	} else{
		if (get_check('paypal')){
			$('#paypalAmmount').val(sum);
			save_pay('#paypal_form','#paypal_ex_id');
			return false;
		} else{
			if (get_check('card')){
				$('#paypal_form').append('<input type="hidden" name="landing_page" value="billing">');
				$('#paypalAmmount').val(sum);
				save_pay('#paypal_form','#paypal_ex_id');
			} else{
				$('#yandex_mon').prop( "checked", true );
				$('#yandex_sum').val(sum);
				save_pay('#yandex_form','#yandex_ex_id');
			}
			//$('#yandex_sum').val(sum*59); //активировать позже
			return false;
		}
	}
});

$('#sum').on('keyup', function(event){
	var sum = parseInt($('#sum').val());
	if (!sum){
		sum = 0;
	}
	console.log(sum);
	$('#sum').val(sum);
});


})})(jQuery)
