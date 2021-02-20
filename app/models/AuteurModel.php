<?php

use mvc_php_crud\app\libraries\Connection\Connection;
class AuteurModel
{
   private $connexion_db;

   public function __construct()
   {
      $this->connexion_db = new Connection();
   }

   public function getauteurs()
   {
      $this->connexion_db->query('SELECT * FROM auteur');
      return $this->connexion_db->resultSet();
   }

   public function getauteurbyId($auteur)
   {
      $this->connexion_db->query('SELECT * FROM auteur WHERE idauteur = :id');
      $this->connexion_db->bind(":id", $auteur);
      return $this->connexion_db->single();
   }

   public function creer($data)
   {
     $this->connexion_db->query('INSERT INTO auteur (nomauteur, adresse, telephone ) VALUES (:nomauteur, :adresse, :telephone)');
     $this->connexion_db->bind(':nomauteur', $data['nomauteur']);
     $this->connexion_db->bind(':adresse', $data['adresse']);
     $this->connexion_db->bind(':telephone', $data['telephone']);
     $this->connexion_db->execute();
     return TRUE;
   }

   public function edit($data)
   {
       $this->connexion_db->query('UPDATE auteur SET nomauteur = :nomauteur,  adresse = :adresse,  telephone = :telephone  WHERE idauteur = :id');
       $this->connexion_db->bind(':nomauteur', $data['nomauteur']);
       $this->connexion_db->bind(':adresse', $data['adresse']);
       $this->connexion_db->bind(':telephone', $data['telephone']);
       $this->connexion_db->bind(':id', $data['id']);
       $this->connexion_db->execute();

       return TRUE;
   }
   public function delete($auteur)
   {
      $this->connexion_db->query('DELETE FROM auteur WHERE idauteur = :id');
      $this->connexion_db->bind(":id", $auteur);
      $this->connexion_db->execute();
      return TRUE;
   }
}