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

    def get_modules(self):
        self.cur.execute("SELECT * FROM modules")
        rows = self.cur.fetchall()
        devices = []
        if len(rows) > 0:
            for row in rows:
                devices.append([row[1], row[2], row[5]])
        return devices

    def module_exists(self, addr):
        self.cur.execute("SELECT id FROM modules WHERE address=%s" % addr)
        return self.cur.rowcount

    def save_data(self, data):
        self.cur.execute("INSERT INTO sensordata (address, temp, light, moist) VALUES ('%s', '%s', '%s', '%s')" % (
        data[0], data[1], data[2], data[3]))
        self.db.commit()

    def set_module_command(self, module, command):
        self.cur.execute("UPDATE modules SET nxt_cmd='%s' WHERE address='%s'" % (command, module))
        self.db.commit()
