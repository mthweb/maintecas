<?php

class usagerModel{
    Private $idusager,$nomusager,$prenomusager,$telephoneusager,$emailusager,$otp, $token;

    public function setidusager($idusager){
        $this->idusager =$idusager;
    }

    public function getidusager(){
        return $this->idusager;
    }

    public function setnomusager($nomusager){
        $this->nomusager =$nomusager;
    }

    public function getnomusager(){
        return $this->nomusager;
    }

    public function setprenomusager($prenomusager){
        $this->prenomusager =$prenomusager;
    }

    public function getprenomusager(){
        return $this->prenomusager;
    }

    public function settelephoneusager($telephoneusager){
        $this->telephoneusager=$telephoneusager;
    }

    public function gettelephoneusager(){
        return $this->telephoneusager;
    }

    public function setemailusager($emailusager){
        $this->emailusager =$emailusager;
    }

    public function getemailusager(){
        return $this->emailusager;
    }

    public function setOtp($otp){
        $this->otp =$otp;
    }

    public function getOtp(){
        return $this->otp;
    }

    public function setToken($token){
        $this->token =$token;
    }

    public function getToken(){
        return $this->token;
    }
}