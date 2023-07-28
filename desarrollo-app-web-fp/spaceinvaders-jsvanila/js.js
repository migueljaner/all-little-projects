/* VARIABLES */
    
    var myGameArea = { //Objeto que añade el canvas y inicia el bucle principal del juego.
        canvas : document.createElement("canvas"),//Generamos el canvas.
        start : function() {
            this.canvas.width = 575;
            this.canvas.height = 615;
            this.context = this.canvas.getContext("2d");
            document.getElementById("pantalla").appendChild(this.canvas);
            musicaboss = new crearSonido("sound/boss.mp3");
            this.interval = setInterval(updateGameArea, 15);//Intervalo principal del juego, este da movimiento a los objetos.
            this.createbon = setInterval(function(){
            var bon = new crearBonificacion(); 
            bonificaciones.push(bon);   
            }, 10*1000);
            window.addEventListener('keydown', function (e) {
                teclas[e.keyCode] = true; //Evento para que al pulsar una tecla se añada a la array de teclas y le de valor true.
            });
            window.addEventListener('keyup', function (e) {
                teclas[e.keyCode] = false; //Evento para que cuando dejemos de soltar una tecla nos ponga el valor en el array en false.         
            });
            },

        clear : function() { //Esta función limpia toda la pantalla.
            this.context.clearRect(0, 0, 1000, 1000);
        },
        stop : function(){ //Para el intervalo principal del juego.
            clearInterval(this.interval);
            clearInterval(this.createbon);
            calcularTopscore();
        }
    }   
    var Enemigos = []; //Array para guardar los Objetos de tipo enemigo.
    var myShots = []; //Array para guardar los objetos de tipo bala.
    var enemyShots = []; //Array para guardar las balas enemigas
    var countshot = 0; //Contador para generar las balas.
    var teclas = []; //Array donde se guardan las teclas que pulsamos para asi poder pulsar mas de una.
    var rondas = 0; //Se utiliza para gestionar las rondas.    
    var bonificaciones = [];
    var jugador = new crearGamer(275, 570, 'img/nave.png', 30, 30);//Se instancia un nuevo jugador.
/*CONSTRUCTORES*/
    /**
 * Instancia un jugador.
 * @param x -Se le da una posicion inicial en el eje x.
 * @param y -Se le da una posicion inicial en el eje y.
 * @param src -Se le pasa la imagen de la nave.
 * @param width -Se le da una anchura.
 * @param height -Se le da una altura.
 */
function crearGamer(x, y, src, width, height) {//Constructor de jugadores.
    this.image = new Image();
    this.image.src = src;
    this.width = width;
    this.height = height;
    this.x = x;
    this.y = y;
    this.doubleshoot = false;
    this.speedX = 0;
    this.vidas = 3;
    ctx = myGameArea.context;
    this.newPos = function() {
        jugador.speedX = 0; //Aqui paramos la nave cuando no pulsamos ninguna tecla.
        
        if(teclas[37]==true){//Para mover la nave a la izquierda al pulsar la flecha izquierda.
             jugador.speedX = -3;
        }
           
        if(teclas[39]==true){//Para mover la nave a la derecha al pulsar la flecha derecha.
            jugador.speedX = 3;
        }
        
        this.x += this.speedX;

        if(this.x <= 3){//Establece el limite izquierdo de la pantalla. 
            this.x = 3;
        }

        if(this.x >=543){//Establece el limite derecho de la pantalla.
            this.x = 543;
        }

        ctx.drawImage(this.image,this.x,this.y,this.width,this.height);//Dibuja la nave en la posicion nueva.

        if(teclas[32]==true){//Dispara cuando pulsamos la tecla space.
            countshot++;
            if(myShots.length == 0 || myShots[myShots.length-1].countshot+35 <= countshot){
                var bala = new crearDisparo(jugador.x+14, jugador.y, 3, 4,countshot);
                myShots.push(bala);
                var sonidodisparo = new crearSonido("sound/disparo.wav");
                sonidodisparo.volume(0.5);
                sonidodisparo.play();
            }
            if(this.doubleshoot==true && (myShots.length == 0 || myShots[myShots.length-1].countshot+18 <= countshot)){
                var bala2 = new crearDisparo(jugador.x+14, jugador.y, 3, 4,countshot);
                myShots.push(bala2);
                var sonidodisparo = new crearSonido("sound/disparo.wav");
                sonidodisparo.volume(0.5);
                sonidodisparo.play();
            }
        } 
        else{
                countshot ++; //Para que puedas disparar spameando la tecla space.
        }
    },
    this.hited = function(){ //Si le dan a la nave.
        var soundhitplayer = new crearSonido("sound/playerhit.wav");
        soundhitplayer.play();
        document.getElementById("vidas").getElementsByTagName("img")[this.vidas-1].style.display="none";
        this.vidas--;
        if(this.vidas == 0){ 
            myGameArea.stop(); //Paramos el mainloop.
            myGameArea.clear(); //Limpiamos todo el canvas.
            var soundfinish = new crearSonido("sound/gameover.mp3");
            soundfinish.play();
            gameOver();
        }
    }    
}
/**
 * Instancia un objeto enemigo.
 * @param x -Se le da una posicion inicial en el eje x.
 * @param y -Se le da una posicion inicial en el eje y.
 * @param src -Se le pasa la imagen de la nave.
 * @param width -Se le da una anchura.
 * @param height -Se le da una altura.
 * @param fqshot -Se introduce la velocidad de disparo de los enemigos.
 * @param vida - La vida que van a tener.
 */
function crearEnemigo(x,y,width,height,src,fqshot,vida){
    this.image = new Image();
    this.image.src = src;
    this.x = x;
    this.y = y;
    this.speedX = 3;
    this.speedY = 2;
    this.width = width;
    this.height = height;
    this.vida = vida;
    this.fqshot= fqshot;
    ctx = myGameArea.context;
    this.update = function(){
        this.x += this.speedX; //Le introducimos la posicion x nueva calculada en newPos();
        this.y += this.speedY;//Le introducimos la posicion y nueva calculada en newPos();
            ctx.drawImage(this.image,this.x,this.y,this.width,this.height);//Pinta la imagen.
    };
    this.newPos = function(){ //Da movimiento a los enemigos
            for(let i = 0; i < Enemigos.length; i++){
                if(this.y >=(190+(rondas*10)) && this.y < 400){ //Aqui definimos hasta donde podran bajar los enemigos en la pantalla.
                    Enemigos[i].speedY = 0;
                }
                if((this.x+this.width)>=550){//Define el borde derecho
                    Enemigos[i].speedX = -2;
                }
                if(this.x<=0){//Define el borde izquierdo
                    Enemigos[i].speedX = 2;
                }
            }
    };
    this.disparo = function(){ //Función que hace disparar aleatoriamente al enemigo.
        var x = Math.floor(Math.random() * this.fqshot);
        if(x == 1){
            var soundshoot = new crearSonido("sound/disparo.mp3");
            soundshoot.volume(0.1);
            var balaenemiga = new crearDisparoEnemigo(this.x+15, this.y+30,3,4);//Instanciamos un objetoj de tipo balaenemiga.
                
            enemyShots.push(balaenemiga);
            if( this.vida < 200 && this.vida>10){
                    var balaenemiga2 = new crearDisparoEnemigo(this.x+this.width,this.y+30,3,4)
                    enemyShots.push(balaenemiga2);
            }
            soundshoot.play();//Reprocucimos el audio.
        }
    }
    this.hited = function(j){ //Si le dan a la nave.
        var soundhit = new crearSonido("sound/hit.mp3");
        soundhit.play();//Reproducimos el audio.
        Enemigos[j].vida = Enemigos[j].vida -10; //Le restamos 10 puntos de vida por cada toque.
        score = document.getElementById("puntuacion").innerHTML = parseInt(document.getElementById("puntuacion").innerHTML) + 10;//Aumenta 10 puntos en el marcador.
        if(Enemigos[j].vida<= 0){ //Aqui comprobamos si el enemigo esta muerto(enemigocomun).
            Enemigos.splice(j,1);
        }
        else{//Si no muere significa que es un bos por lo que le bajara el marcador de vida.
            document.getElementById("hp").style.width = 215 *(Enemigos[j].vida/(100*(rondas/2))) + "px";
        }
    } 
}
/**
 * Instancia una bala enemiga.
 * @param x -Le establecemos un valor en el eje x.
 * @param y -Le establecemos un valor en el eje y.
 * @param width -Le damos el ancho.
 * @param height -Le damos la altura.
 */
function crearDisparoEnemigo(x,y,width,height){
    this.x = x;
    this.y = y;
    this.width = width;
    this.height = height;
    ctx = myGameArea.context;
    this.show = function(){
        ctx.fillStyle = 'red';
        ctx.fillRect(this.x, this.y, this.width, this.height);
    }
    this.move = function(){//Para que la bala baje.
        this.y += 4;
        this.show();
    }
    this.hitplayer = function(bala){ //Comprueba si la bala da al jugador.
        if(bala.x < (jugador.x + jugador.width) && bala.y < (jugador.y + jugador.height)&& bala.x > jugador.x && bala.y > jugador.y){
            return true;
        }
    }
}
/**
 * 
 * @param x -Le establecemos un valor en el eje x.
 * @param y -Le establecemos un valor en el eje y.
 * @param width -Le damos el ancho.
 * @param height -Le damos la altura.
 * @param countshot -Aqui va el contador de las balas para la frequencia de disparo.
 */
function crearDisparo(x,y,width,height,countshot) {
    this.x = x;
    this.y = y;
    this.countshot = countshot;
    this.width = width;
    this.height = height;
    ctx = myGameArea.context;
    this.show = function(){
        ctx.fillStyle = '#13ff00';
        ctx.fillRect(this.x, this.y, this.width, this.height);
    }
    this.move = function(){//Para que la bala suba.
        this.y -= 4;
        this.show();
    }
    this.hitEnemy = function(bala,enemigo){//Comprueba si la bala da a un enemigo.
        if(bala.x < (enemigo.x + enemigo.width) && bala.y < (enemigo.y + enemigo.height)&& bala.x > enemigo.x && bala.y > enemigo.y){
            return true;
        }
    }
}
/**
 * 
 * @param src - Sirve para instanciar sonidos.
 */
function crearSonido(src) {
    this.sound = document.createElement("audio");
    this.sound.src = src;
    this.sound.setAttribute("preload", "auto");
    this.sound.setAttribute("controls", "none");
    this.sound.style.display = "none";
    this.sound.volume;
    document.getElementById("pantalla").appendChild(this.sound);
    this.play = function(){
        this.sound.play();
    }
    this.stop = function(){
        this.sound.pause();
    }
    this.volume = function(value){
        this.sound.volume = value;
    }
}
/**
 * Funcion para crear bonificaciones.
 */
function crearBonificacion(){
    this.image = new Image();
    this.image.src = "img/vida.png";
    this.width = 20;
    this.height = 20;
    this.x;
    this.y= -50;
    var x = Math.floor(Math.random()*535+5);
    this.x = x;
    this.update = function(){
        this.y += 4;
        ctx.drawImage(this.image,this.x,this.y,this.width,this.height);//Pinta la imagen.
    }
    this.clear = function(){
        ctx.clearRect(this.x,this.y,this.width,this.height);//Borra la imagen
    }
    this.hitplayer = function(){ //Comprueba si la bonificacion da al jugador.
        if(this.x < (jugador.x + jugador.width) && this.y < (jugador.y + jugador.height)&& (this.x+this.width) > jugador.x && this.y > jugador.y){
            return true;
        }
    }
}
/*FUNCIONES*/
    /**
     * Cuando se carge la pagina y pulsemos el boton de jugar.
     */
    window.onload = function (){
        document.getElementById("topscore").innerHTML = parseInt(localStorage.getItem("highscore"));
        document.getElementById("binicio").onclick = function(){//Al pulsar el boton start.
            document.getElementById("binicio").style.display = "none";
            document.getElementById("logo").style.opacity = "0.3";
            document.getElementById("score").style.opacity = "1";
            document.getElementById("puntuacion").style.opacity = "1";
            document.getElementById("fondo").style.opacity = "0.2";
            document.getElementById("vidas").style.opacity = "1";
            document.getElementById("rondas").style.opacity="1";
            document.getElementById("ranking").style.opacity = "0";
            document.getElementById("topscore").style.opacity = "0";
            myGameArea.start();//Inicializa el canvas.
        };  
    }
    /**
     * Esta función se llama cuando nos matan al jugador.
     */
    function gameOver() {
        document.getElementById("logo").style.opacity = "1";
        document.getElementById("fondo").style.opacity = "0.7";
        document.getElementById("vidas").style.opacity = "0";
        document.getElementById("gameover").style.opacity = "1";
        document.getElementById("hpboss").style.opacity="0";
        document.getElementById("hp").style.opacity="0";
        document.getElementById("ranking").style.opacity = "1";
        document.getElementById("topscore").style.opacity = "1";
        musicaboss.stop();
    }
    /**
     * Calcula si se ha batido un nuevo record y lo gurada en la localstorage.
     */
    function calcularTopscore(){
        if (!window.localStorage) {
            
            var highscore = localStorage.getItem("highscore");

            if (score > highscore) {
            localStorage.setItem("highscore", score);      
            }
            
        }
        else{
                localStorage.setItem("highscore", score);
            }
        document.getElementById("topscore").innerHTML = parseInt(localStorage.getItem("highscore"));
    }
    /**
     * Funcion principal que mueve todo el juego. Esta se llama una vez cada 15ms.
     */
    function updateGameArea() {
        myGameArea.clear();
        gestionRondas();
        jugador.newPos();
        updateEnemigos();
        moveDisparos();
        comprovarColision();
       updateBonificacion();
        
    }
    function updateBonificacion(){
        if(bonificaciones.length >0){
            for(let i = 0; i < bonificaciones.length; i++){
               bonificaciones[i].update();
                if(bonificaciones[i].hitplayer()){
                    bonificaciones.splice(i,1);
                    if(jugador.vidas<3){
                        var soundbon = new crearSonido("sound/bon.mp3");
                        soundbon.play();
                        document.getElementById("vidas").getElementsByTagName("img")[jugador.vidas].style.display="block";
                        jugador.vidas++;
                    }
                    else{
                        jugador.doubleshoot=true;
                        setTimeout(function(){jugador.doubleshoot=false}, 5000);
                    }
                } 
            }  
        }
    }
/**************************************************************************************************************************** */
/**
 * Esta funcion instancia los enemigos dentro de la array 'Enemigos[]'.
 * Se llama en gestionarRondas() cuando toca ronda de enemigos comunes.
 * @param fqshot -Recibe la velocidad de disparo,en funcion de la ronda, a la que tienen que disparar los enemigos.
 */
function instanciarEnemigos(fqshot){
    musicaboss.stop(); //Paramos el sonido del boss
    var soundentry = new crearSonido("sound/clear.mp3");
    soundentry.volume(0.4);
    soundentry.play();//Reproducimos sonido.
    document.getElementById("hpboss").style.opacity="0"; //La vida del bos se esconde cuando lo matas.
    document.getElementById("hp").style.opacity="0"; //La vida del bos se esconde cuando lo matas.
    myShots.splice(0,myShots.length); //Borramos las balas aliadas del tablero.
    enemyShots.splice(0,enemyShots.length); //Borramos las balas enemigas del tablero.
    for (let i = 0; i < rondas +3 && i < 8; i++) {
        var enemigo = new crearEnemigo(10+i*55,-100,40,40,'img/enemigo.png',fqshot,10);
        Enemigos.push(enemigo);
        for(let j = 0; j< 1; j++){
            var enemigo = new crearEnemigo(10+i*55,-50,40,40,'img/enemigo.png',fqshot,10);
            Enemigos.push(enemigo);
            if(5<rondas){//Para que se añada una fila mas.
                for(let z = 0; z<1; z++){
                    var enemigo = new crearEnemigo(10+i*55,0,40,40,'img/enemigo.png',fqshot,10);
                    Enemigos.push(enemigo);
                    if(10<rondas){//Para que se añada una fila mas.
                        for(let p = 0; p<1; p++){
                            var enemigo = new crearEnemigo(10+i*55,50,40,40,'img/enemigo.png',fqshot,10);
                            Enemigos.push(enemigo);
                            if(15<rondas){//Para que se añada una fila mas.
                                for(let q = 0; q<1; q++){
                                    var enemigo = new crearEnemigo(10+i*55,100,40,40,'img/enemigo.png', fqshot,10);
                                    Enemigos.push(enemigo);
                                }
                            }
                        }
                    }
                }
            }
        }
    }   
}
/**
 * Esta funcion instancia un boss y lo gurada en la array 'Enemigos[]'.
 * Usa el mismo contructor que los enemigos comunes.
 * @param fqshot - Parametro para darle velocidad de disparo.
 * @param vida -Parametro para darle vida al boss.
 */
function instanciarBoss(fqshot,vida){
    myShots.splice(0,myShots.length); //Borramos las balas aliadas del tablero.
    enemyShots.splice(0,enemyShots.length); //Borramos las balas enemigas del tablero.
    var boss = new crearEnemigo(0, -50, 80,80,'img/boss.png',fqshot,vida);
    Enemigos.push(boss);
    document.getElementById("hp").style.width = "215px"; //Le damos 
    document.getElementById("hpboss").style.opacity="1";
    document.getElementById("hp").style.opacity="1";
    musicaboss.volume(0.5);
    musicaboss.play();
}
/**
 * Funcion que calcula la nueva posicion de los enemigos y los pinta en la nueva pos. Se llama en el bucle principal.
 */
function updateEnemigos(){
    for(let i = 0;i < Enemigos.length; i++){
        Enemigos[i].newPos(); //Primero calculamos la nueva posicion de todos los enemigos.
    }
    for (let i = 0; i < Enemigos.length; i++) {
        Enemigos[i].update(); //Pintamos una vez calculada la siguiente posicion.
        Enemigos[i].disparo(); //Disparo de los enemigos.
    }
}
/**
 * Esta funcion hace que se muevan todas las balas.Se llama en el bucle principal.
 */
function moveDisparos(){ 
        for (let i = 0; i < myShots.length; i++) {//Balas aliadas.
                myShots[i].move();
                if(myShots[i].y <=0){
                    myShots.splice(i,1)
                } 
        } 
        for(let i = 0; i < enemyShots.length; i++){//Balas enemigas.
            enemyShots[i].move();
            if(enemyShots[i].y>=615){
                enemyShots.splice(i,1)
            }
        } 
}
/**
 * Esta funcion comprueba si una bala aliada da a un enemigo o viceversa.Se llama en el bucle principal.
 */
function comprovarColision(){ 
    for(let i = 0 ; i <myShots.length ; i++){//Comprueba si damos a un enemigo.
        var colision = false;
        for(let j = 0; j < Enemigos.length; j++){
               if(myShots[i].hitEnemy(myShots[i],Enemigos[j])){//Devuelve true si la bala[i] da al enemigo[j].
                colision = true;
                Enemigos[j].hited(j);
                } 
        }
        if(colision == true){
            myShots.splice(i,1);
        }
    }
    for(let i = 0; i < enemyShots.length; i++){//Comprueba si un enemigo nos da.
        if(enemyShots[i].hitplayer(enemyShots[i])){
                enemyShots.splice(i,1);
                jugador.hited();
        }
    }
}
/**
 * Esta funcion es la que decide si toca la roda de boss.Cada 5 rondas aparecera un bos con 250hp mas respecto al anterior.
 */
function gestionRondas(){
    document.getElementById('ronda').innerHTML = rondas;
    if(Enemigos.length == 0){
        rondas++;
        if(rondas%5 != 0){
            instanciarEnemigos(200-(rondas*5));//Le pasamos por parametro la frequencia de disparo. Cuando mas grande sea el numero menos dispara.
        }
        if(rondas%5 == 0){
            instanciarBoss(9,(100*(rondas/2)));//Le pasamos la frequencia de disparo y la vida del bos.
        }
    }
}
