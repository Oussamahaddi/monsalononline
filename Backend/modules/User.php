<?php

class User {
    private $db;
    public function __construct() {
        // instantiate objet from db
        $this->db = new Database();
    }

    public function registre($data) {
        $this->db->query("INSERT INTO `client`(`first_name`, `last_name`, `phone`, `token`) VALUES (:fname, :lname, :phone, :token)");
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':token', $data['token']);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findByPhone($phone) {
        // send requet that get all client from db  
        $this->db->query("SELECT * FROM client WHERE phone = :phone");
        $this->db->bind(':phone', $phone);
        // affect all row that get from db to the variable
        $row = $this->db->single();
        
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUser($data) {
        // send requet that get all client from db
        $this->db->query("SELECT * FROM client WHERE token = :token");
        $this->db->bind(':token', $data['token']);
        // affect all row that get from db to the variable
        $row = $this->db->single();
        
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllClient() {
        $this->db->query("SELECT * FROM client");
        $row = $this->db->resultSet();
        return $row;
    }

}