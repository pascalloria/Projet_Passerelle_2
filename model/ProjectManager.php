<?php



class ProjectManager {

    const TABLE_NAME = "projects";
    private int $id;
    private string $title;
    private string $content;
    private string $id_user;
    private string $date;
    private string $img;
    


    public function getId()    {
        return $this->id;
    }

 
    public function setId($id)    {
        $this->id = $id;
        return $this;
    }

    public function getId_user()    {
        return $this->id_user;
    }

    
    public function setId_user($id_user)    {
        $this->id_user = $id_user;
        return $this;
    }

    
    public function getImg()    {
        return $this->img;
    }

    
    public function setImg($img)    {
        $this->img = $img;
        return $this;
    }

   
    public function getContent()    {
        return $this->content;
    }

    public function setContent($content)    {
        $this->content = $content;
        return $this;
    }

   
    public function getTitle()    {
        return $this->title;
    }


    public function setTitle($title)    {
        $this->title = $title;
        return $this;
    }

    public function getDate()    {
        return $this->date;
    }

    public function setDate($date)    {
        $this->date = $date;
        return $this;
    }
}