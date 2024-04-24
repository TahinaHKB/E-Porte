import processing.serial.*;
import processing.sound.*;

Serial port;
SoundFile alarme;
SoundFile cloche;
int pointBadge = -1;
String[] badgeTeste;
boolean check=false;
int ligneEcrit = 0;
String option = "demarrage";
String msgErreur = "Demarrage du système...";
String msgEnr = "Scannez le nouveau badge à enregistrer";
String msgSup = "Scannez le badge à effacer";
boolean scan = false;
void setup()
{
  //badgeTeste = loadStrings("texte/badgeAutorise.txt");
  size(700, 500);
  port = new Serial(this, Serial.list()[0],9600);
  alarme = new SoundFile(this, "ALRMClok_Reveil electronique (ID 0173)_LS.wav");
  cloche = new SoundFile(this, "2115.wav");
}

void draw()
{
  //badgeTeste = loadStrings("texte/badgeAutorise.txt");
  background(0);
  interfaces();
  scannage();
}

void interfaces()
{
  fill(255, 255, 255);
  textSize(30);
  text("PANNEAU DE CONTROLE", 10, 30);
  textSize(20);
  String temps = String.valueOf(day())+"-"+String.valueOf(month())+"-"+String.valueOf(year())+" "+String.valueOf(hour())+":"+String.valueOf(minute())+":"+String.valueOf(second());
  text(temps, 520, 480);
  int validColor = 36;
  int saveColor = 36;
  int supColor = 36;
  if(option=="validation"|| option=="demarrage") validColor = 255;
  else if(option=="enregistrement") saveColor = 255;
  else supColor = 255;
  //validation
  fill(validColor, 119, 61);
  ellipse(100, 100, 100, 50);
  fill(255, 255, 255);
  text("Validation", 60, 110);
  //enregistrement
  fill(saveColor, 119, 61);
  ellipse(330, 100, 150, 50);
  fill(255, 255, 255);
  text("Enregistrement", 265, 110);
  //Suppression
  fill(supColor, 119, 61);
  ellipse(570, 100, 150, 50);
  fill(255, 255, 255);
  text("suppression", 520, 110);
  
  if(mousePressed==true && dist(mouseX, mouseY, 100, 100)<100 && option!="demarrage")
  {
    option = "validation";
  }
  else if(mousePressed==true && dist(mouseX, mouseY, 330, 100)<100 && option!="demarrage")
  {
    option = "enregistrement";
  }
  else if(mousePressed==true && dist(mouseX, mouseY, 570, 100)<100 && option!="demarrage")
  {
    option = "suppression";  
  }
  
  if(option=="validation" || option=="demarrage")
  {
    if(!check)
    {
      fill(255, 0, 0);
      text(msgErreur, 220, 250);
    }
    else 
    {
      String[] infoDecoupe = split(badgeTeste[pointBadge], "-");
      fill(180, 45, 100);
      text("Bienvenue", 220, 250);  
      fill(158, 153, 249);
      textSize(27);
      text(infoDecoupe[1], 330, 250);
      text("("+infoDecoupe[2]+")", 330, 280);
    } 
  }
  else if(option=="enregistrement")
  {
    fill(255, 255, 255);
    text(msgEnr, 200, 250);
  }
  else if(option=="suppression")
  {
    fill(255, 255, 255);
    text(msgSup, 200, 250);
  }
}

void scannage()
{
  if(port.available()>0 && option=="demarrage")
  {
    String command = port.readStringUntil('\n');
    if(command!=null && trim(command).equals("pret"))
    {
      msgErreur = "Prêt ! ";  
    }
    option = "validation";
    scan = true;
  }
  else if(port.available()>0 && option=="suppression")
  {
    String command = port.readStringUntil('\n');
    String[] tempListe = loadStrings("texte/deleteBadge.txt");
     String[] Liste = new String[tempListe.length+1];
   
     for(int i=0; i<tempListe.length; i++)
     {
       Liste[i] = tempListe[i];  
     }
     if(tempListe.length>0) 
     {
       boolean repetition = false;
       for(int i=0; i<tempListe.length; i++)
       {
         if(trim(command).equals(tempListe[i]))
         {
           repetition = true;  
         }
       }
       if(repetition)
       {
         msgEnr = "Scannez le badge à effacer";
         if(!alarme.isPlaying()) alarme.play();
         port.write("red");
       }
       else 
       {
         Liste[tempListe.length] = trim(command);
         msgEnr = "Attente de la confirmation dans la base de données";
         saveStrings("texte/deleteBadge.txt", Liste);
         if(!cloche.isPlaying()) cloche.play();
         port.write("greenE");
       }
     }
     else 
     {
       Liste[0] = trim(command);
       msgEnr = "Attente de la confirmation dans la base de données";
       saveStrings("texte/deleteBadge.txt", Liste);
       if(!cloche.isPlaying()) cloche.play();
       port.write("greenE");
     }
    
  }
  else if(port.available()>0 && option=="enregistrement")
  {
    String command = port.readStringUntil('\n');
    String[] tempListe = loadStrings("texte/saveBadge.txt");
     String[] Liste = new String[tempListe.length+1];
   
     for(int i=0; i<tempListe.length; i++)
     {
       Liste[i] = tempListe[i];  
     }
     if(tempListe.length>0) 
     {
       boolean repetition = false;
       for(int i=0; i<tempListe.length; i++)
       {
         if(trim(command).equals(tempListe[i]))
         {
           repetition = true;  
         }
       }
       if(repetition)
       {
         msgEnr = "Scannez le nouveau badge à enregistrer";
         if(!alarme.isPlaying()) alarme.play();
         port.write("red");
       }
       else 
       {
         Liste[tempListe.length] = trim(command);
         msgEnr = "Attente de la confirmation dans la base de données";
         saveStrings("texte/saveBadge.txt", Liste);
         if(!cloche.isPlaying()) cloche.play();
         port.write("greenE");
       }
     }
     else 
     {
       Liste[0] = trim(command);
       msgEnr = "Attente de la confirmation dans la base de données";
       saveStrings("texte/saveBadge.txt", Liste);
       if(!cloche.isPlaying()) cloche.play();
       port.write("greenE");
     }
    
  }
  else if(port.available()>5 && option=="validation")
  {
    String command = port.readStringUntil('\n');
    print(command);
    if(command!=null && trim(command).length()>5) {  
    boolean checkB = false;// msgErreur = command;
    badgeTeste = loadStrings("texte/badgeAutorise.txt");
    for(int i=0; i<badgeTeste.length; i++)
    {
      String[] decouperInfo = split(badgeTeste[i],"-");
      if(trim(command).equals(decouperInfo[0]))
      {
        checkB = true;
        pointBadge = i;
        break;
      }
    }
      if(checkB) 
      { if(scan==true){scan = false;}
        port.write("green");
        check = true;
        String[] decouperInfo = split(badgeTeste[pointBadge], "-");
        accepter(decouperInfo[0], "texte/liste.txt");
        if(!cloche.isPlaying()) 
        {
          cloche.play();
        }   
      }
      else 
      {
        
        port.write("red"); 
        accepter(trim(command), "texte/historique.txt");
        check = false;
        msgErreur = "Badge non reconnu";
        if(!alarme.isPlaying()) 
        {
          alarme.play();
        }
        
      } }
   }  
}
void accepter(String info, String chemin)
{
   String[] tempListe = loadStrings(chemin);
     String[] Liste = new String[tempListe.length+1];
   
     for(int i=0; i<tempListe.length; i++)
     {
       Liste[i] = tempListe[i];  
     }
     if(tempListe.length>0) Liste[tempListe.length] = info+"/"+String.valueOf(year())+"-"+String.valueOf(month())+"-"+String.valueOf(day())+" "+String.valueOf(hour())+":"+String.valueOf(minute())+":"+String.valueOf(second());
     else Liste[0] = info+"/"+String.valueOf(year())+"-"+String.valueOf(month())+"-"+String.valueOf(day())+" "+String.valueOf(hour())+":"+String.valueOf(minute())+":"+String.valueOf(second());
     saveStrings(chemin, Liste);
}
