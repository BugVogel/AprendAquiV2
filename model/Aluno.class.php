<?php


class Aluno {

    private $id;
    private $name;
    private $email;
    private $phone;
    private $cpf;
    private $password;
    private $picture;
    private $first_msg;
    private $isMatch;
    
    
    function __construct( $id, $name, $email, $phone, $cpf, $password, $picture){

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->cpf = $cpf;
        $this->password = $password;
        $this->picture = $picture;


    }


    public function getId(){

        return $this->id;
    }

    public function  getName(){
     
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public  function getPhone(){
        return $this->phone;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function getPassword(){
        return $this->password;
    }


    public function getPicture(){

        if($this->picture === "")
            return "../src/img/perfil.png";

        return $this->picture;
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