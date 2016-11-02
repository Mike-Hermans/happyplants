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

    def get_btdevices(self, addr = None):
        if addr is None:
            self.cur.execute("SELECT * FROM modules")
            rows = self.cur.fetchall()
            devices = []
            if len(rows) > 0:
                for row in rows:
                    devices.append([row[1], row[2]])
            return devices

        return 'specific device'

    def save_btdevice(self, device):
        self.cur.execute("SELECT id FROM modules WHERE address=%s", device[1])
        if self.cur.rowcount == 0:
            self.cur.execute("INSERT INTO modules(address, hp_id) VALUES('%s', '%s')" % (device[1], device[0]))
            self.db.commit()
            return '1'
        return '2'

    def remove_btdevice(self, device):
        self.cur.execute("DELETE FROM modules WHERE address=%s", device[1])
        self.db.commit()
        return '1'

    def get_planters(self):
        self.cur.execute("SELECT * FROM planters")
        rows = self.cur.fetchall()
        planters = []
        if len(rows) > 0:
            for row in rows:
                planters.append(row)
        return planters

    def get_planterdata(self, planterid):
        self.cur.execute("SELECT * FROM planterdata WHERE planterid=%s", planterid)
        rows = self.cur.fetchall()
        plantdata = []
        if len(rows) > 0:
            for row in rows:
                plantdata.append(row)
        return plantdata