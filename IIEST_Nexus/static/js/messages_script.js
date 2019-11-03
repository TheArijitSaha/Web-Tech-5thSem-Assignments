// Helper Functions

// function to create Chat User String
function constructChatUserString(chatUser){
    f= '<li class="person">' +
            '<input type="number" name="chateeid" value="' + chatUser.chateeid + '" hidden>' +
            '<div class="chatUser">' +
                '<img src="' + chatUser.profilepic + '" alt="Error">' +
            '</div>' +
            '<p class="name-time">' +
                '<span class="name">' + chatUser.chateename + '</span>' +
                '<span class="time">' + construct_time_stamp(chatUser.sent_at) + '</span>';
    if(chatUser.seen==0){
        f+=     '<span class="unread">Unread</span>';
    }
    f+=     '</p>' +
        '</li>';
    return f;
}

// Function to create timeStamp
function construct_time_stamp(stamp){
    let t = stamp.split(/[- :]/);
    let d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
    let d_ist = new Date(d.getTime()+(-330)*60*1000);
    let diff=Date.now()-d_ist;
    let agoString;
    if(diff<60000){
        let q=Math.floor((diff)/1000);
        agoString=q+' sec'
        if(q!=1)
            agoString+='s';
        agoString+=' ago'
    }
    else if(diff<60*60000){
        let q=Math.floor((diff)/(60000));
        agoString=q+' min'
        if(q!=1)
            agoString+='s';
        agoString+=' ago'
    }
    else if(diff<24*60*60000){
        let q=Math.floor((diff)/(60*60000));
        agoString=q+' hr'
        if(q!=1)
            agoString+='s';
        agoString+=' ago'
    }
    else if(diff<30*24*60*60000){
        let q=Math.floor((diff)/(24*60*60000));
        agoString=q+' day'
        if(q!=1)
            agoString+='s';
        agoString+=' ago'
    }
    else if(diff<365*24*60*60000){
        let q=Math.floor((diff)/(30*24*60*60000));
        agoString=q+' month'
        if(q!=1)
            agoString+='s';
        agoString+=' ago'
    }
    else{
        agoString=d_ist.toDateString();
    }
    return agoString;
}

// function to create conversation bubble nodes
function construct_message_bubble(message,id){
    if(message.sender==id)  // I am recipient
        f = '<li class="chatLeft">';
    else                        // I am Sender
        f = '<li class="chatRight">';
    f+=         '<div class="chatText">' +
                    message.body +
                '</div>' +
                '<div class="chatTime">' +
                    construct_time_stamp(message.sent_at) +
                '</div>' +
            '</li>';
    return f;
}



$(document).ready(function(){

    //for loading Chat Users
    function showChats(chat_list_json){
        $('.chatUsersList').empty();
        chat_list=JSON.parse(chat_list_json);
        if(chat_list.length===0)
        {
            // If there are no messages
            $('.chatUsersList').append('<li class="person">' +
                                            'You have no messages!' +
                                       '</li>');
        }

        for(x in chat_list){
            chat_node=$(constructChatUserString(chat_list[x]));
            $('.chatUsersList').append(chat_node);
        }
    }
    $.post("async/messages_async.php",{showChatUsers:true}).done(showChats);


    $(document).on('click','.person',function(){
        id=parseInt($(this).children('input[name="chateeid"]').val());
        thisperson=this;
        $.post("async/messages_async.php",{showConversation:id}).done(function(messages_json){
            messages=JSON.parse(messages_json);
            $('.chatBox').empty();
            selectedUserNode = $('<div class="selectedUser">' +
                                    '<span class="name">' + $(thisperson).find('.name').text() + '</span>' +
                               '</div>'
                            );
            chatContainerNode = $('<div class="chatContainer"></div>');
            messageList = $('<ul class="messageList chatContainerScroll"></ul>');

            for(x in messages){
                f = construct_message_bubble(messages[x],id)
                $(messageList).append(f);
            }
            $(chatContainerNode).append(messageList);
            newChatNode = $('<div class="chatForm form-group mt-3 mb-0">' +
                                '<div class="container-fluid">' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<textarea id="messageInput" class="form-control" rows="1" placeholder="Type your message here..."></textarea>' +
                                        '</div>' +
                                        '<div class="col-auto sendBtn btn btn-outline-success">' +
                                            'Send' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>'
                        );
            $(chatContainerNode).append(newChatNode);
            $('.chatBox').append(selectedUserNode);
            $('.chatBox').append(chatContainerNode);
            $(messageList).scrollTop($(messageList).prop('scrollHeight'));
            $('.person').removeClass('activeUser')
            $(thisperson).addClass('activeUser');


            // Make the messages seen in databases
            $.post("async/messages_async.php",{seenConversation:id}).done(function(){
                // Reload Chats
                // could be made faster by just removing unread Node
                $.post("async/messages_async.php",{showChatUsers:true}).done(function(chat_list_json){
                    showChats(chat_list_json);
                    $('input[name="chateeid"][value="'+id+'"]').parent().addClass('activeUser');
                });
            });
        });
    });


    $(document).on('click','.sendBtn',function(){
        msg = $('#messageInput').val();
        if(!(/\S/.test(msg))){
            return;
        }
        toid = parseInt($('.activeUser').find('input[name="chateeid"]').val());
        $.post("async/messages_async.php",{sendMessage:toid,body:msg}).done(function(result_json){
            result=JSON.parse(result_json);
            $('#messageInput').val('');
            messageList=$('.messageList');
            $(messageList).append(construct_message_bubble(result[0]));
            $(messageList).scrollTop($(messageList).prop('scrollHeight'));
        });
    });


});
