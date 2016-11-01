#!/usr/bin/python
# -*- coding: UTF-8 -*-# enable debugging
import cgi
import cgitb
import bluetooth

cgitb.enable()
form = cgi.FieldStorage()

nearby_devices = bluetooth.discover_devices(lookup_names=True)
devices = []
for nearby_device in nearby_devices:
	print "device found"
	device = [nearby_device[0], nearby_device[1]]
	devices.append(device)

print "Content-type: text/json\n"
print json.dumps(devices)
