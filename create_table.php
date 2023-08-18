<?php
//create_table.php
declare(strict_types=1);

require_once 'db.php';



$query = "
CREATE TABLE IF NOT EXISTS punten (
    moduleID int(10) unsigned NOT NULL,
    persoonID int(10) unsigned NOT NULL,
    punt INT,
    PRIMARY KEY (moduleID, persoonID),
    FOREIGN KEY (moduleID) REFERENCES modules(id),
    FOREIGN KEY (persoonID) REFERENCES personen(id)
)";

$db->exec($query);
?>