<?php
    class USER implements \JsonSerializable{
        private $id;
        private $username;
        private $password;
        private $rol;
        private $validado;

        

        public function __construct($id,$username, $password,$rol,$validado){
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->rol = $rol;
            $this->validado = $validado;
        }

        public function getvalidado(){
            return $this->validado;
        }

        public function setvalidado($validado) {
            $this->validado = $validado;
        }

        public function getId(){
            return $this->id;
        }

        public function getUsername(){
            return $this->username;
        }

        public function getPassword(){ 
            return $this->password;
        }

        public function setID($id){
            $this->id = $id;
        }

        public function setUsername($username){
            $this->username = $username;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function __toString(){
            return $this->username.":".$this->password;
        }

        public function getRol(){
            return $this->rol;
        }

        public function setRol($rol){
            $this->rol = $rol;
        }

        public function toJSON(){
            return json_encode(get_object_vars($this));
        }

        public function jsonSerialize(){
            $var=get_object_vars($this);
            return $var;
        }
        
    }
?>