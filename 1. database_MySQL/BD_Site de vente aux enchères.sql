
# Database creation

DROP DATABASE IF EXISTS Enchères;
CREATE DATABASE Enchères;
USE Enchères;

# Table creation

CREATE TABLE Utilisateur (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  date_adhésion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  nombre_objets INT(11) NOT NULL DEFAULT 0,
  courriel VARCHAR(255) NOT NULL,
  login VARCHAR(100) NOT NULL UNIQUE,
  mot_passe VARCHAR(50) NOT NULL
);


CREATE TABLE Catégorie (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(200) NOT NULL
);


CREATE TABLE Objet_proposé (
  id INT(11) PRIMARY KEY AUTO_INCREMENT, 
  utilisateur_v_id INT(11) NOT NULL, 
  nom VARCHAR(200) NOT NULL, 
  prix_initial DECIMAL(10,2) NOT NULL, 
  début_enchères DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  fin_enchères DATETIME NOT NULL, 
  catégorie_id INT(11) NOT NULL, 
  description VARCHAR(500) NOT NULL, 
  chemin_photo VARCHAR(300) NOT NULL, 
  estVendu BOOLEAN NOT NULL DEFAULT FALSE,

  FOREIGN KEY (utilisateur_v_id) REFERENCES Utilisateur (id),
  FOREIGN KEY (catégorie_id) REFERENCES Catégorie (id)
);


CREATE TABLE Enchères (
  id INT(11) PRIMARY KEY AUTO_INCREMENT, 
  utilisateur_a_id INT(11) NOT NULL, 
  objet_proposé_id INT(11) NOT NULL, 
  prix_proposé DECIMAL(10,2) NOT NULL, 
  changement_prix DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 

  FOREIGN KEY (utilisateur_a_id) REFERENCES Utilisateur (id),
  FOREIGN KEY (objet_proposé_id) REFERENCES Objet_proposé (id)
);


CREATE TABLE Évaluation (
  id INT(11) PRIMARY KEY AUTO_INCREMENT, 
  utilisateur_v_id INT(11) NOT NULL, 
  utilisateur_a_id INT(11) NOT NULL, 
  note INT(11) NOT NULL,
  commentaire VARCHAR(500) DEFAULT NULL,   
  date_évaluation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 

  FOREIGN KEY (utilisateur_v_id) REFERENCES Utilisateur (id),
  FOREIGN KEY (utilisateur_a_id) REFERENCES Utilisateur (id)
);






