import RPi.GPIO as GPIO
from lib import *
import time
import spidev

GPIO.setmode(GPIO.BCM)

pipes = [[0xE8, 0xE8, 0xF0, 0xF0, 0xE1], [0xF0, 0xF0, 0xF0, 0xF0, 0xE1]]

radio = NRF24(GPIO, spidev.SpiDev())
radio.begin(0, 17)

radio.setPayloadSize(32)
radio.setChannel(0x76)
radio.setDataRate(NRF24.BR_1MBPS)
radio.setPALevel(NRF24.PA_MIN)

radio.setAutoAck(True)
radio.enableDynamicPayloads()
radio.enableAckPayload()

radio.openWritingPipe(pipes[0])
radio.openReadingPipe(1, pipes[1])
radio.printDetails()

db = Database()


def manage_data(data):
    if len(data) is not 4:
        print "ERR: invalid length (" + str(len(data)) + ") [" + data + "]"
        return False

    if not db.module_exists(data[0]):
        print "ERR: module " + data[0] + " does not exist"
        return False

    db.save_data(data)

message = list("hp")
while len(message) < 32:
    message.append(0)

while 1:
    start = time.time()
    radio.write(message)
    radio.startListening()

    while not radio.available(0):
        time.sleep(1 / 100)
        if time.time() - start > 10:
            break

    receivedMessage = []
    radio.read(receivedMessage, radio.getDynamicPayloadSize())
    #print("Received: {}".format(receivedMessage))
    string = ""
    for n in receivedMessage:
        # Decode into standard unicode set
        if (n >= 32 and n <= 126):
            string += chr(n)

    manage_data(string.split())

    radio.stopListening()
    time.sleep(1)
