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
    function avalaibleEmail($email){
        
        $request= $this->usersRepository->avalaibleEmail($email);             
        if ($request === 0){
            return	true;
        }	        
    }              
    

    function addUser($login,$password,$email,){

        //model      
        // cryptage du password 
        $password = "12452".sha1($password)."24478";
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
        // cryptage du password 
        $password = "12452".sha1($password)."24478";        
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

    function updateEmail($password,$email,$id){
        // cryptage du password 
        $password ="12452".sha1($password)."24478"; 
        // Verification du password
        $request = $this->usersRepository->checkPassword($password,$id)  ;
        $res= $request->fetch();        
        if ($res){          
            // modification de l'email
             $result = $this->usersRepository->updateEmail($email,$id);
            if ($result ===0){
                throw new Exception("La modification de l'adresse email à échouer. Veuiller contacter l'administrateur du site");
            } else {
                successMessage("La modification est effecuté avec succès");                  
            }   
        } else {
            errorMessage("Le mot passe n'est pas valide !");           
        }

       
    }

    function updatePassword($password,$newPassword,$newPassword2,$id){              
        // cryptage du password 
        $password ="12452".sha1($password)."24478"; 
        // Verification du password
        $request = $this->usersRepository->checkPassword($password,$id)  ;
        $res= $request->fetch();        
        if ($res){               
            // verificaiton que les 2 nouveau mdp concorde
            if ($newPassword === $newPassword2){
                // cryptage du password 
                $newPassword = "12452".sha1($newPassword)."24478";
                $result = $this->usersRepository->updatePassword($newPassword,$id);
                if ($result ===0){
                    throw new Exception("La modification du mot de passe à échouer. Veuiller contacter l'administrateur du site");
                } else {
                    successMessage("La modification du mot de passe est effecuté avec succès");
                    redirect("index.php?");        
                } 
            } else {
                errorMessage("Les 2 mots de passe ne sont pas identiques !"); 
            }            
        } else {
            errorMessage("Le mot de passe n'est pas valide !");           
        }  
    }

}