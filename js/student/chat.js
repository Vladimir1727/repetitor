(function($){$(function(){
console.log('student chat 3');
var student_id = $('#student_id').val();
var student_avatar = $('#student_avatar').val();
var student_name = $('#student_name').val();
var to_role = 0;
var to_id = 0;
var start_id = $('#start_id').val();
var start_role = $('#start_role').val();
if (start_role>0 && start_id>-1){
    to_role = start_role;
    to_id = start_id;
}

function getChat(){
    $.ajax({
        url: baseUrl+'student/getChat',
        type:'post',
        data: 'to_role=' + to_role + '&to_id=' + to_id,
        success: function(data){
            console.log(data);
            var chat = JSON.parse(data);

            list = '';
            var date = '';
            for (var i = chat.chat.length-1; i >= 0; i--) {
                var t = chat.chat[i].created_at.substr(8,2)+ '.' + chat.chat[i].created_at.substr(5,2)+ '.' + chat.chat[i].created_at.substr(0,4);
                if ( t != date){
                    list += '<div class="date">' + t + '</div>';
                    date = t;
                }
                if (chat.chat[i].from_role == 2){
                    list += '<div class="list"><div class="avatar"><img src="../../';
                    if (student_avatar == ''){
                        list += 'img/avatar2.png';
                    }else{
                        var d = student_avatar.search(/\./i);
                        list += 'images/'+student_avatar.substr(0,d)+'_thumb'+student_avatar.substr(d);
                    }
                    list += '" alt="avatar"></div><div class="name"><h3><span class="activity';
                    list +=  ' on';
                    list += '"></span> ';
                    list += student_name
                    list += '</h3><h4>ID ';
                    list += student_id;
                    list += '</h4></div><div class="mess">';
                    list += chat.chat[i].message;
                    list += '</div></div>';
                } else{
                    if (chat.chat[i].from_role == 1){
                        //repetitor message
                        var av = '';
                        console.log('avatar=',chat.info.avatar);
                        if (chat.info.avatar == null){
                            av = 'img/avatar2.png';
                        } else{
                            var d = chat.info.avatar.search(/\./i);
            				av += 'images/'+chat.info.avatar.substr(0,d)+'_thumb'+chat.info.avatar.substr(d);
                        }
                        list += '<div class="list"><div class="avatar"><img src="../../';
                        list += av;
                        list += '" alt="avatar"></div><div class="name"><h3><span class="activity';
                        if (chat.info.online){
                            list += ' on';
                        }
                        list += '"></span> ';
                        list += chat.info.first_name;
                        list += '</h3><h4>ID ';
                        list += chat.info.id;
                        list += '</h4></div><div class="mess">';
                        list += chat.chat[i].message;
                        list += '</div></div>';
                    } else{
                        //admin message
                        list += '<div class="list"><div class="avatar"><img src="../../img/';
                        list += 'avatar_admin.png';
                        list += '" alt="avatar"></div><div class="name"><h3><span class="activity';
                        list += 'on';
                        list += '"></span> ';
                        list += 'Admin';
                        list += '</h3><h4>ID ';
                        list += '0';
                        list += '</h4></div><div class="mess">';
                        list += chat.chat[i].message;
                        list += '</div></div>';
                    }
                }
            }
            $('#chat').html(list);
        }
    });
}

function toTime(s){
    var d = new Date(s.substr(0,4), parseInt(s.substr(5,2))-1, s.substr(8,2), s.substr(11,2), s.substr(14,2), s.substr(17,2));
	return d.getTime();
}


function getChatList() {
    $.ajax({
        url: baseUrl+'student/getChatList',
        type:'post',
        success: function(data){
            console.log('chat_list=',data);
            var Chats = JSON.parse(data);
            var temp = [];
            for (var i = 0; i < Chats.length; i++) {
                for (var j = 0; j < Chats.length; j++) {
                    if (toTime(Chats[i].last_date) > toTime(Chats[j].last_date)){
                        var t = Chats[i];
                        Chats[i] = Chats[j];
                        Chats[j] = t;
                    }
                }
            }
            for (var i = 0; i < Chats.length; i++) {
                if (Chats[i].from_role == 3){
                    temp.push(Chats[i]);
                }
            }
            for (var i = 0; i < Chats.length; i++) {
                if (Chats[i].from_role < 3){
                    temp.push(Chats[i]);
                }
            }
            Chats = temp;
            var list = '';
            var main_list = '';
            var user_list = '';
            var news = 0;
            var temp = [];
            for (var i = 0; i < Chats.length; i++) {
                if (Chats[i].from_role == 3){
                    temp.push(Chats[i]);
                }
            }
            for (var i = 0; i < Chats.length; i++) {
                if (Chats[i].from_role < 3){
                    temp.push(Chats[i]);
                }
            }
            Chats = temp;
            for (var i = 0; i < Chats.length; i++) {
                    list = '';
                    news += parseInt(Chats[i].new);
                    console.log('start_id', start_id);
                    if (Chats[i].from_role == to_role && Chats[i].from_id == to_id){
                        list += '<aside class="active">';
                    } else{
                        list += '<aside>';
                    }
                    list += '<div class="avatar"><img src="../../';
                    if (Chats[i].avatar == null){
                        list += 'img/avatar2.png';
                    }else{
                        if (Chats[i].from_role == 3){
                            list += Chats[i].avatar;
                        } else{
                            var d = Chats[i].avatar.search(/\./i);
                            list += Chats[i].avatar.substr(0,d)+'_thumb'+Chats[i].avatar.substr(d);
                        }
                    }
                    list +=  '" alt="avatar"></div><div class="name"><h3>';
                    if (Chats[i].online){
                        list += '<span class="activity on">';
                    }else{
                        list += '<span class="activity">';
                    }
                    list += '</span> ';
                    list += Chats[i].first_name;
                    if (Chats[i].new>0){
                        list += '<span class="new">' + Chats[i].new + '</span>';
                    }
                    list += '</h3><h4>ID ';
                    list += Chats[i].from_id;
                    list += '</h4></div><div class="date">';
                    list += Chats[i].last_date.substr(8,2)+ '.' + Chats[i].last_date.substr(5,2)+ '.' + Chats[i].last_date.substr(0,4);
                    list += '</div><div class="green"></div>';
                    list += '<input type ="hidden" name="role" value='+Chats[i].from_role+'>';
                    list += '<input type ="hidden" name="id" value='+Chats[i].from_id+'>';
                    list += '</aside>';
                if (Chats[i].from_id == start_id){
                    //user_list += list;
                } else{
                    main_list += list;
                }
            }
            $('#users').html(main_list);
            $('li.mail span').each(function(){
                $(this).remove();
            });
            if (news>0){
                $('li.mail').each(function(){
                    var span = '<span>'+news+'</span>';
                    $(this).append(span);
                });
            }
            //$('#user').html(user_list);
            userClick();
        }
    });
}

function getOneUser() {
    $.ajax({
        url: baseUrl+'student/getOneChatUser',
        type:'post',
        data: 'role='+start_role+'&id='+start_id,
        success: function(data){
            console.log(data);
            var Chats = JSON.parse(data);
            var list = '';
            list = '';
            console.log('start_id', start_id);
            if (start_role == to_role && start_id == to_id){
                list += '<aside class="active">';
            } else{
                list += '<aside>';
            }
            list += '<div class="avatar"><img src="../../';
            if (Chats.avatar == null){
                list += 'img/avatar2.png';
            }else{
                if (start_role == 3){
                    list += Chats.avatar;
                } else{
                    var d = Chats.avatar.search(/\./i);
                    list += Chats.avatar.substr(0,d)+'_thumb'+Chats.avatar.substr(d);
                }
            }
            list +=  '" alt="avatar"></div><div class="name"><h3>';
            if (Chats.online){
                list += '<span class="activity on">';
            }else{
                list += '<span class="activity">';
            }
            list += '</span> ';
            list += Chats.first_name;
            list += '</h3><h4>ID ';
            list += start_id;
            list += '</h4></div><div class="date">';
            if (Chats.last_date != null){
                list += Chats.last_date.substr(8,2)+ '.' + Chats.last_date.substr(5,2)+ '.' + Chats.last_date.substr(0,4);
            } else{
                list += '...';
            }
            list += '</div><div class="green"></div>';
            list += '<input type ="hidden" name="role" value=';
            list += start_role;
            list += '><input type ="hidden" name="id" value='+start_id+'>';
            list += '</aside>';
            $('#user').html(list);
            userClick();
        }
    });
}

function userClick(){
    $('#users aside, #user aside').each(function(){
        $(this).click(function(){
            $('#users aside, #user aside').each(function(){
                $(this).removeClass('active');
            });
            $(this).addClass('active');
            to_id = $(this).find('input[name="id"]').val();
            to_role = $(this).find('input[name="role"]').val();
            getChat();
            $('#plan').prop('href','/index.php/student/step1/'+to_id);
        });
    });
}

$('#send_but').click(function(){
var message = $('#message').val().trim();
if (to_role<1){
    errdiag('Предупреждение','Выберите собеседника');
    return false;
}
if (message.length > 0 && message.length < 1000){
    $('#message').val('');
    var mess = {
        'message' : message,
        'to_role' : to_role,
        'to_id' : to_id,
    };
    $.ajax({
        url: baseUrl+'student/sendChat',
        type:'post',
        data: mess,
        success: function(data){
            getChat();
        }
    });
}else{
    errdiag('Предупреждение','Сообщение должно быть от одного до 1000 символов');
}
return false;
});


setInterval(function(){
    getChatList();
    if (to_role>0){
        getChat();
    }
    if (start_id>-1){
        getOneUser();
    }
}, 500);

$('#plan').click(function(){
    if (to_role!=1){
        return false;
    }
});

})})(jQuery)
