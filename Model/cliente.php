<?php

require_once PROJECT_ROOT_PATH . "/Data/DB.php";

class Cliente extends DB{
    public $ID;
    public $NOMBRE;
    public $APELLIDO;
    public $EMAIL;

    public function get(){
        return $this->select("SELECT * FROM CLIENTE ORDER BY ID DESC");
    }

    public function save(){
        return $this->insert("INSERT INTO `cliente`(`NOMBRE`, `APELLIDO`, `EMAIL`) VALUES('$this->NOMBRE','$this->APELLIDO', '$this->EMAIL')");
    }

    public function edit(){     
        return $this->update("UPDATE `cliente` SET `NOMBRE`='$this->NOMBRE',`APELLIDO`='$this->APELLIDO',`EMAIL`='$this->EMAIL' WHERE `ID` = $this->ID");        
    }

    public function erase(){     
        return $this->delete("DELETE FROM `cliente` WHERE `ID` = $this->ID");        
    }


    public function ValidateEmpty(){
        if($this->NOMBRE == "" || $this->APELLIDO == "" || $this->EMAIL == ""){
            return false;
        }
        return true;
    }

}