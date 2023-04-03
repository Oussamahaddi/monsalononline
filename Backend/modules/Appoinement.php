
<?php

    class Appoinement {
        private $db;
        public function __construct() {
            $this->db = new Database;
        }

        // public function checkAppExist() {
        //     $this->db->query("SELECT * FROM rendez_vous");
        // }

        public function getAllApp() {
            $this->db->query("SELECT * FROM rendez_vous");
            $row = $this->db->resultSet();
            return json_encode($row);
        }

        public function getAppById($id) {
            $this->db->query("SELECT * FROM rendez_vous WHERE id = :id");
            $this->db->bind(':id', $id);

            $row = $this->db->single();
            if ($this->db->rowCount() > 0) {
                return $row;
            } else {
                return false;
            }
        }

        public function setAppoinement($data) {
            $this->db->query("INSERT INTO `rendez_vous`(`id_client`, `date_rendez_vous`, `hour_rendez_vous`) VALUES (:id_client, :date_rdv, :hour_rdv)");
            $this->db->bind(':id_client', $data['id_client']);
            $this->db->bind(':date_rdv', $data['date']);
            $this->db->bind(':hour_rdv', $data['time']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function updatAppoinement($data) {
            $this->db->query("UPDATE `rendez_vous` SET `date_rendez_vous`= :date_rdv,`hour_rendez_vous`= :hour_rdv WHERE id = :id");
            $this->db->bind(':date_rdv', $data['date']);
            $this->db->bind(':hour_rdv', $data['time']);
            $this->db->bind(':id', $data['id']);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteAppoinement($id) {
            $this->db->query("DELETE FROM `rendez_vous` WHERE id_client = :id");
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }


        public function getAppByUser($id) {
            $this->db->query("SELECT * FROM `rendez_vous` WHERE id_client = :id");
            $this->db->bind(':id', $id);
            $row = $this->db->single();
            if ($this->db->rowCount() > 0) {
                return $row;
            } else {
                return false;
            }
        }
    }