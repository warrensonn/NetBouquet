-- Script de restauration de l'application "NetBouquet"

-- Administration de la base de données
CREATE DATABASE IF NOT EXISTS lafleur ;
GRANT ALL PRIVILEGES ON `lafleur`.* TO lafleur@localhost;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
USE lafleur ;



-- Création de la structure de la base de données

# -----------------------------------------------------------------------------
#       TABLE : Produit
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Produit
 (
  id INT (3) auto_increment NOT NULL,
  description CHAR(50), 
  prix DECIMAL (10,2) NOT NULL,
  image CHAR (50) NULL, 
  idCategorie CHAR (32) NOT NULL , 
  PRIMARY KEY (id) 
 ) 
 ENGINE=InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE Produit
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_Produit_CATEGORIE
     ON Produit (idCategorie ASC);


# -----------------------------------------------------------------------------
#       TABLE : Commande
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Commande
 (
   id INT AUTO_INCREMENT NOT NULL,
   dateCommande DATE NULL,
   idCompte INT NOT NULL,
   prix INT NOT NULL,
   PRIMARY KEY (id) 
 ) 
 ENGINE=InnoDB;


# -----------------------------------------------------------------------------
#       TABLE : Categorie
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Categorie
 (
   id CHAR (3) NOT NULL,
   libelle CHAR (32) NULL, 
   PRIMARY KEY (id) 
 ) 
 ENGINE=InnoDB;


# -----------------------------------------------------------------------------
#       TABLE : Contenir
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Contenir
 (
	idCommande INT NOT NULL ,
  idProduit INT (3) NOT NULL, 
  quantité INT (2) NOT NULL,
  PRIMARY KEY (idCommande, idProduit) 
 ) 
 ENGINE=InnoDB;


# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE Contenir
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_CONTENIR_COMMANDE
    ON Contenir (idCommande ASC);

CREATE INDEX I_FK_CONTENIR_PRODUIT
    ON Contenir (idProduit ASC);


# -----------------------------------------------------------------------------
#       TABLE : TypeUtilisateur
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TypeUtilisateur
 (
	 id INT (1) NOT NULL,
   libelle CHAR (20) NOT NULL, 
   PRIMARY KEY (id) 
 )
 ENGINE=InnoDB; 



# -----------------------------------------------------------------------------
#       TABLE : Compte 
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Compte
 (
  id INT (10) AUTO_INCREMENT NOT NULL,
  raisonSociale CHAR (50) NOT NULL,
  login CHAR (20) UNIQUE NOT NULL,
  mdp CHAR (255) NOT NULL,
  adresse CHAR (32) NOT NULL,
  cp CHAR (5) NOT NULL,
  ville CHAR (32) NOT NULL,
	mail CHAR(50) NOT NULL,
  idTypeUtilisateur INT (1) NOT NULL DEFAULT 2,
  PRIMARY KEY(id)
 )
 ENGINE=InnoDB;


# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE Contenir
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_COMPTE_TYPEUTILISATEUR
    ON Compte (idTypeUtilisateur ASC);
	


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE Produit 
  ADD FOREIGN KEY FK_PRODUIT_CATEGORIE (idCategorie)
      REFERENCES Categorie (id) ;

ALTER TABLE Commande 
  ADD FOREIGN KEY FK_COMMANDE_COMPTE (idcompte)
      REFERENCES Compte (id) ;

ALTER TABLE Contenir 
  ADD FOREIGN KEY FK_CONTENIR_COMMANDE (idCommande)
      REFERENCES Commande (id) ;

ALTER TABLE Contenir 
  ADD FOREIGN KEY FK_CONTENIR_PRODUIT2 (idProduit)
      REFERENCES Produit (id) ;

ALTER TABLE Compte
  ADD FOREIGN KEY FK_COMPTE_TYPEUTILISATEUR (idTypeUtilisateur)
      REFERENCES TypeUtilisateur (id) ;




# -----------------------------------------------------------------------------
#       CREATION DES LIGNES DES TABLES
# -----------------------------------------------------------------------------

INSERT INTO Categorie VALUES ('fle', 'Fleurs');
INSERT INTO Categorie VALUES ('pla', 'Plantes');
INSERT INTO Categorie VALUES ('com', 'Composition');

INSERT INTO TypeUtilisateur VALUES (1, 'administrateur');
INSERT INTO TypeUtilisateur VALUES (2, 'client');

INSERT INTO Produit VALUES (1, 'Bouquet de roses multicolores' , 58, 'images/fleurs/comores.gif', 'fle');
INSERT INTO Produit VALUES (2, 'Bouquet de roses rouges', 50, 'images/fleurs/grenadines.gif', 'fle');
INSERT INTO Produit VALUES (3, 'Bouquet de roses jaunes', 78, 'images/fleurs/mariejaune.gif', 'fle');
INSERT INTO Produit VALUES (4, 'Bouquet de petites roses jaunes', 48, 'images/fleurs/mayotte.gif', 'fle');
INSERT INTO Produit VALUES (5, 'Fuseau de roses multicolores', 63, 'images/fleurs/philippines.gif', 'fle');
INSERT INTO Produit VALUES (6, 'Petit bouquet de roses roses', 43, 'images/fleurs/pakopoka.gif', 'fle');
INSERT INTO Produit VALUES (7, 'Panier de roses multicolores', 78, 'images/fleurs/seychelles.gif', 'fle');

INSERT INTO Produit VALUES (8, 'Panier de fleurs variées', 53, 'images/compo/aniwa.gif', 'com');
INSERT INTO Produit VALUES (9, 'Coup de charme jaune', 38, 'images/compo/kos.gif', 'com');
INSERT INTO Produit VALUES (10, 'Bel arrangement de fleurs de saison', 68, 'images/compo/loth.gif', 'com');
INSERT INTO Produit VALUES (11, 'Coup de charme vert', 41, 'images/compo/luzon.gif', 'com');
INSERT INTO Produit VALUES (12, 'Très beau panier de fleurs précieuses', 98, 'images/compo/makin.gif', 'com');
INSERT INTO Produit VALUES (13, 'Bel assemblage de fleurs précieuses', 68, 'images/compo/mosso.gif', 'com');
INSERT INTO Produit VALUES (14, 'Présentation prestigieuse', 128, 'images/compo/rawaki.gif', 'com');

INSERT INTO Produit VALUES (15, 'Plante fleurie', 43,'images/plantes/antharium.gif', 'pla');
INSERT INTO Produit VALUES (16, 'Pot de phalaonopsis', 58, 'images/plantes/galante.gif', 'pla');
INSERT INTO Produit VALUES (17, 'Assemblage paysagé', 103, 'images/plantes/lifou.gif', 'pla');
INSERT INTO Produit VALUES (18, 'Belle coupe de plantes blanches', 128, 'images/plantes/losloque.gif', 'pla');
INSERT INTO Produit VALUES (19, 'Pot de mitonia mauve', 83, 'images/plantes/papouasi.gif', 'pla');
INSERT INTO Produit VALUES (20, 'Pot de phalaonopsis blanc', 58, 'images/plantes/pionosa.gif', 'pla');
INSERT INTO Produit VALUES (21, 'Pot de phalaonopsis rose mauve', 58, 'images/plantes/sabana.gif', 'pla');

INSERT INTO Compte VALUES (1, 'administrateur', 'warrenbev', SHA2('warrenbvad', 224), '28 route des Vallières', '78125', 'Raizeux', 'warren@gmail.com', 1);
INSERT INTO Compte VALUES (2, 'administrateur', 'elsacd', SHA2('elsacdad', 224), '81 route des chataigniers', '78320', 'Levis saint Nom', 'cad.elsa@gmail.com', 1);
INSERT INTO Compte VALUES (3, 'Linag', 'linag75', SHA2('linagcl', 224), '25 route des coins', '75014', 'Paris', 'linag@gmail.com',  2);
INSERT INTO Compte VALUES (4, 'Pasteuri', 'pasteri', SHA2('pastericl', 224), '4 routes des charmes', '78125', 'Raizeux', 'pasteuri@gmail.com', 2);

INSERT INTO Commande VALUES (1, '2021-04-12', 3, 110);
INSERT INTO Commande VALUES (2, '2021-04-20', 4, 150);
INSERT INTO Commande VALUES (3, '2021-04-28', 4, 170);

INSERT INTO Contenir VALUES (1, 12, 2);
INSERT INTO Contenir VALUES (1, 3, 1);
INSERT INTO Contenir VALUES (2, 7, 1);
INSERT INTO Contenir VALUES (2, 5, 3);
INSERT INTO Contenir VALUES (3, 8, 2);
INSERT INTO Contenir VALUES (3, 11, 4);



