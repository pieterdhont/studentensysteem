<?php
//select_persoon.php

declare(strict_types=1);




require_once 'StudentenSysteem.php';

$systeem = new StudentenSysteem($db);
$personen = $systeem->getPersonen();
$persoonID = isset($_GET['persoonID']) ? (int) $_GET['persoonID'] : null;
$punten = $persoonID !== null ? $systeem->getPuntenPerPersoon($persoonID) : [];

?>
<!DOCTYPE html>
<html>

<head>
    <title>Selecteer en Bekijk Punten per Persoon</title>
</head>

<body>
    <h1>Selecteer Persoon</h1>
    <form action="select_persoon.php" method="get">
    <label for="persoonID">Persoon:</label>
    <select name="persoonID" id="persoonID">
        <?php
        foreach ($personen as $persoon) {
            $selected = (isset($persoonID) && $persoon->getId() == $persoonID) ? 'selected' : '';
            $value = $persoon->getId();
            $name = $persoon->getFamilienaam() . ', ' . $persoon->getVoornaam();
            echo "<option value='$value' $selected>$name</option>";
        }
        ?>
    </select>
    <input type="submit" value="Bekijk Punten">
</form>

<?php if (isset($persoonID)): ?>
        <h1>Punten voor Persoon:
            <?= $systeem->getPersoonName($persoonID) ?>
        </h1>
        <?php if (!empty($punten)): ?>
            <table>
                <tr>
                    <th>Module</th>
                    <th>Punt</th>
                </tr>
                <?php foreach ($punten as $punt): ?>
                    <tr>
                        <td>
                            <?= $punt['module']->getNaam() ?>
                        </td>
                        <td>
                            <?= $punt['punt']->getPunt() ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Geen punten beschikbaar voor deze persoon.</p>
        <?php endif; ?>
    <?php endif; ?>
    <a href="index.php">Terug naar hoofdpagina</a>
</body>

</html>
