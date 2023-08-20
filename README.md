# studentensysteem

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Troubleshoot Gids</title>
</head>
<body>
    <h3>Dag Adinda</h3>
    <p>Ik heb hier gekozen om de query voor de tabel 'punten' aan te maken te verwerken in de pagina create_table.php. Ik weet niet of dit gebruikelijk is of niet?</p>
    <p>Dit kan een aantal issues geven in mysql. Dus bij errors kan je in index.php <code>require_once 'create_table.php'</code> in commentaar zetten en manueel ingeven in mysql zelf.</p>
    <p>Ondanks het manueel ingeven kreeg ik op een gegeven moment ook een aantal problemen i.v.m met user priveleges. Na wat troubleshooten heb ik het met volgende commandos in mysql kunnen oplossen:</p>
    <pre>
DROP USER 'cursusgebruiker'@'localhost';
CREATE USER 'cursusgebruiker'@'localhost' IDENTIFIED BY 'cursuspwd';
GRANT ALL PRIVILEGES ON cursusphp.* TO 'cursusgebruiker'@'localhost';
    </pre>
