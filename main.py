from lib import *


class Main:
    bt = Bluetooth()
    db = Database()
    connecteddevices = []

    def __init__(self):
        print "HappyPlants main module"
        print "Looking for saved devices"
        devices = self.db.get_btdevices()
        if devices:
            for device in devices:
                print "Connecting to %s (%s)" % (device.name, device.addr)
                device.connect(self.bt.connect(device))
                self.connecteddevices.append(device)
        self.main()

    def main(self):
        print "Options:"
        print "1. Bluetooth"
        print "2. Database"
        print "3. Planters"
        option = raw_input("Select an option: ")

        if (option=="1"):
            self.bluetooth()
        if (option=="2"):
            self.database()
        else:
            self.main()

    def bluetooth(self):
        print "-------------------"
        print "Bluetooth functions"
        print "1. Connect to device"
        print "2. View connected devices"
        print "3. Send command"
        option = raw_input("Select option: ")
        if option == "1":
            print "Scanning for devices..."
            devices = self.bt.scan()
            if len(devices) > 0:
                print "%s devices found, select one to connect" % len(devices)

                i = 0
                for device in devices:
                    i += 1
                    print "[%s] %s" % (i, device.name)
                print "[R] rescan"
                print "[Q] quit"

                option_device = raw_input("Bluetooth device: ")
                if option_device == "r":
                    self.bluetooth()
                elif option_device == "q":
                    return
                btdevice = devices[int(option_device) - 1]

                btdevice.connect(self.bt.connect(btdevice))
                self.connecteddevices.append(btdevice)
            else:
                print "No devices found"

        if option == "2":
            if len(self.connecteddevices) > 0:
                i = 0
                print "%s connected devices:" % len(self.connecteddevices)
                for device in self.connecteddevices:
                    i += 1
                    print "[%s] (%s) %s" % (i, device.addr, device.name)
                print "[Q] quit"
                print "SELECTING A DEVICE WILL DISCONNECT IT"
                option = raw_input("Select an option: ")
                try:
                    if 0 < int(option) <= i:
                        self.connecteddevices[i-1].disconnect()
                        del self.connecteddevices[i-1]
                except:
                    print "Nothing selected"
            else:
                print "There are no devices connected"

        if option == "3":
            if len(self.connecteddevices) > 0:
                command = raw_input("Type a command to send: ")
                for device in self.connecteddevices:
                    print self.bt.command(device.sock, command)
        self.main()

    def database(self):
        print "------------------"
        print "Database functions"
        print "1. Show saved devices"

        option = raw_input("Select option: ")

        if option == "1":
            devices = self.db.get_btdevices()
            if len(devices) > 0:
                i = 0
                print "%s registered devices:" % len(devices)
                for device in devices:
                    i += 1
                    print "[%s] (%s) %s" % (i, device.addr, device.name)
                print "[Q] quit"
                print "SELECTING A DEVICE WILL REMOVE IT"
                option = raw_input("Select an option: ")
                if 0 < int(option) <= i:
                    self.db.remove_btdevice(devices[i-1])
            else:
                print "No devices found"
        self.main()

if __name__ == '__main__':
    Main()
