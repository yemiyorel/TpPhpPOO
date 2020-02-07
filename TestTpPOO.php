<?php
function chargerClasse($classe)
{
  require $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse');

$db = new PDO('mysql:host=localhost;dbname=POO;charset=utf8', 'root', 'root');
$request = $db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages');
    
while ($donnees = $request->fetch(PDO::FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array.
{
    $perso = new Personnage($donnees);
    echo $perso->nom(), ' a ', $perso->forcePerso(), ' de force, ', $perso->degats(), ' de dégâts, ', $perso->experience(), ' d\'expérience et est au niveau ', $perso->niveau(), '. ';
}

$perso = new Personnage([
    'nom' => 'Victor',
    'forcePerso' => 5,
    'degats' => 0,
    'niveau' => 1,
    'experience' => 0
]);
$manager = new PersonnagesManager($db);
$manager->add($perso);
$manager->getlist();
echo "<pre>";
    print_r($perso);
echo "</pre>";

