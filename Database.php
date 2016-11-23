<?php
class Database {
    private $con;
    private $address;

    public function __construct($address = null) {
        $this->con = mysqli_connect('localhost', 'root', 'root', 'happyplants');
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
                    'crop_nicename' => $this->get_crop_nicename($row['crop'])
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