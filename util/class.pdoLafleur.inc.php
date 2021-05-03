<?php
/** 
 * Classe d'accès aux données. 
 * 
 * Utilise les services de la classe PDO
 * pour l'application lafleur
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoLaFleur qui contiendra l'unique instance de la classe
 *
 * @package 	default
 * @author		Patrice Grand
 * @author 		Bevilacqua Warren
 * @version     1.0
 * @link        http://www.php.net/manual/fr/book.pdo.php
 */

class PdoLafleur
{   		
    private static $serveur='mysql:host=localhost';
    private static $bdd='dbname=lafleur';
    private static $user='lafleur' ;
    private static $mdp='secret' ;
	  private static $monPdo;
	  private static $monPdoLafleur = null;


 /**
  * __construct

  * Constructeur privé, crée l'instance de PDO qui sera sollicitée
  * pour toutes les méthodes de la classe
  */				
 private function __construct() { // le constructeur ne peut pas être appelé à l'exterieur de la classe => on utlise get Pdolafleur
 	PdoLafleur::$monPdo = new PDO(PdoLafleur::$serveur.';'.PdoLafleur::$bdd, PdoLafleur::$user, PdoLafleur::$mdp); 
 	PdoLafleur::$monPdo->query("SET CHARACTER SET utf8");
 }

  
 /**
  * _destruct
  *
  * Détruit l'instance de PDO
  */
 public function _destruct() 
 {
 	PdoLafleur::$monPdo = null;
 }


 /**
  * getPdoLafleur
  * 
  * Fonction statique qui crée l'unique instance de la classe
  * Appel : $instancePdolafleur = PdoLafleur::getPdoLafleur();
  *
  * @return l'unique objet de la classe PdoLafleur
  */
  public  static function getPdoLafleur()
  {
  	if(PdoLafleur::$monPdoLafleur == null) {
  		PdoLafleur::$monPdoLafleur = new PdoLafleur();
  	}
  	return PdoLafleur::$monPdoLafleur;  
  }


 /**
  * getLesCategories
  * 
  * Retourne toutes les catégories sous forme d'un tableau associatif
  *
  * @return le tableau associatif des catégories 
 */
 public function getLesCategories()
 {
 	$requetePrepare = PdoLaFleur::$monPdo->prepare(
 		'SELECT * '
 		. 'FROM Categorie'
 	);
 	$requetePrepare->execute();
 	$lesLignes = $requetePrepare->fetchAll();
 	return $lesLignes;
 }


 /**
  * getLesProduitsDeCategorie
  * 
  * Retourne sous forme d'un tableau associatif tous les produits de la
  * catégorie passée en argument
  * 
  * @param String $idCategorie 	id d'une catégorie
  * 
  * @return un tableau associatif  
 */
 public function getLesProduitsDeCategorie($idCategorie)
 {
     $requetePrepare = PdoLaFleur::$monPdo->prepare(
 		'SELECT * '
 		. 'FROM Produit '
 		. 'WHERE idCategorie = :idCategorie'
 	);
 	$requetePrepare->bindParam(':idCategorie', $idCategorie, PDO::PARAM_STR);
 	$requetePrepare->execute();
 	$lesLignes = $requetePrepare->fetchAll();
 	return $lesLignes; 
 } 


 /**
  * getLesProduitsDuTableau
  * 
  * Retourne les informations produit concernées par le tableau des idProduits passé en argument
  *
  * @param Int $desIdProduit 	tableau d'idProduits
  * 
  * @return un tableau associatif 
  */
 public function getLesProduitsDuTableau($desIdProduit)
 {
 	$nbProduits = count($desIdProduit);
 	$lesLignes=array();
 	if($nbProduits != 0)
 	{
 		foreach($desIdProduit as $unIdProduit)
 		{
 			$requetePrepare = PdoLaFleur::$monPdo->prepare(
 				'SELECT * '
 				. 'FROM Produit '
 				. 'WHERE id = :unIdProduit'
 			);
 			$requetePrepare->bindParam(':unIdProduit', $unIdProduit, PDO::PARAM_INT);
 			$requetePrepare->execute();
 			$unProduit = $requetePrepare->fetch();
 			$lesLignes[] = $unProduit;
 		}
 	}
 	return $lesLignes;
 }  

  
  /**
   * creerCommande
   * 
   * Crée une commande à partir des arguments passés en paramètre, l'identifiant est
   * construit en auto-increment; crée les lignes de commandes dans la table contenir à partir du
   * tableau d'idProduit passé en paramètre
   *
   * @param Int $idClient
   * @param Array $lesIdProduit
   * @param Float $prix
   */
  public function creerCommande($idClient, $lesIdProduit, $prix)
  {
  	$date = date('Y/m/d');
  	$compteur = 0;  
  	$requetePrepare = PdoLafleur::$monPdo->prepare(
  		'INSERT INTO Commande (dateCommande, idCompte, prix) '
  		. 'VALUES (:date, :idClient, :prix)'
  	);
  	$requetePrepare->bindParam(':date', $date, PDO::PARAM_STR); // mettre manuellement idCommande en le mettant en parametre
    $requetePrepare->bindParam(':idClient', $idClient, PDO::PARAM_INT);
  	$requetePrepare->bindParam(':prix', $prix, PDO::PARAM_INT);
  	$requetePrepare->execute();  
  	$requetePrepare = PdoLafleur::$monPdo->prepare(
  		'SELECT max(id) '
  		. 'FROM Commande '
  	);
  	$requetePrepare->execute();
  	$idCommande = $requetePrepare->fetch()[0];	// Récupération de l'idCommande pour la table contenir  
    foreach($lesIdProduit as $unIdProduit)
    {	    	
  		while (!isset($_SESSION['quantite'][$compteur])) {
  			$compteur++;
  		}
  		$qte = $_SESSION['quantite'][$compteur];
  		$compteur++;  
      	$requetePrepare = PdoLafleur::$monPdo->prepare(		// Insert de toutes les lignes de la commande
      		'INSERT INTO Contenir '
      		. 'VALUES (:unIdCommande, :unIdProduit, :quantite)'
      	);
      	$requetePrepare->bindParam(':unIdCommande', $idCommande, PDO::PARAM_INT);
      	$requetePrepare->bindParam(':unIdProduit', $unIdProduit, PDO::PARAM_INT);
      	$requetePrepare->bindParam(':quantite', $qte, PDO::PARAM_INT);
      	$requetePrepare->execute();
    }
  }
  

  /**
   * verifConnexionCompte
   * 
   * fonction de verification des logins de connexion
   * 
   * Cette fonction permet de verifier le login de compte et le mot de passe inscrit 
   * par l'utilisateur par rapport à la base de données
   *
   * @param String $login	login saisi
   * @param String $mdp		mot de passe saisi
   * 
   * @return un tableau contenant des informations du compte client, ou rien si les logins sont introuvables
   */
  public function verifConnexionCompte($login, $mdp)
  {
  	$requetePrepare = PdoLafleur::$monPdo->prepare(
  		'SELECT login, mdp, idTypeUtilisateur as type '
  		. 'FROM Compte '
  		. 'WHERE login = :login '
  		. 'AND mdp = :mdp '
  	);
  	$requetePrepare->bindParam(':login', $login, PDO::PARAM_STR);
    $requetePrepare->bindParam(':mdp', $mdp, PDO::PARAM_STR);
  	$requetePrepare->execute();  
  	return $requetePrepare->fetch();
  }  


  /**
   * getProduit
   * 
   * fonction renvoyant les informations d'un produit
   *	
   * @param Int $idProduit		l'id du produit
   * 
   * @return un tableau des informations produit
   */
  public function getProduit($idProduit) {
  	$requetePrepare = PdoLafleur::$monPdo->prepare(
  		'SELECT * '
  		. 'FROM Produit '
  		. 'WHERE id = :idProduit'
  	);
  	$requetePrepare->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
  	$requetePrepare->execute();
  	$lesLignes = $requetePrepare->fetch();
  	return $lesLignes;
  }
  
  /**
  * fonction modification de valeur
  *
  * Cette fonction permet de modifier une valeur déjà inscrite dans la base de donnée
  *
  * @param Int 	  $idProduit	  Id du produit à modifier
  * @param String $description	  Nouvelle description produit
  * @param Float  $prix			  Nouveau prix
  */
	public function modifiValeur($idProduit, $description, $prix)
	{
		$requetePrepare = PdoLafleur::$monPdo->prepare(
			'UPDATE Produit '
			. 'SET description = :description, '
			. 'prix = :prix WHERE id= :unIdProduit'
		);
		$requetePrepare->bindParam(':description', $description, PDO::PARAM_STR);
		$requetePrepare->bindParam(':prix', $prix, PDO::PARAM_INT);
		$requetePrepare->bindParam(':unIdProduit', $idProduit, PDO::PARAM_INT);
		$requetePrepare->execute();
	}
	

  /**
   * supprimer
   *
   * Cette fonction permet de supprimer un produit grâce a son ID
   * 
   * @param Int $idProduit	Id du produit à supprimer
   */
  public function supprimer($idProduit)
  {
  	$requetePrepare = PdoLafleur::$monPdo->prepare(
  		'DELETE FROM Produit '
  		. 'WHERE id= :idProduit'
  	);
  	$requetePrepare->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
  	$requetePrepare->execute();
  }


  /**
  * fonction ajouter
  *
  * Cette fonction permet d'ajouter un produit dans la base de donnée
  *
  * @param String $categorie		catégorie produit
  * @param String $description		description produit
  * @param Float  $prix				prix produit
  * @param String $image			chemin image produit
  */
  public function ajouter($categorie, $description, $prix, $image)
  {	
  	$requetePrepare = PdoLafleur::$monPdo->prepare(
  		'INSERT INTO Produit (description, prix, image, idCategorie) '
  		. 'VALUES (:description, :prix, :image, :categorie)'
  	);
  	$requetePrepare->bindParam(':description', $description, PDO::PARAM_STR);
  	$requetePrepare->bindParam(':prix', $prix, PDO::PARAM_INT);
  	$requetePrepare->bindParam(':image', $image, PDO::PARAM_STR);
  	$requetePrepare->bindParam(':categorie', $categorie, PDO::PARAM_STR);
  	$requetePrepare->execute();	
  }

	
  /**
   * getInfosClient
   *
   * Renvoie les informations de la table compte selon le login en paramètre
   * 
   * @param String $login	login paramètre
   * 
   * @return un tableau associatif de clés de la table compte
   */
  public function getInfosClient($login) {
  	$requetePrepare = PdoLafleur::$monPdo->prepare(
  		'SELECT * '
  		. 'FROM Compte '
  		. ' WHERE login = :login'
  	);
  	$requetePrepare->bindParam(':login', $login, PDO::PARAM_STR);
  	$requetePrepare->execute();
  	return $requetePrepare->fetch();
  }

    
  /**
   * creationCompte
   * 
   * Permet la création d'un compte client dans la base de données
   *
   * @param  String $raisonSociale
   * @param  String $login
   * @param  String $mdp
   * @param  String $adresse
   * @param  String $cp
   * @param  String $ville
   * @param  String $mail
   */
  public function creationCompte($raisonSociale, $login, $mdp, $adresse, $cp, $ville, $mail) {	// idTypeUtilisateur prend la valeur 2 par défaut
	  $requetePrepare = PdoLafleur::$monPdo->prepare(
	  	'INSERT INTO Compte (raisonSociale, login, mdp, adresse, cp, ville, mail) '
	  	. 'VALUES (:raisonSociale, :login, :mdp, :adresse, :cp, :ville, :mail)'
	  );
	  $requetePrepare->bindParam(':raisonSociale', $raisonSociale, PDO::PARAM_STR);
	  $requetePrepare->bindParam(':login', $login, PDO::PARAM_STR);
	  $requetePrepare->bindParam(':mdp', $mdp, PDO::PARAM_STR);
	  $requetePrepare->bindParam(':adresse', $adresse, PDO::PARAM_STR);
	  $requetePrepare->bindParam(':cp', $cp, PDO::PARAM_STR);
	  $requetePrepare->bindParam(':ville', $ville, PDO::PARAM_STR);
	  $requetePrepare->bindParam(':mail', $mail, PDO::PARAM_STR);
	  $requetePrepare->execute();
  }
  

  /**
   * getCommandesClient
   *
   * @param Int $idClient	Id du client
   * 
   * @return un tableau de tableau d'information de commandes
   */
  public function getCommandesClient($idClient) {
	 $requetePrepare = PdoLafleur::$monPdo->prepare(
	 	'SELECT * '
	 	. 'FROM Commande '
	 	. 'WHERE idCompte = :idClient'
	 );
	 $requetePrepare->bindParam(':idClient', $idClient, PDO::PARAM_INT);
	 $requetePrepare->execute();
	 return $requetePrepare->fetchAll();
  }

	
  /**
   * getArticlesCommande
   *
   * @param Int $idCommande		Id de la commande
   * 
   * @return Un tableau contenant les informations des articles d'une commande
   */
  public function getArticlesCommande($idCommande) {
  	 $requetePrepare = PdoLafleur::$monPdo->prepare(
  		'SELECT * '
  		. 'FROM Contenir '
  		. 'INNER JOIN Produit '
  		. 'ON Contenir.idProduit = Produit.id '
  		. 'WHERE idCommande = :idCommande'
  	 );
  	 $requetePrepare->bindParam(':idCommande', $idCommande, PDO::PARAM_INT);
  	 $requetePrepare->execute();
  	 return $requetePrepare->fetchAll();
  }

  
  /**
   * SHA2
   *
   * @param String $mdp   mot de passe saisi
   * 
   * @return mot de passe hashé
   */
  public function SHA2($mdp) {
    $requetePrepare = PdoLafleur::$monPdo->prepare(
      'SELECT SHA2(:mdp, 224) '
    );
      $requetePrepare->bindParam(':mdp', $mdp, PDO::PARAM_STR);
  	  $requetePrepare->execute();
      return $requetePrepare->fetch()[0];
  }

}
?>