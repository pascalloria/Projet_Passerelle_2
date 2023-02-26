<?php

    class ImageManager {

        public function uploadImg(){ 
            
            if (isset($_FILES["img"]) && $_FILES["img"]["error"] === 0) {
                // image limité a 3MO
                if ($_FILES["img"]["size"] < 3000000){                   
                    $informationsImage = pathinfo($_FILES["img"]["name"]);
                    $extensionImage = $informationsImage["extension"];
                    $extensionArray = ["png","gif","jpg","jpeg"];

                    if (in_array($extensionImage,$extensionArray)){
                        $img = time().rand().rand().'.'.$extensionImage;
                        move_uploaded_file($_FILES["img"]["tmp_name"],"src/img/".$img);
                        return $img;                            
                    };                
                } else {                                    
                    throw new Exception("La taille de l'image ne dois pas etre supérieur à 3 Mo");
                };            
            } else {
                throw new Exception("Une erreur à eue lieux");
            }             
        }
    }
    