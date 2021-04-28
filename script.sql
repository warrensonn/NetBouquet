
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
#       TABLE : COMMANDE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Commande
 (
   id CHAR (32) NOT NULL,
   dateCommande DATE NULL,
   nomClient CHAR (32) NULL,
   prenomClient CHAR (32) NULL,
   telephone CHAR (12) NULL,
   adresseRueClient CHAR (32) NULL,
   cpClient CHAR (5) NULL,
   villeClient CHAR (32) NULL,
	 mailClient CHAR(50) NULL, 
   PRIMARY KEY (id) 
 ) 
 ENGINE=InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : CATEGORIE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Categorie
 (
   id CHAR (3) NOT NULL,
   libelle CHAR (32) NULL, 
   PRIMARY KEY (id) 
 ) 
 ENGINE=InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : CONTENIR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Contenir
 (
	idCommande CHAR (32) NOT NULL ,
  idProduit INT (3) NOT NULL, 
  quantité INT (2) NOT NULL,
  PRIMARY KEY (idCommande, idProduit) 
 ) 
 ENGINE=InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE CONTENIR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_CONTENIR_COMMANDE
     ON CONTENIR (idCommande ASC);

CREATE  INDEX I_FK_CONTENIR_Produit
     ON CONTENIR (idProduit ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE Produit 
  ADD FOREIGN KEY FK_Produit_CATEGORIE (idCategorie)
      REFERENCES CATEGORIE (id) ;


ALTER TABLE Contenir 
  ADD FOREIGN KEY FK_CONTENIR_COMMANDE (idCommande)
      REFERENCES COMMANDE (id) ;


ALTER TABLE Contenir 
  ADD FOREIGN KEY FK_CONTENIR_Produit (idProduit)
      REFERENCES Produit (id) ;

# -----------------------------------------------------------------------------
#       TABLE : ADMIN
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Administrateur
 (
	 id CHAR (3) NOT NULL,
   nom CHAR (20) NOT NULL,
   prenom CHAR (20) NOT NULL,
   login CHAR(32) NOT NULL,
   mdp CHAR(32) NOT NULL, 
   PRIMARY KEY (id) 
 )
 ENGINE=InnoDB; 

# -----------------------------------------------------------------------------
#       TABLE : ADMIN
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS client
 (
  id INT (10) AUTO_INCREMENT NOT NULL,
  raisonSociale CHAR (50) NOT NULL,
  login CHAR (20) NOT NULL,
  mdp CHAR (20) NOT NULL,
  adresse CHAR (32) NULL,
  cpClient CHAR (5) NULL,
  villeClient CHAR (32) NULL,
	mailClient CHAR(50) NULL, 
  PRIMARY KEY(id)
 )
 ENGINE=InnoDB;
	



# -----------------------------------------------------------------------------
#       CREATION DES LIGNES DES TABLES
# -----------------------------------------------------------------------------
INSERT INTO categorie VALUES ('fle','Fleurs');
INSERT INTO categorie VALUES ('pla','Plantes');
INSERT INTO categorie VALUES ('com','Composition');

INSERT INTO produit VALUES (1, 'Bouquet de roses multicolores',58,'images/fleurs/comores.gif','fle');
INSERT INTO produit VALUES (2, 'Bouquet de roses rouges',50,'images/fleurs/grenadines.gif','fle');
INSERT INTO produit VALUES (3, 'Bouquet de roses jaunes',78,'images/fleurs/mariejaune.gif','fle');
INSERT INTO produit VALUES (4, 'Bouquet de petites roses jaunes',48,'images/fleurs/mayotte.gif','fle');
INSERT INTO produit VALUES (5, 'Fuseau de roses multicolores',63,'images/fleurs/philippines.gif','fle');
INSERT INTO produit VALUES (6, 'Petit bouquet de roses roses',43,'images/fleurs/pakopoka.gif','fle');
INSERT INTO produit VALUES (7, 'Panier de roses multicolores',78,'images/fleurs/seychelles.gif','fle');

INSERT INTO produit VALUES (8, 'Panier de fleurs variées',53,'images/compo/aniwa.gif','com');
INSERT INTO produit VALUES (9, 'Coup de charme jaune',38,'images/compo/kos.gif','com');
INSERT INTO produit VALUES (10, 'Bel arrangement de fleurs de saison',68,'images/compo/loth.gif','com');
INSERT INTO produit VALUES (11, 'Coup de charme vert',41,'images/compo/luzon.gif','com');
INSERT INTO produit VALUES (12, 'Très beau panier de fleurs précieuses',98,'images/compo/makin.gif','com');
INSERT INTO produit VALUES (13, 'Bel assemblage de fleurs précieuses',68,'images/compo/mosso.gif','com');
INSERT INTO produit VALUES (14, 'Présentation prestigieuse',128,'images/compo/rawaki.gif','com');

INSERT INTO produit VALUES (15, 'Plante fleurie',43,'images/plantes/antharium.gif','pla');
INSERT INTO produit VALUES (16, 'Pot de phalaonopsis',58,'images/plantes/galante.gif','pla');
INSERT INTO produit VALUES (17, 'Assemblage paysagé',103,'images/plantes/lifou.gif','pla');
INSERT INTO produit VALUES (18, 'Belle coupe de plantes blanches',128,'images/plantes/losloque.gif','pla');
INSERT INTO produit VALUES (19, 'Pot de mitonia mauve',83,'images/plantes/papouasi.gif','pla');
INSERT INTO produit VALUES (20, 'Pot de phalaonopsis blanc',58,'images/plantes/pionosa.gif','pla');
INSERT INTO produit VALUES (21, 'Pot de phalaonopsis rose mauve',58,'images/plantes/sabana.gif','pla');



INSERT INTO commande VALUES ('1101461660', '2021-04-12', 'Dupont', 'Jacques', '060000000000', '12, rue haute', '75001', 'Paris', 'dupont@wanadoo.fr');
INSERT INTO commande VALUES ('1101461665', '2021-04-20', 'Durant', 'Yves', '061111111111', '23, rue des ombres', '75012', 'Paris', 'durant@free.fr');

INSERT INTO contenir VALUES ('1101461660', 12, 2);
INSERT INTO contenir VALUES ('1101461660', 3, 1);
INSERT INTO contenir VALUES ('1101461665', 7, 1);
INSERT INTO contenir VALUES ('1101461665', 5, 3);

INSERT INTO Administrateur VALUES ('1','Bevilacqua', 'Warren', 'warrenbev', 'warrenbv78');
INSERT INTO Administrateur VALUES ('2','Cady','Elsa', 'elsacd', 'elsacd78');

INSERT INTO client VALUES (1, 'Linag', 'linag75', 'linagcl', '25 route des coins', '75014', 'Paris', 'linag@gmail.com')
INSERT INTO client VALUES (2, 'Pasteuri', 'pasteri78', 'pastericl', '4 routes des charmes', '78125', 'Raizeux', 'pasteuri@gmail.com')


