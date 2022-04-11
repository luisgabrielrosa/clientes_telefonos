<?php
    class DB{

        private $Conexion = null;

        /**
         * Inicializa la conexion con la base de datos
         */
        public function __construct(){
            try {
                $this->Conexion = new mysqli(HOST, USERNAME, PASSWORD, DATABASE_NAME);
                if(mysqli_connect_errno()){
                    throw new Exception("No se ha podido conectar a la base de datos");
                }
            } catch (Exception $ex) {
                throw new Exception($ex->getMessage());
            }
        }

        /**
         * Ejecuta el query para traer los registros de una tabla en la base de datos
         */
        public function select($query = "" , $params = [])
        {
            try {
                $stmt = $this->executeStatement( $query , $params );
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
                $stmt->close();     
                return $result;
            } catch(Exception $e) {
                throw New Exception( $e->getMessage() );
            }
            return false;
        }

        /**
         * Prepara la consulta. En caso de que hayan paramtros, se agregan.
         */
        private function executeStatement($query = "" , $params = [])
        {
            try {
                $stmt = $this->Conexion->prepare( $query );
     
                if($stmt === false) {
                    throw New Exception("No se ha podido preparar la consulta: " . $query);
                }                
                for ($i=0; $i < count($params); $i++) { 
                    $stmt->bind_param($params[$i], $params[++$i]);
                }
     
                $stmt->execute();
     
                return $stmt;
            } catch(Exception $e) {
                throw New Exception( $e->getMessage() );
            }   
        }


        /**
         * Ejecuta el query para insertar un nuevo registro en la base de datos
         */
        public function insert($query = "")
        {
            try {                
                if($this->Conexion->query($query) == TRUE){
                    echo "Se ha insertado un nuevo registro con éxito";
                }else{
                    echo $this->Conexion->error;
                }               
                $this->Conexion->close();
            } catch(Exception $e) {
                throw New Exception( $e->getMessage() );
            }
            return false;
        }


        /**
         * Ejecuta el query de actualizacion de un registro en la base de datos
         */
        public function update($query = "")
        {
            try {                
                if($this->Conexion->query($query) == TRUE){
                    echo "Se ha actualizado el registro con éxito";
                }else{
                    echo $this->Conexion->error;
                }
               
                $this->Conexion->close();
            } catch(Exception $e) {
                throw New Exception( $e->getMessage() );
            }
            return false;
        }

        /**
         * Ejecuta el query para eliminar un registro en la base de datos
         */
        public function delete($query = "")        {
            try {                
                if($this->Conexion->query($query) == TRUE){
                    echo "Se ha eliminado el registro con éxito";
                }else{
                    echo $this->Conexion->error;
                }
               
                $this->Conexion->close();
            } catch(Exception $e) {
                throw New Exception( $e->getMessage() );
            }
            return false;
        }
    }