<?php
class Api {
    private $endpoint = false;
    private $address = false;
    private $db = false;

    function __construct() {
        $this->endpoint = $this->param('endpoint');
        $this->address = $this->param('address');

        if (!$this->endpoint || !$this->address)
            $this->abort();

        require_once "Database.php";
        $this->db = new Database();

        if ($this->address) {
            $this->db->set_address($this->address);
        }

        switch($this->endpoint) {
            case "change-crop":
                $this->change_crop();
                break;
            case "remove-module":
                $this->remove_module();
                break;
            default:
                $this->abort();
        }
    }

    private function change_crop() {
        $crop = $this->param('crop');
        $this->db->set_crop($crop);
        return $this->db->get_crop_nicename($crop);
    }

    private function remove_module() {
        $this->db->remove_device($this->address);
    }

    private function param($p) {
        return isset($_POST[$p]) ? $_POST[$p] : false;
    }

    private function abort() {
        echo "abort";
        exit();
    }
}

new Api();