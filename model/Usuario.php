<?php
class Usuario{
    private $usuario_id;
    private $nombre;
    private $email;
    private $password;
    private $avatar;
    private $bio;

    //constructor
    public function __construct($usuario_id=null, $nombre, $email, $password,
    $avatar=null, $bio=null){
        $this->usuario_id = $usuario_id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->avatar = $avatar;
        $this->bio = $bio;
    }
    //getters
    public function usuario_id(){
        return $this->usuario_id;
    }               
    public function nombre(){
        return $this->nombre;
    }
    public function email(){
        return $this->email;
    }
    public function password(){
        return $this->password;
    }

    public function avatar(){
        return $this->avatar;
    }
    public function bio(){
        return $this->bio;
    }
    


}