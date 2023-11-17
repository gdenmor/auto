<?php
    class ExamenUser implements \JsonSerializable{
        private $Examen;
        private $Usuario;
    
        public function __construct($Examen, $Usuario) {
            $this->Examen = $Examen;
            $this->Usuario = $Usuario;
        }
    
        // Getters y setters para las propiedades
    
        public function getExamen() {
            return $this->Examen;
        }
    
        public function getUsuario() {
            return $this->Usuario;
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