<?php
try {

    $bdd = new PDO ('mysql:host=localhost;dbname=auto-emarge', 'root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(EXception $e) {

    die('ERREUR : '. $e->getMessage());
}

// SELECT
global $bdd;

$reponse = $bdd->query('SELECT Debut,Fin FROM annee WHERE Identifiant = 1');

while($donnees = $reponse->fetch()) {


    $debut = $donnees['Debut'];


    $fin = $donnees['Fin'];


}
$reponse->closeCursor();
$mois = date('M');
$reponse = $bdd->query('SELECT COUNT(*) AS nbemargement FROM emargement WHERE  mois=\'' . $mois . '\' AND AnneeDebut=\'' . $debut . '\' AND  AnneeFin=\'' . $fin . '\'');

while($donnees = $reponse->fetch()) {

    echo $donnees['nbemargement'];

}
$reponse->closeCursor();

// UPDATE
$options = [
    'cost' => 12,
];

$hashpass = password_hash($_POST['motpasse'], PASSWORD_BCRYPT, $options);

$NOM2 = $_POST['nom2'];
$PRENOM2 = $_POST['prenom2'];
$ROLE2 = $_POST['role2'];

$req = $bdd->prepare ('UPDATE administration SET Nom = :Nom, Prenom = :Prenom, Roles = :Roles, Mot_de_passe = :Mot_de_passe WHERE idAdministration = \''.$_POST['identifiant2'].'\'');

$req->execute([

    'Nom' => $NOM2,
    'Prenom' => $PRENOM2,
    'Roles' => $ROLE2,
    'Mot_de_passe' => $hashpass

]);
