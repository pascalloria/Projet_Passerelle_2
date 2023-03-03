<?php

require_once("../model/AdminRepository.php");

class AdminController {

    public function __construct(private readonly AdminRepository $adminRepository) {

    }


    function getAllUsers () {
        $request = $this->adminRepository->getAllUser();
        if (!$request){
            throw new Exception("La liste des utilisateurs n'a pas pus etre affichée.");
            exit();
        };
        require("../view/User/adminView.php");        
    }

    function promoteAdmin($id){
        $result = $this->adminRepository->changeRank("admin",$id);
        if ($result ===0){
            throw new Exception("Cet utilisateur n'a pas put etre promut au rang d'admin. Veuiller contacter l'administrateur du site");
        } else {
            successMessage("Cet utilisateur à maintenant le rang : admin ");                    
        }     
    }
    function demoteUser($id){
        $result = $this->adminRepository->changeRank("user",$id);
        if ($result ===0){
            throw new Exception("Cet utilisateur n'a pas put etre dégradé au rang de user. Veuiller contacter l'administrateur du site");
        } else {
            successMessage("Cet utilisateur à maintenant le rang : user ");                    
        }  
    }

    function deleteUser($id){
        $result = $this->adminRepository->deleteUser($id);
        if ($result === 0){
            throw new Exception("Cet utilisateur n'a pas put etre supprimer de la base de donnée. Veuiller contacter l'administrateur du site");
        } else {
            successMessage("Cet utilisateur à été supprimés de la base de donnée");                    
        }  
    }

    function eraseUser($id){
        $this->adminRepository->eraseUser($id);
        $result = $this->deleteUser($id);
        if ($result === 0){
            throw new Exception("Une erreur à eue lieu lors de la suppression de cette utilisateur ou de son contenu. Veuiller contacter l'administrateur du site");
        } else {
            successMessage("Cet utilisateur et ses contributions  ont étés supprimés de la base de donnée");                    
        }  
    }



}