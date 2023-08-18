<?php
//voeg_punt_toe.php 
                

declare(strict_types=1);

require_once 'db.php';
require_once 'StudentenSysteem.php';

$systeem = new StudentenSysteem($db);
$message = '';
$selectedModuleID = $selectedPersoonID = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedModuleID = (int)$_POST['moduleID'];
    $selectedPersoonID = (int)$_POST['persoonID'];
    $punt = (int)$_POST['punt'];
    $message = $systeem->voegPuntToe($selectedModuleID, $selectedPersoonID, $punt);
}

$modules = $systeem->getModules();
$personen = $systeem->getPersonen();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Punten Ingeven</title>
</head>
<body>
    <h1>Punten Ingeven</h1>
    <form action="" method="post">
        <label for="moduleID">Module:</label>
        <select name="moduleID" id="moduleID">
            <?php
            foreach ($modules as $module) {
                $selected = $selectedModuleID === $module->getId() ? 'selected' : '';
                $value = $module->getId();
                $name = $module->getNaam();
                echo "<option value='$value' $selected>$name</option>";
            }
            ?>
        </select>
        <label for="persoonID">Persoon:</label>
        <select name="persoonID" id="persoonID">
            <?php
            foreach ($personen as $persoon) {
                $selected = $selectedPersoonID === $persoon->getId() ? 'selected' : '';
                $value = $persoon->getId();
                $name = $persoon->getFamilienaam() . ', ' . $persoon->getVoornaam();
                echo "<option value='$value' $selected>$name</option>";
            }
            ?>
        </select>
        <label for="punt">Punt:</label>
        <input type="number" name="punt" id="punt" required>
        <input type="submit" value="Voeg Punt Toe">
    </form>
    <p><?= $message ?></p>
    <a href="index.php">Terug naar hoofdpagina</a>
</body>
</html>
