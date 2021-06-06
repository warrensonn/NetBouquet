<?php
/** Vue liste des catégories de produits.
 *  -------
 *  @file
 *  @brief L'utilisateur peut saisir la catégorie de produits dans la liste proposée
 * 
 *  @category  PPE
 *  @package   NetBouquet
 *  @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 *  @version   GIT: <0>
 */
$title = "v_categories.php";
?>

<ul id="categories">
<?php
foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie['id'];
	$libCategorie = $uneCategorie['libelle'];
	?>
	<li>
		<a href=index.php?uc=voirProduits&categorie=<?php echo $idCategorie ?>&action=voirProduits><?php echo $libCategorie ?></a>
	</li>
<?php
} ?>
	<li>
		<a href=index.php?uc=voirProduits&action=voirProduits>Tous</a>
	</li>
</ul>