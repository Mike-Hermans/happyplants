from lib import *

class Main():
    btdevice = Device()
    bt = Bluetooth()
    db = Database()
    connecteddevices = []

    def __init__(self):
        print "HappyPlants main module"
        print "Looking for saved devices"
        devices = self.db.get_btdevices()
        for device in devices:
            print "Connecting to %s (%s)" % (device.name, device.addr)
            device.sock = self.bt.connect(device)
            self.connecteddevices.append(device)
        self.main()

    def main(self):
        print "Options:"
        print "1. Bluetooth"
        print "2. Database"
        option = raw_input("Select an option: ")

        if (option == "1"):
            self.bluetooth()
        if (option == "2"):
            self.database()
        else:
            self.main()

    def bluetooth(self):
        print "-------------------"
        print "Bluetooth functions"
        print "1. Connect to device"
        print "2. View connected devices"
        print "3. View registered devices"
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

                option = raw_input("Bluetooth device: ")
                if option == "r":
                    self.bluetooth()
                elif option == "q":
                    return
                self.btdevice = devices[int(option) - 1]

                self.btdevice = self.bt.connect(self.btdevice)
                print 'received socket'
                data = self.bt.command(self.btdevice, '3')
                print data
            else:
                print "No devices found"

        if option == "2":
            if len(self.connecteddevices) > 0:
                i = 0
                print "%s registered devices:" % len(self.connecteddevices)
                for device in self.connecteddevices:
                    i += 1
                    print "[%s] (%s) %s" % (i, device.addr, device.name)
                    print device
                print "[Q] quit"
                print "SELECTING A DEVICE WILL DISCONNECT IT"
                option = raw_input("Select an option: ")
                if 0 < option <= i:
                    print "--Remove device here--"

        if option == "3":
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
                if 0 < option <= i:
                    print "--Remove device here--"
            else:
                print "No devices found"
        self.main()

    def database(self):
        print "------------------"
        print "Database functions"
        print "1. Show saved devices"

        option = raw_input("Select option: ")
        if option == "1":
            self.db.get_btdevices(addr='98:D3:31:FC:31:A4')
        self.main()

if __name__ == '__main__':
    Main()