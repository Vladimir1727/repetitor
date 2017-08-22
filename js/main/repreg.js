(function($){$(function(){
    console.log('repreg 4');
var baseUrl = '../';
$('form.registration').each(function(){
    $(this).submit(function(){
        var form = $(this).serializeArray();
        var ver = verify2([
            [form[0]['value'], 'email'],
            [form[1]['value'], 'pass']
        ]);
        if (ver == true){
            var form = $(this).serialize();
            $.ajax({
                url: baseUrl+'repetitor/newrepetitor',
                type:'post',
                data: form,
                success: function(data){
                    console.log('data=', data);
                    if (data=='0'){
                        document.location = '/index.php/repetitor';
                    } else{
                        errdiag('Ошибка', data);
                    }
                },
            });

        }
        return false;
    });
});

})})(jQuery)
