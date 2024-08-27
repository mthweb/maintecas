<?php

    class cnx {
        // Local cnx
        const host   = "localhost";
        const bd     = "maintecas_bd";
        const user   = "root";
        const pass   = "";

        // Distant cnx
        // const host   = "localhost";
        // const bd     = "australd_test";
        // const user   = "australd_maint";
        // const pass   = "maint&é&é";

        //Création de la méthode 
        public static function getConnexion(){
            try {
                $bdd = new PDO("mysql:host=".self::host.";dbname=".self::bd, self::user, self::pass);
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo 'Oklm connecté';

            } catch (PDOException $e) {
                die("Erreur : ". $e->getMessage() );
            }

            return $bdd;
        }

        public function closeConnection() {
            $bdd = null;
            return $bdd;
        }
    }

    //Afficher le msg
    // cnx::getConnexion();

    // Fermer la connexion
    // cnx::closeConnexion($connection);
?>