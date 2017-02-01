#include <max6675.h>
#include <SoftwareSerial.h>

int thermoDO = 4;
int thermoCS = 5;
int thermoCLK = 6;

int pump = 7;

int lightPin = A0;
int moistPin = A1;

MAX6675 thermocouple(thermoCLK, thermoCS, thermoDO);

void setup() {
  pinMode(13, OUTPUT);
  pinMode(lightPin, INPUT);
  pinMode(moistPin, INPUT);
  pinMode(pump, OUTPUT);

  Serial.begin(9600);
  // wait for MAX chip to stabilize
  delay(500);
}
char a; // stores incoming character from other device
void loop() {
  if (Serial.available())
  {
    a=(Serial.read());
    if (a=='1')
    {
      digitalWrite(13, HIGH);
      Serial.println("200$");
      delay(300);
      digitalWrite(13, LOW);
    }
    if (a=='2')
    {
      digitalWrite(13, HIGH);
      String temp = String(thermocouple.readCelsius());
      String light = String(analogRead(lightPin));
      String moist = String(analogRead(moistPin));
      Serial.println(temp + " " + light + " " + moist + "$");
      digitalWrite(13, LOW);
    }
    if (a=='3')
    {
      digitalWrite(pump, HIGH);
    }
    if (a=='4')
    {
      digitalWrite(pump, LOW);
    }
  }
}