<?php

function generateOTP() {
    // Génère un nombre aléatoire à 4 chiffres
    $otp = mt_rand(1000, 9999);

    // Retourne le code OTP
    return $otp;
}

// Exemple d'utilisation
echo $otp = generateOTP();
