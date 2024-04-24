#include <MFRC522.h>
#include <SPI.h>

int pin1Moteur = 7;
int pin2Moteur = 6;
int play = 0;
int ouverture = 1;

const int RED = 0;
const int GREEN = 1;
const int MARQUE = 2;

const int pinRST = 9;
const int pinSDA = 10;
const int LED[] = {4, 8, 2};
bool controlLED[] = {false, false, false};
int clignotement = 0;
long time;
long mt;
long scannageT = 0;
String idBadge;
bool dem = false;
int diss = 10;
MFRC522 rfid(pinSDA, pinRST);

const int trigPin = 1;
const int echoPin = 3;
long duree;
int distance;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  SPI.begin();
  rfid.PCD_Init();
  for (int i=0; i<3; i++)
  {
    pinMode(LED[i], OUTPUT);
    digitalWrite(LED[i], HIGH);
  }
  pinMode(pin1Moteur, OUTPUT);
  pinMode(pin2Moteur, OUTPUT);
  pinMode(5,OUTPUT);
  analogWrite(5, 255);

  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
}

void loop() {
  // put your main code here, to run repeatedly:
  scan();
  transmission();
  moteur();
  clignoteLED();
}

int dis() {
  digitalWrite(trigPin, LOW);
  delayMicroseconds(5);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);

  duree = pulseIn(echoPin, HIGH);
  scannageT = millis();
  distance = duree*0.034/2;
  //Serial.println(distance);
  return distance;
}

void transmission()
{
  if(Serial.available()>0)
  {
    String command = Serial.readStringUntil('\n');
    if(command=="red" && !controlLED[RED])
    {
      controlLED[RED] = true;
      time = millis();
      clignotement = 0;
      digitalWrite(LED[RED], LOW);
    }
    else if(command=="green"|| command=="greenE" && !controlLED[GREEN])
    {
      controlLED[GREEN] = true;
      time = millis();
      clignotement = 0;
      digitalWrite(LED[GREEN], LOW);
      if(command=="green")
      {
        play = 1;
        diss = 10;
        ouverture = 1;
        mt = millis();
      }
    }
  }
}
void clignoteLED()
{
  for (int i=0; i<3; i++)
  {
    if(controlLED[i])
    {
      if(millis()-time>=300)
      {
        bool etat = digitalRead(LED[i]);
        digitalWrite(LED[i], !etat);
        clignotement++;
        time = millis();

        if(clignotement==15)
        {
          controlLED[i] = false;
        }
      }
      
    }
  }
}

void moteur()
{
  if(play==1)
  {
    //AVANCE 5000
    if(millis()-mt<2500 && ouverture==1)
    {
     // Serial.println("avance");
      scannageT = millis();
      digitalWrite(pin1Moteur, HIGH);
      digitalWrite(pin2Moteur, LOW); //Serial.println("avance");
     // analogWrite(5, 10);
     diss = dis();
        Serial.println(diss);
    }
    else
    {
      if(ouverture == 1)
      {
        ouverture = -1;
        mt = millis();
      }
    }
    //PAUSE
    if(ouverture==-1 && diss<20 && diss>0)
    {
      //Serial.println(diss);
      diss = dis();
      Serial.println(diss);
      digitalWrite(pin1Moteur, LOW);
      digitalWrite(pin2Moteur, LOW);
    }
    else
    {
      if(ouverture == -1)
      { 
        ouverture = 0;
        mt = millis();
      }
    }
    //RETOUR 4000
    if(millis()-mt<2500 && ouverture == 0)
    { 
      scannageT = millis();
      diss = 40;
      digitalWrite(pin1Moteur, LOW);
      digitalWrite(pin2Moteur, HIGH);
      //Serial.println("r");
    }
    else 
    {
      if(ouverture==0)
      {
          play = 0;
          Serial.println("ok");
      }
    }

  }
  else 
  {
    digitalWrite(pin1Moteur, LOW);
    digitalWrite(pin2Moteur, LOW);
  }
}

void scan()
{
  //Serial.print(millis()-scannageT);
  //Serial.println(" duree");
  if(millis()-scannageT>5000)
  {
  idBadge = "";
  digitalWrite(LED[MARQUE], LOW);
  if(!dem)
  {
    dem = true;
    Serial.println("pret");
  }
  if(rfid.PICC_IsNewCardPresent())
  {
    if(rfid.PICC_ReadCardSerial())
    {
      for(byte i=0; i<rfid.uid.size; i++)
      {
        idBadge += String(rfid.uid.uidByte[i]);
        delay(100);
      }
      Serial.println(idBadge);
      //delay(2000);
      scannageT = millis();
    }
  }
  }
  else 
  {
    digitalWrite(LED[MARQUE], HIGH);
  }
}