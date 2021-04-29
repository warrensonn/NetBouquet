<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application lafleur
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 *
 * @package default
 * @author Patrice Grand
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoLafleur
{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=lafleur';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
		private static $monPdo;
		private static $monPdoLafleur = null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct() // le constructeur ne peut pas être appelé à l'exterieur de la classe => on utlise get Pdolafleur
	{
    		PdoLafleur::$monPdo = new PDO(PdoLafleur::$serveur.';'.PdoLafleur::$bdd, PdoLafleur::$user, PdoLafleur::$mdp); 
			PdoLafleur::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoLafleur::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 *
 * Appel : $instancePdolafleur = PdoLafleur::getPdoLafleur();
 * @return l'unique objet de la classe PdoLafleur
 */
	public  static function getPdoLafleur()
	{
		if(PdoLafleur::$monPdoLafleur == null)
		{
			PdoLafleur::$monPdoLafleur= new PdoLafleur();
		}
		return PdoLafleur::$monPdoLafleur;  
	}
	/**
	 * Retourne toutes les catégories sous forme d'un tableau associatif
	 *
	 * @return le tableau associatif des catégories 
	*/
	public function getLesCategories()
	{
		$requetePrepare = "select * from categorie";
		$res = PdoLafleur::$monPdo->query($requetePrepare);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	/**
	 * Retourne sous forme d'un tableau associatif tous les produits de la
	 * catégorie passée en argument
	 * 
	 * @param $idCategorie 
	 * @return un tableau associatif  
	*/
	public function getLesProduitsDeCategorie($idCategorie)
	{
	    $requetePrepare="select * from produit where idCategorie = '$idCategorie'";
		$res = PdoLafleur::$monPdo->query($requetePrepare);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}

	/**
	 * Retourne les produits concernés par le tableau des idProduits passée en argument
	 *
	 * @param $desIdProduit tableau d'idProduits
	 * @return un tableau associatif 
	 */
	public function getLesProduitsDuTableau($desIdProduit)
	{
		$nbProduits = count($desIdProduit);
		$lesProduits=array();
		if($nbProduits != 0)
		{
			foreach($desIdProduit as $unIdProduit)
			{
				$requetePrepare = "select * from produit where id = '$unIdProduit'";
				$res = PdoLafleur::$monPdo->query($requetePrepare);
				$unProduit = $res->fetch();
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	}

	/**
	 * Crée une commande 
	 *
	 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
	 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
	 * tableau d'idProduit passé en paramètre
	 * @param $nom 
	 * @param $rue
	 * @param $cp
	 * @param $ville
	 * @param $mail
	 * @param $lesIdProduit 
	*/
	public function creerCommande($idClient, $lesIdProduit, $prix)
	{
		$date = date('Y/m/d');

		$requetePrepare = PdoLafleur::$monPdo->prepare(
			'INSERT INTO commande (dateCommande, idClient, prix) '
			. 'VALUES (:date, :idClient, :prix)'
		);
		$requetePrepare->bindParam(':date', $date, PDO::PARAM_STR);
        $requetePrepare->bindParam(':idClient', $idClient, PDO::PARAM_INT);
		$requetePrepare->bindParam(':prix', $prix, PDO::PARAM_INT);
		$requetePrepare->execute();

		// foreach($lesIdProduit as $unIdProduit)
		// {
		// 	$index = array_search($unIdProduit,$_SESSION['produits']);
		// 	$requetePrepare = PdoLafleur::$monPdo->prepare(
		// 		'INSERT INTO contenir '
		// 		. 'VALUES (:unIdCommande, :unIdProduit, :quantité)'
		// 	);
		// 	$requetePrepare->bindParam(':unIdCommande', $idCommande, PDO::PARAM_STR);
        // 	$requetePrepare->bindParam(':unIdProduit', $unIdProduit, PDO::PARAM_STR);
		// 	$requetePrepare->bindParam(':quantité', $_SESSION['quantite'][$index], PDO::PARAM_INT);
		// 	// $requetePrepare->execute();
		// 	print_r(array_keys($_SESSION));
		// }
		
	
	}
	
	/**
	 * fonction de verification de connexion
	 * 
	 * Cette fonction permet de verifier le nom de compte et le mot de passe inscrit 
	 * par l'utilisateur par rapport à la base de données
	 * connaitre les bons login et mot de passe
	 *
	 * @param $login
	 * @param $mdp
	 */
	public function verifConnexionClient($login, $mdp)
	{
		$requetePrepare = PdoLafleur::$monPdo->prepare(
			'SELECT login, mdp '
			. 'FROM client '
			. 'WHERE login = :login '
			. 'AND mdp = :mdp '
		);
		$requetePrepare->bindParam(':login', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':mdp', $mdp, PDO::PARAM_STR);
		$requetePrepare->execute();

		return $requetePrepare->fetch();
	}

	/**
	 * fonction de verification de connexion
	 * 
	 * Cette fonction permet de verifier le nom de compte et le mot de passe inscrit 
	 * par l'utilisateur par rapport à la base de données
	 * connaitre les bons login et mot de passe
	 *
	 * @param $login
	 * @param $mdp
	 */
	public function verifConnexionAdmin($login, $mdp)
	{
		$requetePrepare = PdoLafleur::$monPdo->prepare(
			'SELECT login, mdp '
			. 'FROM administrateur '
			. 'WHERE login = :login '
			. 'AND mdp = :mdp '
		);
		$requetePrepare->bindParam(':login', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':mdp', $mdp, PDO::PARAM_STR);
		$requetePrepare->execute();

		return $requetePrepare->fetch();
	}

	/**
	 * fonction affichant les produits
	 *	
	 * Cette fonction permet d'afficher tout les produits
	 * inscrit dans la base de donnée
	 *	
	 * @param $idProduit
	 */
	public function getProduit($idProduit) {
		$requetePrepare="SELECT * FROM produit WHERE id='".$idProduit."'";
		$res = PdoLafleur::$monPdo->query($requetePrepare);
		$produit=$res->fetch();
		return $produit;
	}
	
	/**
	* fonction modification de valeur
		
	* Cette fonction permet modifier une valeur déjà inscrite dans la base de donnée
		
	* @param $idProduit
	* @param $description
	* @param $prix
	*/
	public function modifiValeur($idProduit, $description, $prix)
	{
		$requetePrepare = PdoLafleur::$monPdo->prepare(
			'UPDATE produit '
			. 'SET description = :description, '
			. 'prix = :prix WHERE id= :unIdProduit'
		);
		$requetePrepare->bindParam(':description', $description, PDO::PARAM_STR);
		$requetePrepare->bindParam(':prix', $prix, PDO::PARAM_INT);
		$requetePrepare->bindParam(':unIdProduit', $idProduit, PDO::PARAM_INT);
		$requetePrepare->execute();
	}
	
	/**
	* fonction supprimer 
		
	* Cette fonction permet de supprimer un produit grâce a son ID
		
	* @param $id
	*/
	public function supprimer($id)
	{
		$requetePrepare = PdoLafleur::$monPdo->prepare(
			'DELETE FROM produit '
			. 'WHERE id= :id'
		);
		$requetePrepare->bindParam(':id', $id, PDO::PARAM_INT);
		$requetePrepare->execute();
	}
	/**
	* fonction ajouter
		
	* Cette fonction permet d'ajouter un produit dans la base de donnée
		
	* @param $id
	* @param $categorie
	* @param $description
	* @param $prix
	* @param $image
	*/
	public function ajouter($categorie, $description, $prix, $image)
	{	
		$requetePrepare = PdoLafleur::$monPdo->prepare(
			'INSERT INTO produit (description, prix, image, idCategorie) '
			. 'VALUES (:description, :prix, :image, :categorie)'
		);
		$requetePrepare->bindParam(':description', $description, PDO::PARAM_STR);
		$requetePrepare->bindParam(':prix', $prix, PDO::PARAM_INT);
		$requetePrepare->bindParam(':image', $image, PDO::PARAM_STR);
		$requetePrepare->bindParam(':categorie', $categorie, PDO::PARAM_STR);
		$requetePrepare->execute();	
	}

	public function articleExiste($id) {
		$requetePrepare = PdoLafleur::$monPdo->prepare(
			'SELECT * '
			. 'FROM produit '
			. 'WHERE id = :id'
		);
		$requetePrepare->bindParam(':id', $id, PDO::PARAM_INT);
		$requetePrepare->execute();
		$laLigne = $requetePrepare->fetch();
		return $laLigne;
	}

	public function getInfosClient($login) {
		$requetePrepare = PdoLafleur::$monPdo->prepare(
			'SELECT * '
			. 'FROM client '
			. ' WHERE login = :login'
		);
		$requetePrepare->bindParam(':login', $login, PDO::PARAM_INT);
		$requetePrepare->execute();
		return $requetePrepare->fetch();
	}
}
?>