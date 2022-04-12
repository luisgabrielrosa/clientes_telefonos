<?php

class TelefonoController extends Controller
{

    
    /**
     * "/telefono/lista" Endpoint - Get list of telefonos
     */
    public function ListaTelefono()
    {
        $respuesta = new Respuesta();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $telefono = new Telefono(); 
                $telefonos = $telefono->get();
                $respuesta->response = json_encode($telefonos);
            } catch (Error $e) {
                $respuesta->mensaje = $e->getMessage().'Something went wrong! Please contact support.';
                $respuesta->cabecera = 'HTTP/1.1 500 Internal Server Error';
            }
        }else {
            $respuesta->mensaje = 'Method not supported';
            $respuesta->cabecera = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        $this->SendResponse($respuesta);
    }


    /**
     * "/telefono/nuevo" Endpoint - insert new telefono
     */
    public function NuevoTelefono(){
        $respuesta = new Respuesta();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            $request =  $_REQUEST;
            $telefono = new Telefono();
            $telefono->TELEFONO = $request["TELEFONO"];
            $telefono->CLIENTE_ID = $request["CLIENTE_ID"];
            if($telefono->ValidateEmpty()){
                return $telefono->save();            
            }else{
                $respuesta->mensaje = 'No se permiten campos vacios';
                $respuesta->cabecera = 'HTTP/1.1 500 Input not suported';    
            }
        }else {
            $respuesta->mensaje = 'Method not supported';
            $respuesta->cabecera = 'HTTP/1.1 422 Unprocessable Entity';
        }
        $this->SendResponse($respuesta);
    }


    public function ActualizaTelefono(){
        $respuesta = new Respuesta();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'PUT') {
            $request =  $_REQUEST;
            $telefono = new Telefono();
            $telefono->TELEFONO = $request["TELEFONO"];
            $telefono->CLIENTE_ID = $request["CLIENTE_ID"];
            if($telefono->ValidateEmpty()){
                return $telefono->edit();
            }else{
                $respuesta->mensaje = 'No se permiten campos vacios';
                $respuesta->cabecera = 'HTTP/1.1 500 Input not suported';    
            }
        }else {
            $respuesta->mensaje = 'Method not supported';
            $respuesta->cabecera = 'HTTP/1.1 422 Unprocessable Entity';
        }
        $this->SendResponse($respuesta);

    }



    public function EliminaTelefono(){
        $respuesta = new Respuesta();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            $telefono = new Telefono();
            $telefono->ID = $_REQUEST["id"];
            if(is_numeric($telefono->ID) ){
                return $telefono->erase();
            }else{
                $respuesta->mensaje = 'Identificador del tipo incorrecto';
                $respuesta->cabecera = 'HTTP/1.1 500 Unprocessable Entity';    
            }
        }else {
            $respuesta->mensaje = 'Method not supported';
            $respuesta->cabecera = 'HTTP/1.1 422 Unprocessable Entity';
        }
        $this->SendResponse($respuesta);

    }

    private function SendResponse(Respuesta $respuesta){
        if (!$respuesta->mensaje) {
            $this->sendOutput(
                $respuesta->response,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $respuesta->mensaje)), 
                array('Content-Type: application/json', $respuesta->cabecera)
            );
        }
    }
}


