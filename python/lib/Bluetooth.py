from Database import *
import bluetooth


class Bluetooth:
    def scan(self):
        nearby_devices = bluetooth.discover_devices(lookup_names=True)
        devices = []
        for nearby_device in nearby_devices:
            name = nearby_device[1]
            address = nearby_device[0].replace(':', '')
            devices.append([name, address])
        return devices

    def connect(self, device):
        socket = bluetooth.BluetoothSocket(bluetooth.RFCOMM)
        address = ':'.join(str(device)[i:i+2] for i in range(0, 12, 2))
        try:
            socket = socket.connect((address, 1))
            return socket
        except:
            return False

    def command_all(self, command):
        db = Database()
        devices = db.get_btdevices()
        result = []
        for device in devices:
            result.append(self.command(command, device[0]))
        return result

    def command(self, command, address):
        address = ':'.join(str(address)[i:i + 2] for i in range(0, 12, 2))
        socket = self.connect(address)
        if socket is False:
            return [address, 'socket_invalid']
        if socket is None:
            return [address, 'socket_empty']
        socket.send(str(command))
        returndata = []
        while True:
            data = socket.recv(4096)
            returndata.append(data)
            if '$' in data:
                break
        socket.close()
        return [address, ''.join(returndata).replace('$', '').split()]
