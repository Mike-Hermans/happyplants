<?php

require_once(dirname(__FILE__) . '/config.php');

class Database {
    private $con;
    private $address;

    public function __construct() {
        $this->con = mysqli_connect('localhost', DB_USER, DB_PASS, DB_NAME);
    }

    public function save_device($address) {
        $address = mysqli_real_escape_string($this->con, $address);

        $q = "SELECT * FROM modules WHERE address='$address'";

        $result = mysqli_query($this->con, $q);

        if (mysqli_num_rows($result) != 0) {
            return false;
        }

        $q = "INSERT INTO modules(address, hp_id) VALUES('$address', 'HP Module')";
        $result = mysqli_query($this->con, $q);
        return $result;
    }

    public function remove_device() {
        $address = mysqli_real_escape_string($this->con, $this->address);
        $q = "DELETE FROM modules WHERE address='$address'";
        mysqli_query($this->con, $q);
    }

    public function login($user, $pass) {
        $user = mysqli_real_escape_string($this->con, $user);
        $pass = mysqli_real_escape_string($this->con, $pass);

        $q = "SELECT * FROM users WHERE user='$user' AND password='$pass'";
        $result = mysqli_query($this->con, $q);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user != null) {
                return $user;
            }
        }
        return false;
    }

    public function set_address($address) {
        $this->address = $address;
    }

    public function get_crops() {
        $q = "SELECT * FROM crops";
        $result = mysqli_query($this->con, $q);
        $crops = array();
        if ($result) {
            while($row = mysqli_fetch_assoc($result)) {
                $crops[] = array(
                    'name' => $row['name'],
                    'nicename' => $row['nicename']
                );
            }
        }
        return $crops;
    }

    public function set_module_name($name) {
        $name = mysqli_escape_string($this->con, $name);
        $q = "UPDATE modules SET hp_id='$name' WHERE address=$this->address";
        mysqli_query($this->con, $q);
    }

    public function get_device() {
        $q = "SELECT * FROM modules";
        if ($this->address != null) {
            $q .= " WHERE address='$this->address'";
        }
        $result = mysqli_query($this->con, $q);
        $devices = array();
        if ($result) {
            while($row = mysqli_fetch_assoc($result)) {
                $devices[] = array(
                    'name' => $row['hp_id'],
                    'address' => $row['address'],
                    'data' => $this->get_device_data($row['address']),
                    'crop' => $row['crop'],
                    'crop_nicename' => $row['crop'] == 'none' ? 'Geen groente' : $this->get_crop_nicename($row['crop'])
                );
            }
            if ($this->address != null) {
                $device = $devices[0];
                return $device;
            }
        }
        return $devices;
    }

    public function set_crop($crop) {
        $q = "UPDATE modules SET crop='$crop' WHERE address='$this->address'";
        mysqli_query($this->con, $q);
    }

    public function get_crop_nicename($crop) {
        $q = "SELECT nicename FROM crops WHERE `name`='$crop'";
        $result = mysqli_query($this->con, $q);
        if ($result) {
            $crop = $result->fetch_assoc();
            return $crop['nicename'];
        } else {
            return "";
        }
    }

    public function get_measurements() {
        $q = "SELECT * FROM sensordata WHERE address='$this->address' ORDER BY `timestamp` DESC LIMIT 15";
        $result = mysqli_query($this->con, $q);
        $data = array();
        $data['timestamp'] = array();
        $data['temp'] = array();
        $data['light'] = array();
        $data['moist'] = array();
        if ($result) {
            while($row = mysqli_fetch_assoc($result)) {
                array_unshift($data['timestamp'], date("H:i:s", strtotime($row['timestamp'])));
                array_unshift($data['temp'], $row['temp']);
                array_unshift($data['light'], $row['light'] / 10);
                array_unshift($data['moist'], $row['moist'] / 10);
            }
        } else {
            return "error";
        }
        return $data;
    }

    public function get_markers() {
        $q = "SELECT * FROM locations";
        $result = mysqli_query($this->con, $q);

        $data = array();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = array(
                    'user'      => $row['user'],
                    'lat'       => floatval($row['lat']),
                    'lng'       => floatval($row['lng']),
                    'offer'     => $row['offer'],
                    'request'   => $row['request']
                );
            }
        }
        return $data;
    }

    public function set_module_command($command) {
        $q = "UPDATE modules SET nxt_cmd='$command' WHERE address='$this->address'";
        mysqli_query($this->con, $q);
    }

    private function get_device_data($address) {
        $q = "SELECT * FROM sensordata WHERE address='$address' ORDER BY `timestamp` DESC";
        if ($this->address == null) {
            $q .= " LIMIT 1";
        }
        $result = mysqli_query($this->con, $q);
        $data = array();
        if ($result) {
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = array(
                    'timestamp' => $row['timestamp'],
                    'temp' => $row['temp'],
                    'light' => $row['light'],
                    'moist' => $row['moist']
                );
            }
            if ($this->address == null && !empty($data)) {
                return $data[0];
            }
        }
        return $data;
    }
}