<?php

require_once('Database.php');

class Happyplants
{
    private $db;
    private $current_page;

    public $device;
    public $crops;
    public $devices;

    public function __construct($page = 'index')
    {
        $this->db = new Database();
        $this->current_page = $page;

        if (!isset($_SESSION['user']) && !LOCAL_ENV) {
            if ($this->current_page != 'login') {
                header("Location: /login");
                exit();
            }
        }

        switch ($this->current_page) {
            case 'index':
                $this->get_homepage();
                break;

            case 'detail':
                $this->get_detail_page();
                break;

            case 'login':
                $this->get_login_page();
                break;

            case 'modules':
                $this->get_modules_page();
                break;

            default:
                die('help');
        }
    }

    public function has_devices() {
        return count($this->devices) > 0;
    }

    private function get_homepage() {
        $this->devices = $this->db->get_device();
    }

    private function get_detail_page() {
        $address = $this->get_param('a', '/^(0|1)[0-9]{7}$/');
        if (!$address) {
            header("Location: /");
            exit();
        }
        $this->db->set_address($address);
        if (isset($_POST['submit_name']) || isset($_POST['remove_module'])) {
            if (isset($_POST['submit_name']) && $_POST['name'] != '') {
                $this->db->set_module_name($_POST['name']);
            } else if (isset($_POST['remove_module'])) {
                $this->db->remove_device();
                header("Location: /");
                exit();
            }
        }
        $this->get_single_device();
        $this->crops = $this->db->get_crops();
    }

    private function get_login_page() {
        if (isset($_SESSION['user']) || LOCAL_ENV) {
            header("Location: /");
            exit();
        }
        if (isset($_POST['submit'])) {
            if(isset($_POST['user_name']) && isset($_POST['user_pass'])) {
                if ($user = $this->db->login($_POST['user_name'], $_POST['user_pass'])) {
                    session_start();
                    $_SESSION['user'] = $user['user'];
                    header("Location: /");
                    exit();
                }
            }
        }
    }

    private function get_modules_page() {
        if (isset($_POST['submit'])) {
            if (isset($_POST['address']) && $_POST['address'] != "") {
                $addr = $_POST['address'];
                if (preg_match('/^(0|1)[0-9]{7}$/', $addr)) {
                    if (!$this->db->save_device($addr)) {
                        echo "fout";
                    }
                }
            }
        }
        $this->devices = $this->db->get_device();
    }

    private function get_param($param, $regex) {
        if (isset($_GET[$param])) {
            $p = $_GET[$param];

            if (preg_match($regex, $p)) {
                return $p;
            }
        }
        return false;
    }

    private function get_single_device($required = true) {
        $device = $this->db->get_device();
        if (!$device && $required) {
            header('Location: /');
            exit();
        }
        $this->device = $device;
    }
}