<?php

require_once("../model/UsersRepository.php");


class UsersController {

    public function __construct (private readonly UsersRepository $usersRepository) {}
// user  
    function register(){
        require("../view/User/signInView.php");
    }

    function avalaibleLogin($login){
        
        $request= $this->usersRepository->avalaibleLogin($login);             
        if ($request === 0){
            return	true;
        }	        
    }        
    

    function addUser($login,$password,$email,){

        //model       
        $user = $this->usersRepository->addUserBdd($login,$password,$email,);
        if($user){
            successMessage("Votre compte à été créer avec sucèss"); 
            redirect("index.php");                     
        } else {
            throw new Exception("Un probleme est survenue lors de la création de votre compte");
            exit();
        }        
    }


    function connectUser ($login,$password){ 
                
        $request= $this->usersRepository->connectUser($login,$password);
        $res = $request->fetch();
        var_dump($res);
        if (!empty($res["id"])){
            $_SESSION["id"]=$res["id"];            
            //redirect("index.php");
            successMessage("Vous ete connecté");
            redirect("index.php");                
        } else {
            errorMessage ("Le login ou le mot de passe n'est pas valide");
        }
    }

    function connection(){
        require_once("../view/User/connectView.php");
    }

    function logout(){        
        unset($_SESSION["id"]);
        successMessage("Vous etes déconnecté");
        redirect("index.php");    
    }

    function isAdmin(){
        if (!empty($_SESSION["id"])){   
            $user=Checker::getLoginAndRank($_SESSION["id"]);            
            if ($user["rank"] == "admin"){
                return true;
            }
        } else {
            return false;
        }
    }

}