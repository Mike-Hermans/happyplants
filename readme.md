# HappyPlants
## Project setup
- Go to ./assets
- Install Gulp globally `npm install -g gulp`
- Run `npm install`
- Run `gulp`

To start the local gulp server, run `gulp watch`

## Executing Python
To execute python on a web server (this is used to send requests via AJAX from the 
Raspberry Pi to the Arduino), you need the following rules in your apacheconfig:
````apacheconfig
<Directory "/var/www/html/python">
        Options +ExecCGI
        SetHandler cgi-script
</Directory>
````

And the Python files must have a permission setting of 755.

There are 2 'main' files for communicating with the Arduino's. get_data.py is the file that connects
wirelessly by fetching id's from the database and sending and reading commands. get_serial_data.py is
used to quickly gather data from an Arduino via USB, and does not use wireless communications.

## Files folder
The files folder does contain any files directly used by the webserver but contains the Python interface
version of HappyPlants, the Bluetooth communication version (instead of NRF) and a backup of the database.
It also includes the .ino files that are used by the Arduino.