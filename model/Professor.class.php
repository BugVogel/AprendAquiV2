<?php




class Professor {


    private $id;
    private $name;
    private $email;
    private $phone;
    private $especialidade;
    private $password;
    private $address;
    private $description;
    private $path_picture;
    private $first_msg;
    private $isMatch;



  function __construct($id,$name, $email, $phone, $especialidade, $password, $address, $description, $path_picture){


    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->phone = $phone;
    $this->especialidade = $especialidade;
    $this->password = $password;
    $this->address = $address;
    $this->description = $description;
    $this->path_picture = $path_picture;
    
 

    }

    public function getId(){
        return $this->id;
    }


    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getEspecialidade(){
        return $this->especialidade;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getPathPicture(){
        return $this->path_picture;
    }

  
    public function setFirstMessage($msg){

        $this->first_msg = $msg;

    }

    public function getFirstMessage(){
        return $this->first_msg;
    }


    public function setIsMatch($isMatch){

        $this->isMatch = $isMatch;

    }

    public function getIsMatch(){
        return $this->isMatch;
    }





}