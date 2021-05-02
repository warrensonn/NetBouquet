
# -----------------------------------------------------------------------------
#       TABLE : produit
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS produit
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
#       INDEX DE LA TABLE produit
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_Produit_CATEGORIE
     ON produit (idCategorie ASC);


# -----------------------------------------------------------------------------
#       TABLE : commande
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS commande
 (
   id INT AUTO_INCREMENT NOT NULL,
   dateCommande DATE NULL,
   idCompte INT NOT NULL,
   prix INT NOT NULL,
   PRIMARY KEY (id) 
 ) 
 ENGINE=InnoDB;


# -----------------------------------------------------------------------------
#       TABLE : categorie
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS categorie
 (
   id CHAR (3) NOT NULL,
   libelle CHAR (32) NULL, 
   PRIMARY KEY (id) 
 ) 
 ENGINE=InnoDB;


# -----------------------------------------------------------------------------
#       TABLE : contenir
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS contenir
 (
	idCommande INT NOT NULL ,
  idProduit INT (3) NOT NULL, 
  quantité INT (2) NOT NULL,
  PRIMARY KEY (idCommande, idProduit) 
 ) 
 ENGINE=InnoDB;


# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE contenir
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_CONTENIR_COMMANDE
    ON contenir (idCommande ASC);

CREATE INDEX I_FK_CONTENIR_PRODUIT
    ON contenir (idProduit ASC);


# -----------------------------------------------------------------------------
#       TABLE : typeUtilisateur
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS typeUtilisateur
 (
	 id CHAR (1) NOT NULL,
   libelle CHAR (20) NOT NULL, 
   PRIMARY KEY (id) 
 )
 ENGINE=InnoDB; 



# -----------------------------------------------------------------------------
#       TABLE : compte 
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS compte
 (
  id INT (10) AUTO_INCREMENT NOT NULL,
  raisonSociale CHAR (50) NOT NULL,
  login CHAR (20) NOT NULL,
  mdp CHAR (20) NOT NULL,
  adresse CHAR (32) NOT NULL,
  cp CHAR (5) NOT NULL,
  ville CHAR (32) NOT NULL,
	mail CHAR(50) NOT NULL,
  idTypeUtilisateur INT (1) NOT NULL DEFAULT 2,
  PRIMARY KEY(id)
 )
 ENGINE=InnoDB;
	
# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE produit 
  ADD FOREIGN KEY FK_PRODUIT_CATEGORIE (idCategorie)
      REFERENCES categorie (id) ;

ALTER TABLE commande 
  ADD FOREIGN KEY FK_COMMANDE_COMPTE (idcompte)
      REFERENCES compte (id) ;

ALTER TABLE contenir 
  ADD FOREIGN KEY FK_CONTENIR_COMMANDE (idCommande)
      REFERENCES commande (id) ;

ALTER TABLE contenir 
  ADD FOREIGN KEY FK_CONTENIR_PRODUIT2 (idProduit)
      REFERENCES produit (id) ;

ALTER TABLE compte
  ADD FOREIGN KEY FK_COMPTE_TYPEUTILISATEUR (idTypeUtilisateur)
      REFERENCES typeUtilisateur (id) ;




# -----------------------------------------------------------------------------
#       CREATION DES LIGNES DES TABLES
# -----------------------------------------------------------------------------

INSERT INTO categorie VALUES ('fle', 'Fleurs');
INSERT INTO categorie VALUES ('pla', 'Plantes');
INSERT INTO categorie VALUES ('com', 'Composition');

INSERT INTO typeUtilisateur VALUES (1, 'administrateur');
INSERT INTO typeUtilisateur VALUES (2, 'client');

INSERT INTO produit VALUES (1, 'Bouquet de roses multicolores' , 58, 'images/fleurs/comores.gif', 'fle');
INSERT INTO produit VALUES (2, 'Bouquet de roses rouges', 50, 'images/fleurs/grenadines.gif', 'fle');
INSERT INTO produit VALUES (3, 'Bouquet de roses jaunes', 78, 'images/fleurs/mariejaune.gif', 'fle');
INSERT INTO produit VALUES (4, 'Bouquet de petites roses jaunes', 48, 'images/fleurs/mayotte.gif', 'fle');
INSERT INTO produit VALUES (5, 'Fuseau de roses multicolores', 63, 'images/fleurs/philippines.gif', 'fle');
INSERT INTO produit VALUES (6, 'Petit bouquet de roses roses', 43, 'images/fleurs/pakopoka.gif', 'fle');
INSERT INTO produit VALUES (7, 'Panier de roses multicolores', 78, 'images/fleurs/seychelles.gif', 'fle');

INSERT INTO produit VALUES (8, 'Panier de fleurs variées', 53, 'images/compo/aniwa.gif', 'com');
INSERT INTO produit VALUES (9, 'Coup de charme jaune', 38, 'images/compo/kos.gif', 'com');
INSERT INTO produit VALUES (10, 'Bel arrangement de fleurs de saison', 68, 'images/compo/loth.gif', 'com');
INSERT INTO produit VALUES (11, 'Coup de charme vert', 41, 'images/compo/luzon.gif', 'com');
INSERT INTO produit VALUES (12, 'Très beau panier de fleurs précieuses', 98, 'images/compo/makin.gif', 'com');
INSERT INTO produit VALUES (13, 'Bel assemblage de fleurs précieuses', 68, 'images/compo/mosso.gif', 'com');
INSERT INTO produit VALUES (14, 'Présentation prestigieuse', 128, 'images/compo/rawaki.gif', 'com');

INSERT INTO produit VALUES (15, 'Plante fleurie', 43,'images/plantes/antharium.gif', 'pla');
INSERT INTO produit VALUES (16, 'Pot de phalaonopsis', 58, 'images/plantes/galante.gif', 'pla');
INSERT INTO produit VALUES (17, 'Assemblage paysagé', 103, 'images/plantes/lifou.gif', 'pla');
INSERT INTO produit VALUES (18, 'Belle coupe de plantes blanches', 128, 'images/plantes/losloque.gif', 'pla');
INSERT INTO produit VALUES (19, 'Pot de mitonia mauve', 83, 'images/plantes/papouasi.gif', 'pla');
INSERT INTO produit VALUES (20, 'Pot de phalaonopsis blanc', 58, 'images/plantes/pionosa.gif', 'pla');
INSERT INTO produit VALUES (21, 'Pot de phalaonopsis rose mauve', 58, 'images/plantes/sabana.gif', 'pla');

INSERT INTO compte VALUES (1, 'administrateur', 'warrenbev', 'warrenbvad', '28 route des Vallières', '78125', 'Raizeux', 'warren@gmail.com', 1);
INSERT INTO compte VALUES (2, 'administrateur', 'elsacd', 'elsacdad', '81 route des chataigniers', '78320', 'Levis saint Nom', 'cad.elsa@gmail.com', 1);
INSERT INTO compte VALUES (3, 'Linag', 'linag75', 'linagcl', '25 route des coins', '75014', 'Paris', 'linag@gmail.com',  2);
INSERT INTO compte VALUES (4, 'Pasteuri', 'pasteri78', 'pastericl', '4 routes des charmes', '78125', 'Raizeux', 'pasteuri@gmail.com', 2);

INSERT INTO commande VALUES (1, '2021-04-12', 3, 110);
INSERT INTO commande VALUES (2, '2021-04-20', 4, 150);
INSERT INTO commande VALUES (3, '2021-04-28', 4, 170);

INSERT INTO contenir VALUES (1, 12, 2);
INSERT INTO contenir VALUES (1, 3, 1);
INSERT INTO contenir VALUES (2, 7, 1);
INSERT INTO contenir VALUES (2, 5, 3);
INSERT INTO contenir VALUES (3, 8, 2);
INSERT INTO contenir VALUES (3, 11, 4);




