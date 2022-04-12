<?php

class ClienteController extends Controller
{

    
    /**
     * "/cliente/lista" Endpoint - Get list of clientes
     */
    public function ListaCliente()
    {
        $respuesta = new Respuesta();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {

            try {
                $cliente = new Cliente(); 
                $clientes = $cliente->get();
                $respuesta->response = json_encode($clientes);
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



    public function NuevoCliente(){
        $respuesta = new Respuesta();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            $request =  $_REQUEST;
            $cliente = new Cliente();
            $cliente->NOMBRE = $request["NOMBRE"];
            $cliente->APELLIDO = $request["APELLIDO"];
            $cliente->EMAIL = $request["EMAIL"];
            if($cliente->ValidateEmpty()){
                return $cliente->save();
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


    public function ActualizaCliente(){
        $respuesta = new Respuesta();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'PUT') {
            $request =  $_REQUEST;
            $cliente = new Cliente();
            $cliente->NOMBRE = $request["NOMBRE"];
            $cliente->APELLIDO = $request["APELLIDO"];
            $cliente->EMAIL = $request["EMAIL"];
            if($cliente->ValidateEmpty()){
                return $cliente->edit();            
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



    public function EliminaCliente(){
        $respuesta = new Respuesta();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            $cliente = new Cliente();
            $cliente->ID = $_REQUEST["id"];
            if(is_numeric($cliente->ID) ){
                return $cliente->erase();
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


