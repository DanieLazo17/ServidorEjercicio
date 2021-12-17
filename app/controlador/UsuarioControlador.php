<?php

    class UsuarioControlador{

        public function ValidarUsuario($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();

            $UsuarioTemporal = new Usuario();
            $UsuarioTemporal->setUsuario($listaDeParametros['usuario']);
            $UsuarioEncontrado = $UsuarioTemporal->obtenerUsuario();

            $UsuarioRegistrado = array("idUsuario"=>null, "usuario"=>null, "token"=>null);

            if(!$UsuarioEncontrado){
                $response->getBody()->write(json_encode($UsuarioRegistrado));
                return $response;
            }

            if($UsuarioEncontrado->compararContrasena($listaDeParametros['contrasena'])){
                $UsuarioEncontrado->generarToken();
                $UsuarioRegistrado = array("idUsuario"=>$UsuarioEncontrado->getIdUsuario(), "usuario"=>$UsuarioEncontrado->getUsuario(), "token"=>$UsuarioEncontrado->getToken());
                $response->getBody()->write(json_encode($UsuarioRegistrado));
            }
            else{
                $response->getBody()->write(json_encode($UsuarioRegistrado));
            }

            return $response->withHeader('Content-Type', 'application/json');
        }

        public function CrearUsuario($request, $response, $args){

            $listaDeParametros = $request->getParsedBody();
            $hashDeContrasena = password_hash($listaDeParametros['contrasena'], PASSWORD_DEFAULT);

            $usuario = new Usuario();
            $usuario->setUsuario($listaDeParametros['usuario']);
            $usuario->setContrasena($hashDeContrasena);
            $nuevoUsuario = array("usuario"=>$usuario->getUsuario());
            $usuario->guardarUsuario();

            $response->getBody()->write( json_encode($nuevoUsuario) );
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

?>