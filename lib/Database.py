from Device import *
import MySQLdb


class Database:
    db = None
    cur = None

    def __init__(self):
        self.db = MySQLdb.connect(host='localhost',
                              user='root',
                              passwd='root',
                              db='happyplants')
        self.cur = self.db.cursor()

    def update(self, table, values):
        print "a"

    def select(self, table, values):
        print 'a'

    def get_btdevices(self, id=None, addr=None):
        if addr is None:
            # return all
            self.cur.execute("SELECT * FROM btdevices")
            rows = self.cur.fetchall()
            devices = []
            if len(rows) > 0:
                for row in rows:
                    devices.append(Device(row[2], row[1]))
                return devices
            else:
                return False
        else:
            self.cur.execute("SELECT * FROM btdevices WHERE address=%s", addr)
            rows = self.cur.fetchall()
            devices = []
            for row in rows:
                return devices.append(Device(row[2], row[1]))

    def save_btdevice(self, device):
        self.cur.execute("SELECT id FROM btdevices WHERE address=%s", device.addr)
        if self.cur.rowcount == 0:
            self.cur.execute("INSERT INTO btdevices(address, nicename) VALUES('%s', '%s')" % (device.addr, device.name))
            self.db.commit()

    def remove_btdevice(self, device):
        self.cur.execute("DELETE FROM btdevices WHERE address=%s", device.addr)
        self.db.commit()
