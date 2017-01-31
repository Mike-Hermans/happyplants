<?php
class Api {
    private $endpoint = false;
    private $address = false;
    private $db = false;

    function __construct() {
        $this->endpoint = $this->param('endpoint');
        $this->address = $this->param('address');

        if (!$this->endpoint && !$this->address)
            $this->abort();

        require_once "Controllers/Database.php";
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
            case "get-data":
                $this->get_data();
                break;
            case "get-markers":
                $this->get_markers();
                break;
            case "set-command":
                $this->set_command();
                break;
            default:
                $this->abort();
        }
    }

    private function get_data() {
        $data = $this->db->get_measurements();
        echo json_encode($data);
    }

    private function change_crop() {
        $crop = $this->param('crop');
        $this->db->set_crop($crop);
        return $this->db->get_crop_nicename($crop);
    }

    private function remove_module() {
        $this->db->remove_device();
    }

    private function get_markers() {
        echo json_encode($this->db->get_markers());
    }

    private function set_command() {
        $command = $this->param('command');
        $this->db->set_module_command($command);
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