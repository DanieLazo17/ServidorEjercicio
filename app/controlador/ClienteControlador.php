<?php

    class ClienteControlador{

        public function TraerInfo($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();

            $Usuario = new Usuario();
            $Usuario->setIdUsuario($args["id"]);
            $Usuario->setToken($listaDeParametros['token']);

            if(md5($args["id"]) != $Usuario->getToken()){
                $InfoCliente = array("email"=>null, "nombre"=>null, "apellido"=>null, "dni"=>null);
                $response->getBody()->write(json_encode($InfoCliente));
                return $response->withHeader('Content-Type', 'application/json');
            }

            $Cliente = new Cliente();
            $Cliente->setId($args["id"]);
            $InfoCliente = $Cliente->obtenerInfo();

            $response->getBody()->write(json_encode($InfoCliente));
            return $response->withHeader('Content-Type', 'application/json');
        }

        public function ActualizarEmail($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $id = $args['id'];

            $Cliente = new Cliente();
            $Cliente->setId($id);
            $Cliente->setEmail($listaDeParametros['email']);

            /*
            if(isset($listaDeParametros['email'])){
            }
            */
            
            if($Cliente->actualizarEmail()){
                $respuesta = array('estado' => true, 'mensaje' => 'Cambio realizado correctamente');
            }
            else{
                $respuesta = array('estado' => false, 'mensaje' => 'Cambio no realizado');
            }

            $response->getBody()->write( json_encode($respuesta) );
            return $response;
        }

        public function ActualizarNombre($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $id = $args['id'];

            //Normalizar dato
            $nombre = ucwords($listaDeParametros['nombre']);

            $Cliente = new Cliente();
            $Cliente->setId($id);
            $Cliente->setNombre($nombre);
            
            if($Cliente->actualizarNombre()){
                $respuesta = array('estado' => true, 'mensaje' => 'Cambio realizado correctamente');
            }
            else{
                $respuesta = array('estado' => false, 'mensaje' => 'Cambio no realizado');
            }

            $response->getBody()->write( json_encode($respuesta) );
            return $response;
        }

        public function ActualizarApellido($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $id = $args['id'];

            //Normalizar dato
            $apellido = ucwords($listaDeParametros['apellido']);

            $Cliente = new Cliente();
            $Cliente->setId($id);
            $Cliente->setApellido($apellido);
            
            if($Cliente->actualizarApellido()){
                $respuesta = array('estado' => true, 'mensaje' => 'Cambio realizado correctamente');
            }
            else{
                $respuesta = array('estado' => false, 'mensaje' => 'Cambio no realizado');
            }

            $response->getBody()->write( json_encode($respuesta) );
            return $response;
        }

        public function ActualizarDNI($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $id = $args['id'];

            $Cliente = new Cliente();
            $Cliente->setId($id);
            $Cliente->setDni($listaDeParametros['dni']);
            
            if($Cliente->actualizarDni()){
                $respuesta = array('estado' => true, 'mensaje' => 'Cambio realizado correctamente');
            }
            else{
                $respuesta = array('estado' => false, 'mensaje' => 'Cambio no realizado');
            }

            $response->getBody()->write( json_encode($respuesta) );
            return $response;
        }
    }

?>