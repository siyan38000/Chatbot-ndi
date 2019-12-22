<?php

  

namespace App\Http\Controllers;

  

use BotMan\BotMan\BotMan;

use Illuminate\Http\Request;

use BotMan\BotMan\Messages\Incoming\Answer;

  

class BotManController extends Controller

{

    /**

     * Place your BotMan logic here.

     */

    public function handle()

    {

        $botman = app('botman');

  

        $botman->hears('{message}', function($botman, $message) {

  

            if ((strstr($message, 'medecin') !=false) || (strstr($message, 'médecin') != false)) {
                $this ->medecin($botman);
                
            }
            
            elseif (strstr($message, 'bourse') !=false){
                $botman->reply("Pour constituer votre dossier de bourse, rendez-vous le site du Crous de votre académie");
            }
            elseif (strstr($message,'scolarite') !=false){
                $botman->reply("Pour s'inscrire dans l'enseignement supérieur, vous devez vous inscrire sur le site web de parcoursup : <a href='https://parcoursup.fr'>parcoursup.fr</a>.");
                
            }
            elseif ($message =='chat'){
                $botman->reply("Vous avez demander des chats ? Voici des chats : 😹");
                $json = file_get_contents("https://api.thecatapi.com/v1/images/search");
                var_dump(json_decode($json));
                $url = $parsed_json->{'0'}->{'url'};
                $botman->reply("<img src='$url' width=100 />");
            }
            elseif ((strstr($message, 'aides financières') !=false) || (strstr($message, 'aides financieres')!= false)) {
                $botman ->reply('Afin de vous informer sur les différentes aides finnancières auxquelles vous pourez êtres eligibles, il existe un site :<a href="https://www.fibii.co/" target="_blank" rel="noopener noreferrer">fibii.co</a>');
            }
            elseif (strstr($message, 'crous') !=false)
            {
                $botman->reply('Vous pouvez constituer votre dossier pour acceder aux differentes aides du crous sur <a href="https://www.messervices.etudiant.gouv.fr/envole/" target="_blank" rel="noopener noreferrer">messervices.etudiant.gouv.fr</a>');
            }
            elseif (strstr($message, 'ça va') !=false)
            {
                $botman->reply('Oui, votre assistant est toujours en forme pour vous aider 😃');
            }
            else{

                $botman->reply("Je ne peut pas vous aidez sur ce coup là. Veuillez m'en excuser 😢. Vous pouvez essayer les mot-clés suivant : <br>
                 &bull;medecin : affiche la liste de medecins autour de vous <br>
                 &bull;bourse : Affiche de l'aide par rapport aux bourses étudiantes<br>
                 ");
                 $botman->reply('&bull;aides financières : Affiche de l\'aide sur les différentes aides étudiantes financières disponible en France');

            }

  

        });

  

        $botman->listen();

    }

  

    
    
    

    public function medecin($botman)
    {
        
        $botman->ask("Où recherchez-vous un médecin ?", function(Answer $answer){
            $reply = $answer->getText();
            $this->say('Voici une liste de médecin à proximité de ' .$reply.' <a href="https://www.google.fr/maps/search/m%C3%A9decins+%C3%A0+proximit%C3%A9+de+'.$reply.'/@45.1807993,5.7051322,14z/data=!3m1!4b1" target="_blank">sur Google Maps</a>');

        });
            
    }

}