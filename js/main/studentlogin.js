(function($){$(function(){
console.log('student login 1');
var baseUrl = '../';
$('#logform').submit(function(){
    var form = $(this).serializeArray();
    var ver = verify2([
        [form[0]['value'], 'email'],
        [form[1]['value'], 'pass']
    ]);
    if (ver == true){
        var form = $(this).serialize();
        $.ajax({
            url: baseUrl+'student/login',
            type:'post',
            data: form,
            success: function(data){
                console.log('data=', data);
                if (data=='0'){
                    console.log('login');
                    document.location = '/index.php/student';
                } else{
                    errdiag('Ошибка', data);
                }
            },
        });

    }
    return false;
});

})})(jQuery)
