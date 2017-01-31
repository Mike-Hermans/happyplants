#!/usr/bin/env python

import serial
import MySQLdb
from time import sleep

addr = '1337B1FCD1A5'

ser = serial.Serial('/dev/ttyACM0', 9600)
sleep(2)
ser.write('2\r')
sleep(2)
read_serial = ser.readline()
data = ''.join(read_serial).replace('$', '').split()

db = MySQLdb.connect(host='localhost', user='root', passwd='root', db='happyplants')
cur = db.cursor()
cur.execute("INSERT INTO sensordata (address, temp, light, moist) VALUES ('%s', '%s', '%s', '%s')" % (addr, data[0], data[1], data[2]))
db.commit()
