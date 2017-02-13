<?php

if(mail("matous.kadrnoska@gmail.com","My subject","zprava","From: registrace@zenysobe.cz") == false){
  echo "Failed";
}
