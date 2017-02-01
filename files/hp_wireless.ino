#include<SPI.h>
#include<RF24.h>

const String MODEL = "0";
const String ID = "3987654";
const String HP = MODEL + ID;

// CE, CSN pins
RF24 radio(9, 10);
int pump = 7;

void setup(void){
  pinMode(pump, OUTPUT);
  while(!Serial);
  Serial.begin(9600);
  Serial.println("Start");
  radio.begin();
  radio.setPALevel(RF24_PA_MAX);
  radio.setChannel(0x76);
  radio.openWritingPipe(0xF0F0F0F0E1LL);
  const uint64_t pipe = (0xE8E8F0F0E1LL);
  radio.openReadingPipe(1, pipe);

  radio.enableDynamicPayloads();
  radio.powerUp();

  Serial.println("Everything ready");
}

void loop(void){
  radio.startListening();
  char receivedMessage[32] = {0};

  Serial.println("Waiting for radio");
  if (radio.available()) {
    Serial.println("OK");
    radio.read(receivedMessage, sizeof(receivedMessage));
    radio.stopListening();

    String msg(receivedMessage);
    Serial.println(msg);
    String hp = msg.substring(0, 2);
    String model = msg.substring(2, 10);
    char *msglen = msg.c_str();
    Serial.println(strlen(msglen));
    String command = "None";
    if (strlen(msglen) > 10) {
      Serial.println(msg[10]);
      command = msg.substring(10, strlen(msglen));
    }
    Serial.println("HP: " + hp);
    Serial.println("MODEL: " + model);
    Serial.println("COMMAND: " + command);

    if (hp == "hp" && HP == model) {
      Serial.println("Correct device");
      bool commandExecuted = false;

      if (command.substring(0, 1) == "w") {
        Serial.println("Giving water");
        commandExecuted = true;
      }

      String message = HP + " 24.56 341 100";
      if (commandExecuted) {
        message += " 1";
      }
      char *text = message.c_str();
      radio.write(text, strlen(text));

      if (command.substring(0,1) == "w") {
        int value = command.substring(1, strlen(msglen) - 1).toInt();

        digitalWrite(pump, HIGH);
        Serial.print("Waiting for ");
        Serial.print(value);
        Serial.println(" seconds");
        delay(value * 1000);
        digitalWrite(pump, LOW);
      }
    }
  }
  delay(1000);
}