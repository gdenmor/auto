<?php
    class TEST implements \JsonSerializable{
        private $id;
        private $fechahora;
        private $Intento=[];
        private $User=[];
        private $Preguntas=[];

        public function __construct($id, $fechahora, $Intento, $User, $Preguntas){
            $this->id = $id;
            $this->fechahora = $fechahora;
            $this->Intento = $Intento;
            $this->User=$User;
            $this->Preguntas = $Preguntas;
        }

        public function getIds(){
            return $this->id;
        }

        public function getFechahora(){
            return $this->fechahora;
        }

        public function getIntento(){
            return $this->Intento;
        }

        public function getUser(){
            return $this->User;
        }

        public function __toString(){
            return "".$this->id."".$this->fechahora;
        }

        public function setID($id){
            $this->id = $id;
        }

        public function setFechahora($fechahora){
            $this->fechahora = $fechahora;
        }

        public function setIntento($Intento){
            $this->Intento = $Intento;
        }

        public function setUser($User){
            $this->User = $User;
        }

        public function setPreguntas($Preguntas){
            $this->Preguntas = $Preguntas;
        }

        public function getPreguntas(){
            return $this->Preguntas;
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