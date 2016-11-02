<?php
class Database {
    private $con;
    private $address;

    public function __construct($address = null) {
        $this->con = mysqli_connect('localhost', 'root', 'root', 'happyplants');
        $this->address = $address;
    }

    public function get_device() {
        $q = "SELECT * FROM modules";
        if ($this->address != null) {
            $q .= " WHERE address='$this->address'";
        }
        $result = mysqli_query($this->con, $q);
        $devices = array();
        while($row = mysqli_fetch_assoc($result)) {
            $device = array(
                'name' => $row['hp_id'],
                'address' => $row['address'],
                'data' => array()
            );

            $device['data'] = $this->get_device_data($row['address']);

            array_push($devices, $device);
        }
        if ($this->address != null) {
            $device = $devices[0];
            return $device;
        }
        return $devices;
    }

    private function get_device_data($address) {
        $q = "SELECT * FROM sensordata WHERE address='$address' ORDER BY `timestamp` DESC";
        if ($this->address == null) {
            $q .= " LIMIT 1";
        }
        $result = mysqli_query($this->con, $q);
        $data = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($data, array(
                'timestamp' => $row['timestamp'],
                'temp' => $row['temp'],
                'light' => $row['light'],
                'moist' => $row['moist']
            ));
        }
        if ($this->address == null) {
            return $data[0];
        }
        return $data;
    }
}