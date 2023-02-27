<?php

require_once("../repository/ProjectRepository.php");

class AbstractController {

    public function render($templateName, $variables) {
        ob_start();
        $vars = $variables;
        require('../templates/'.$templateName.'.php');
        ob_clean();
    }
}

class ProjectController extends AbstractController{
    
    public function __construct (private readonly ProjectRepository $projectRepository) {}

    // private $projectRepository = new ProjectRepository;

    function home() {       
        //Model        
        $requete = $this->projectRepository->getAllProject();
        if (!$requete){
            throw new Exception("Les projets n'ont pas pus etre afficher");
            exit();
        } 

        if (!empty($_GET["deleteId"])){            
            $this->deleteProject($_GET["deleteId"]);

        } else if (!empty($_GET["updateId"])){             
            $this->updateProject($_GET["updateId"]);            
        } 
        // view 
        require("../view/Projects/projectsView.php");  
    }

    function createProject() {
        //View
        require ("../view/Projects/createProjectView.php");
    }

    function uploadImage(){
        $image = new ImageManager;
        $result = $image->uploadImg();
        return $result;   
    }

    function addProject($title,$content,$img) {
        // Model
        if (!empty($_SESSION["id"])){
            $id_user = $_SESSION["id"];
            $result = $this->projectRepository->addProject($title,$content,$id_user,$img);   
            if (!$result){
                throw new Exception("Le projet ne peux pas etre CREER pour le moment si l'erreur persiste, merci de contacter l'administrateur"); 
                exit();         
            } else {
                successMessage("Le projet à bien été créér");
                redirect("index.php?page=home");                
            }   
        }        
       
    }

    function deleteProject ($id) {
        $result = $this->projectRepository->deleteProject($id);    
        if ($result === 0 ){            
            throw new Exception("Le projet ne peux pas etre SUPPRIMER pour le moment si l'erreur persiste, merci de contacter l'administrateur");  
        } else {
            successMessage("Le projet à bien été supprimé");
            redirect("index.php?page=home");  
        }
    }

    function updateProject ($id){ 
        // Model 
        $request = $this->projectRepository->updateProject($id);        
        // View
        require ("../view/Projects/updateProjectView.php");
    }  

    function updateBddProject ($title,$content,$id,$img){
        
        $result = $this->projectRepository->updateProjectBdd($title,$content,$id,$img);
        if ($result ===0){
            throw new Exception("La modification du projet à échouer. Veuiller contacter l'administrateur du site");
        } else {
            successMessage("La modification est effecuté avec suces");
            redirect("index.php?");           
        }     
    }
    }