class Device:
    name = None
    addr = None
    sock = None

    def __init__(self, name="", addr=""):
        self.name = name
        self.addr = addr

    def connect(self, socket):
        self.sock = socket

    def disconnect(self):
        self.sock.close()
