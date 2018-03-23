<!DOCTYPE html>

<html lang="en">
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale= 1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="styles.css">
    
    
    <title>Game </title>
    
    
    
</head>
    
<body>
    <div id="app">
              
 
              
        <div id="game"> 
        <h4 id="meLife">Meus pontos de vida:{{ me }}</h4>
        <h4 id="opponentLife">Pontos de vida do oponente:{{ opponent }}</h4>
        <h3 v-if="gameStatus == 1" id="result">Você perdeu!<br><a href="index.php">Restart</a></h3>
        <h3 v-if="gameStatus == 0" id="result">Você venceu!<br><a href="index.php">Restart</a></h3>

        <img src="src/dumbledore_png_by_ourkristen-d5gzuv0.png" id="DumbCalm">
    
        <img src="src/gandalf-807ce48c16b94e5b6cb4ed51c260c42e.png" id="GandCalm">

           
        <button id="attack" class="btn btn-outline-danger" @click.stop.prevent="attack()" v-show="gameStatus != 0 && gameStatus != 1">ATACAR</button>
        <button id="cure" class="btn btn-outline-primary" @click.stop.prevent="cure()" v-show="gameStatus != 0 && gameStatus != 1">CURAR</button>   
        </div> 
        
                    
    
       
       <div v-if="gameStatus == 0 || gameStatus == 1">
                     
            
            <?php
            
        $banco = "ayzac296_game";
                $usuario = "ayzac296";
                $senha = "f5S0iL5f3t";
                $hostname = "localhost";
                $conn = mysql_connect($hostname,$usuario,$senha); mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");
                if (!$conn) {exit;}
                else {}
           
                $data = date('d-m-Y');
                $data .= ' '.date('H:i:s');
                $ganhador = 'Jogador';
            
                         
                $query = "INSERT INTO `infos`(`data`, `vencedor`) VALUES ('$data','$ganhador')";
                $res = mysql_query($query) or die(mysql_error());

                mysql_close(); 
            ?>      
             
        </div>
            
    </div>
    
<!--
    <template id="DangerDumb">
            <img id="DangerDumbI" v-if="" src="src/Albus_Dumbledore_Gambon.png">
        </template>
                
        <template id="DangerGand">
            <img id="DangerGandI" v-if="" src="src/Gandalf.png">
        </template>
    
-->
    
           
    <script type="text/javascript" src="https://unpkg.com/vue"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
    <script type="text/javascript" src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
    

    
    <script>
//        
//            var dangerDumb = Vue.component('dangerDumb',{
//            template: '#DangerDumb',
//            data(){
//   
//            }
//        });
//        
// 
//        
//         var router = new VueRouter({
// 
//            routes: [
//                {path:'/dangerDumb', name: 'dangerDumb', component: dangerDumb},
//             
//            ]
//        });
        
    
        
        var app = new Vue({
            el: "#app",
            
//            router,
            
            data: {
                    me: 100,
                    opponent: 100,
                },
            
            computed:{
                gameStatus(){
                    if(this.me == 0 ){
                        return 1;
                    }
                    
                    else if(this.opponent == 0){
                        return 0 ;
                    }
                    else if(this.opponent == 101 && this.me == 101){
                        return 2;
                    }
                }
            },
            
            methods: {
                attack() {
                    
                    if((this.me > 0) && (this.opponent > 0)){
                        
                        var attack = Math.floor(Math.random() * (11 - 2) + 2);
                        console.log('ataque:', attack);
                        this.opponent = (this.opponent) - (attack);
                        if(this.opponent < 0){
                                this.opponent = 0;
                        }
                        console.log('vida oponente:', this.opponent);

                        var damage = Math.floor(Math.random() * (9 - 1) + 1);
                        console.log('dano:',damage);
                        this.me = (this.me) - (damage);
                        if(this.me < 0){
                                this.me = 0;
                        }
                        console.log('vida eu:', this.me);
                    }
                },
                
                cure(){
                    if(this.me > 0 && this.opponent > 0){
                        
                        var cure = Math.floor(Math.random() * (8 - 3) + 3);
                        console.log('Cura:', cure);
                        this.me = (this.me) + (cure);
                        if(this.me > 100){
                            this.me = 100;
                        }
                        console.log('vida eu:', this.me);
                        
                        var random = Math.floor(Math.random() * (11 - 0) + 0);
                        
                        if(random > 8){
                        
                                var cure = Math.floor(Math.random() * (8 - 3) + 3);
                                this.opponent = (this.opponent) + (cure);
                                if(this.opponent > 100){
                                    this.opponent = 100;
                                }

                        }else{
                                var damage = Math.floor(Math.random() * (9 - 1) + 1);
                                this.me = (this.me) - (damage);
                                if(this.me < 0){
                                        this.me = 0;
                                }
                        }       
                  
                    }
                },
                            
            }
        });
        
    </script>
    
    
    <script>
        
        document.onkeyup=function(e){

            if(e.which == 39){
                console.log('cura');
                app.cure();

            }

            if(e.which == 37){
                console.log('ataque');
                app.attack();
            }
        }
    
    </script>

</body>
</html>