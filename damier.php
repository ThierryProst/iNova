<?phprequire_once('lib/Twig/Autoloader.php');Twig_Autoloader::register();$loader = new Twig_Loader_Filesystem('tmp');$twig = new Twig_Environment($loader, array(    'cache' => false));echo $twig->render('index.twig', array(    'moteur_name' => 'Twig'));?><!-- Damier avec choix au démarrage de nbColonnes / nbLignes / couleur de départ -->
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Damier</title>
    <style media="screen" type="text/css">
        p { text-align: center;  }
        .centerTable { margin: 0px auto; }
    </style>
</head>
<body>
<h1 style="text-align: center;">Damier</h1>
<!-- Affichage du formulaire et sauvegarde des valeurs saisies -->
<form method="post" action="damier.php">
    <p>
        Nombre de colonnes : <input type="text" id="start" name="nbColonnes" value="<?php echo (isset($_POST['nbColonnes']))?$_POST['nbColonnes']:'';?>"><br />
        Nombre de lignes : <input type="text" id="start" name="nbLignes" value="<?php echo (isset($_POST['nbLignes']))?$_POST['nbLignes']:'';?>"><br /><br />
        Couleur :<br />
        <input type="radio" name="couleur" value="#FFF" id="blanc" <?php echo (isset($_POST['couleur']) AND $_POST['couleur'] == '#FFF')?'checked="checked"':'';?> /><label for="blanc"> Blanc</label><br />
        <input type="radio" name="couleur" value="#000" id="noir" <?php echo (isset($_POST['couleur']) AND $_POST['couleur'] == '#000')?'checked="checked"':'';?>" /><label for="noir"> Noir</label><br /><br />
        <input type="submit" value="Dessiner Damier"><br /><br />
    </p>
</form>
<!-- La condition vérifie si nos champs nbColonnes, nbLignes et une couleur de départ est bien sélectionnée -->
<?php if (isset($_POST['nbColonnes']) AND isset($_POST['nbLignes']) AND isset($_POST['couleur'])) {
    // Récupération des variables POST du formulaire
    $nbColonnes = $_POST['nbColonnes'];
    $nbLignes = $_POST['nbLignes'];
    $couleur = $_POST['couleur'];
    $opposite = ($couleur == '#FFF')?'#000':'#FFF';?>
    <p>
        <!-- Dessin du tableau -->
        <table class="centerTable" border="1">
            <?php for ($i = 0; $i < $nbLignes; $i++) { // Boucle en fonction de nbLignes
                ?><tr>
                    <?php for ($y = 0; $y < $nbColonnes; $y++) { // Boucle en fonction de nbColonnes
                    /* Affichage de cellulle avec définition de la couleur de fond en fonction des paramètres saisies.
                    /* On vérifie ici une condition ternaire imbriquée avec 2 modulos pour savoir sur quelle case et sur
                    /* quelle ligne on se trouve et ainsi saisir la bonne couleur de fond en fonction de la couleur de départ */
                        ?><td style="background:
                            <?php echo ($y % 2 == 0 AND $i % 2 == 0)?$couleur:(($y % 2 == 1 AND $i % 2 == 1)?$couleur:$opposite);?>;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td><?php
                    } ?>
                </tr><?php
            } ?>
        </table>
    </p><?php
}
else
{
    // ... si une ou plusieurs variables n'ont pas été définies ...
    echo '<p>Vous devez d&eacute;finir un nombre de colonnes, de lignes et une couleur de d&eacute;part.</p>';
}?>
</body>
</html>