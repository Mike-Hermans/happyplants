#include <max6675.h>
#include <SoftwareSerial.h>

SoftwareSerial BT(1, 0); 

int thermoDO = 4;
int thermoCS = 5;
int thermoCLK = 6;

int lightPin = A0;
int moistPin = A1;

MAX6675 thermocouple(thermoCLK, thermoCS, thermoDO);
  
void setup() {
  pinMode(13, OUTPUT);
  pinMode(lightPin, INPUT);
  pinMode(moistPin, INPUT);
  BT.begin(9600);
  // wait for MAX chip to stabilize
  delay(500);
}
char a; // stores incoming character from other device
void loop() {
  if (BT.available())
  {
    a=(BT.read());
    if (a=='1')
    {
      digitalWrite(13, HIGH);
      BT.println("200$");
      delay(300);
      digitalWrite(13, LOW);
    }
    if (a=='2')
    {
      digitalWrite(13, HIGH);
      String temp = String(thermocouple.readCelsius());
      String light = String(analogRead(lightPin));
      String moist = String(analogRead(moistPin));
      BT.println(temp + " " + light + " " + moist + "$");
      digitalWrite(13, LOW);
    }
  }
}
