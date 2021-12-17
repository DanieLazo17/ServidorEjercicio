<?php

    class Usuario{
        
        private $idUsuario;
        private $usuario;
        private $contrasena;
        private $token;

        function __construct(){
            
        }

        function setIdUsuario($idUsuario){
            
            $this->idUsuario = $idUsuario;
        }

        function setUsuario($usuario){
            
            $this->usuario = $usuario;
        }

        function setContrasena($contrasena){
            
            $this->contrasena = $contrasena;
        }

        function setToken($token){
            
            $this->token = $token;
        }

        function getIdUsuario(){
            
            return $this->idUsuario;
        }

        function getUsuario(){
            
            return $this->usuario;
        }

        function getContrasena(){
            
            return $this->contrasena;
        }

        function getToken(){
            
            return $this->token;
        }

        function generarToken(){
            
            $this->token =  md5($this->idUsuario);
        }

        public function compararContrasena($contrasenaIngresada){
            
            return password_verify($contrasenaIngresada, $this->getContrasena());
        }

        public function obtenerUsuario(){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("SELECT idUsuario, usuario, contrasena FROM usuario WHERE usuario = ?");
            $consulta->execute(array($this->usuario));
            $consulta->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
    
            return $consulta->fetch();
        }

        public function guardarUsuario(){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO usuario(usuario, contrasena) VALUES (?,?)");
            $consulta->execute(array($this->usuario, $this->contrasena));
        }
    }

?>