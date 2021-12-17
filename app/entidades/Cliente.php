<?php

    class Cliente{
        
        private $id;
        private $email;
        private $nombre;
        private $apellido;
        private $dni;

        function __construct(){
            
        }

        function setId($id){
            
            $this->id = $id;
        }

        function setEmail($email){
            
            $this->email = $email;
        }

        function setNombre($nombre){
            
            $this->nombre = $nombre;
        }

        function setApellido($apellido){
            
            $this->apellido = $apellido;
        }

        function setDni($dni){
            
            $this->dni = $dni;
        }

        function getId(){
            
            return $this->id;
        }

        function getEmail(){
            
            return $this->email;
        }

        function getNombre(){
            
            return $this->nombre;
        }

        function getApellido(){
            
            return $this->apellido;
        }

        function getDni(){
            
            return $this->dni;
        }

        public function obtenerInfo(){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("SELECT email, nombre, apellido, dni FROM cliente WHERE id = ?");
            $consulta->execute(array($this->id));

            return $consulta->fetch(PDO::FETCH_ASSOC);
        }

        public function actualizarEmail(){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("UPDATE cliente SET email = ? WHERE id = ?");
            
            return $consulta->execute(array($this->email, $this->id));
        }

        public function actualizarNombre(){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("UPDATE cliente SET nombre = ? WHERE id = ?");
            
            return $consulta->execute(array($this->nombre, $this->id));
        }

        public function actualizarApellido(){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("UPDATE cliente SET apellido = ? WHERE id = ?");
            
            return $consulta->execute(array($this->apellido, $this->id));
        }

        public function actualizarDni(){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("UPDATE cliente SET dni = ? WHERE id = ?");
            
            return $consulta->execute(array($this->dni, $this->id));
        }
    }

?>