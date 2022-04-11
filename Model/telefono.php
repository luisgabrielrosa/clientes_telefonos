<?php

require_once PROJECT_ROOT_PATH . "/Data/DB.php";

class Telefono extends DB{
    public $ID;
    public $TELEFONO;
    public $CLIENTE_ID;

    public function get(){
        return $this->select("SELECT * FROM `telefono` ORDER BY ID DESC");
    }

    public function save(){
        return $this->insert("INSERT INTO `telefono`(`TELEFONO`, `CLIENTE_ID`) VALUES('$this->TELEFONO', $this->CLIENTE_ID)");
    }

    public function edit(){     
        return $this->update("UPDATE `telefono` SET `TELEFONO`='$this->TELEFONO',`CLIENTE_ID`= $this->CLIENTE_ID WHERE `ID` = $this->ID");        
    }

    public function erase(){     
        return $this->delete("DELETE FROM `telefono` WHERE `ID` = $this->ID");
    }


    
}