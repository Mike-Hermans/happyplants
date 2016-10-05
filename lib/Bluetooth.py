from Database import *
import bluetooth

class Bluetooth():
    def __init__(self):
        print "BT started"

    def scan(self):
        nearby_devices = bluetooth.discover_devices(lookup_names=True)
        devices = []
        for nearby_device in nearby_devices:
            devices.append(Device(nearby_device[1], nearby_device[0]))
        return devices

    def connect(self, device):
        socket = bluetooth.BluetoothSocket(bluetooth.RFCOMM)
        device.socket = socket.connect((device.addr, 1))
        db = Database()
        db.save_btdevice(device)
        return device

    def command(self, socket, command):
        socket.send(command)
        returndata = []
        while True:
            data = socket.recv(4096)
            returndata.append(data)
            if '$' in data:
                break
        return  ''.join(returndata).replace('$', '').split()