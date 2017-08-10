(function($){$(function(){
console.log('student registration 1');
var baseUrl = '../';
$('#regform').submit(function(){
    var form = $(this).serializeArray();
    var ver = verify2([
        [form[0]['value'], 'email'],
        [form[1]['value'], 'pass']
    ]);
    if (ver == true){
        var form = $(this).serialize();
        $.ajax({
            url: baseUrl+'student/newStudent',
            type:'post',
            data: form,
            success: function(data){
                console.log('data=', data);
                if (data=='0'){
                    console.log('login');
                } else{
                    errdiag('Ошибка', data);
                }
            },
        });

    }
    return false;
});

})})(jQuery)
