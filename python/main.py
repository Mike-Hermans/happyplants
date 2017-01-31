#!/usr/bin/python
# -*- coding: UTF-8 -*-# enable debugging
import cgi
import cgitb
import json
from lib import *


class Main:
    bt = Bluetooth()
    db = Database()
    connecteddevices = []

    def __init__(self):
        cgitb.enable()
        form = cgi.FieldStorage()
        self.main(form)

    def main(self, form):
        command = form.getvalue('command', 'command_all')
        if command == 'scan':
            devices = self.bt.scan()
            self.output(devices)

        elif command == 'get':
            device = form.getvalue('address', None)
            self.output(self.db.get_modules(device))

        elif command == 'add':
            name = form.getvalue('name', None)
            address = form.getvalue('address', None)
            device = [name, address]
            self.output(self.db.save_btdevice(device))

        elif command == 'command':
            comm = form.getvalue('comm', None)
            address = form.getvalue('address', None)
            self.output(self.db.set_module_command(address, comm))

        elif command == 'command_all':
            comm = form.getvalue('comm', 1)
            self.output(self.bt.command_all(comm))

        elif command == 'remove':
            name = form.getvalue('name', None)
            address = form.getvalue('address', None)
            device = [name, address]
            self.output(self.db.remove_btdevice(device))

        else:
            self.output(['none'])

    def output(self, text):
        print "Content-type: text/json\n"
        print json.dumps(text)


if __name__ == '__main__':
    Main()
