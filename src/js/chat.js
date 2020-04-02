


    var socket = io('http://localhost:8080');
    var idUsuario = $('#idUsuario').val();

        
    

    socket.on('receivedMessage', data => { //Se recebeu mensagem renderiza
       
        if( idUsuario == data.idDestiny){ //Verifica para quem é a mensagem
     
            data2 = { //Gambiarra para inverter ordem do id do usuário no objeto e não precisar mudar o método de renderização
                idAuth: data.idDestiny,
                idDestiny: data.idAuth,
                nameAuth: data.nameAuth,
                nameDestiny: data.nameDestiny,
                message: data.message,
            }

            renderMessage(data2);
        }

     
    })


    socket.on('previousMessage', datas =>{ //Quando conecta recebe todas as mensagens anteriores
        
        for( data of datas){
            
            if( idUsuario == data.idAuth){
            
                renderMessage(data); //Renderiza mensagens anteriores, enviadas e recebidas, na ordem
                
            }
            else if(idUsuario == data.idDestiny ){
                
                data2 = {//Gambiarra para inverter ordem do id do usuário no objeto e não precisar mudar o método de renderização
                    idAuth: data.idDestiny,
                    idDestiny: data.idAuth,
                    nameAuth: data.nameAuth,
                    nameDestiny: data.nameDestiny,
                    message: data.message,
                }
                
                renderMessage(data2);

            }
        }

    })


      $('.chat').submit(function(event){ //Se enviou mensagem
        event.preventDefault(); //Nao da submit
            
            var idAuth = event.target[0].value;
            var idDestiny = event.target[1].value;
            var nameAuth = event.target[2].value;
            var nameDestiny = event.target[3].value;
            var message = event.target[4].value;

            event.target[4].value = "";
            
            
         

            if( message.length){

                var messageObject = {
                    idAuth: idAuth,
                    idDestiny: idDestiny,
                    nameAuth: nameAuth,
                    nameDestiny: nameDestiny,
                    message: message,

                };
               
                renderMessage(messageObject);
                socket.emit('sendMessage', messageObject);
            }
  
    })






function renderMessage(data){ //Atualiza o chat

    $('#messages'+data.idDestiny).append('<div style="color:black" class="message"><strong>'+data.nameAuth+'</strong>:'+data.message+'</div>');
    
}






  