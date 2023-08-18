<?php
// select_module.php

declare(strict_types=1);



require_once 'db.php';
require_once 'StudentenSysteem.php';

$systeem = new StudentenSysteem($db);
$modules = $systeem->getModules();
$moduleID = isset($_GET['moduleID']) ? (int) $_GET['moduleID'] : null;
$punten = $moduleID !== null ? $systeem->getPuntenPerModule($moduleID) : [];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Selecteer en Bekijk Module</title>
</head>

<body>
    <h1>Selecteer Module</h1>
    <form action="select_module.php" method="get">
        <label for="moduleID">Module:</label>
        <select name="moduleID" id="moduleID">
            <?php
            foreach ($modules as $module) {
                $selected = $module->getId() === $moduleID ? 'selected' : '';
                $value = $module->getId();
                $name = $module->getNaam();
                echo "<option value='$value' $selected>$name</option>";
            }
            ?>
        </select>
        <input type="submit" value="Bekijk Punten">
    </form>

    <?php if ($moduleID): ?>
        <h1>Punten voor Module:
            <?= $systeem->getModuleName($moduleID) ?>
        </h1>
        <?php if (!empty($punten)): ?>
            <table>
                <tr>
                    <th>Familienaam</th>
                    <th>Voornaam</th>
                    <th>Punt</th>
                </tr>
                <?php foreach ($punten as $punt): ?>
                    <tr>
                        <td>
                            <?= $punt['person']->getFamilienaam() ?>
                        </td>
                        <td>
                            <?= $punt['person']->getVoornaam() ?>
                        </td>
                        <td>
                            <?= $punt['punt'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Geen punten beschikbaar voor deze module.</p>
        <?php endif; ?>
    <?php endif; ?>

    <a href="index.php">Terug naar hoofdpagina</a>
</body>

</html>