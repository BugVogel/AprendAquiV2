const express = require('express');
const path = require('path');



const app = express();
const server = require('http').createServer(app);
const io = require('socket.io')(server);

app.use(express.static(path.join(__dirname,'public'))); // onde vai estar o front end
app.set('views', path.join(__dirname,'public')); //Onde vai estar as views

app.engine('html',require('ejs').renderFile); //Permite utilizar html para nossas views
app.set('view engine', 'html');



app.use('/', (req, res) =>{ //Quando acessar este caminho a gente vai renderizar a view index.html

    res.render('index.html');
})


var porta = process.env.PORT || 8080;
console.log("Ouvindo em:"+porta);
server.listen(porta); //Ouvir a pota 8080


let messages = [];

io.on('connection', socket =>{ //Quando conectar

    console.log(`socket conectado: ${socket.id}`);

    
    socket.emit('previousMessage', messages);

    socket.on('sendMessage', data =>{
        
        
        messages.push(data);

        socket.broadcast.emit('receivedMessage',data);

    });

})