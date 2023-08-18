# studentensysteem

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Troubleshoot Gids</title>
</head>
<body>
    <h3>Dag Adinda</h3>
    <p>Ik heb hier gekozen om de query voor de tabel 'punten' aan te maken te verwerken in de pagina create_table.php.</p>
    <p>Dit kan een aantal issues geven in mysql. Dus bij errors kan je in index.php <code>require_once 'create_table.php'</code> in commentaar zetten en manueel ingeven in mysql zelf.</p>
    <p>Ondanks het manueel ingeven kreeg ik op een gegeven moment ook een aantal problemen i.v.m met user priveleges. Na wat troubleshooten heb ik het met volgende commandos in mysql kunnen oplossen:</p>
    <pre>
DROP USER 'cursusgebruiker'@'localhost';
CREATE USER 'cursusgebruiker'@'localhost' IDENTIFIED BY 'cursuspwd';
GRANT ALL PRIVILEGES ON cursusphp.* TO 'cursusgebruiker'@'localhost';

en eventueel 

FLUSH PRIVILEGES;
    </pre>
    <p>Bij deze laatste kan de volgende foutmelding voorkomen:</p>
    <blockquote>#1030 - Fout 176 "Read page with wrong checksum" van tabel handler Aria</blockquote>
    <p> Volg in dat geval de volgende stappen:</p>
    <ol>
        <li>Stop de MySQL-Server: Sluit de MySQL-server af om te voorkomen dat er wijzigingen worden aangebracht terwijl je de tabellen controleert en herstelt.</li>
        <li>Open de Command Prompt</li>
        <li>Navigeer naar de MySQL-Bin Directory: Gebruik het cd commando om naar de directory te navigeren waar aria_chk zich bevindt, meestal in de bin map van je MySQL-installatie (bijv. C:\xampp\mysql\bin).</li>
        <li>Controleer de Integriteit van de Aria-Tabellen: Voer het volgende commando uit om de integriteit van de Aria-tabellen te controleren:
            <pre>aria_chk -c C:\xampp\mysql\data\mysql\*.MAI</pre>
        </li>
        <li>Herstel de Beschadigde Tabellen: Als er corruptie wordt gedetecteerd, voer dan het volgende commando uit om de beschadigde tabellen te herstellen:
            <pre>aria_chk -r C:\xampp\mysql\data\mysql\*.MAI</pre>
        </li>
        <li>Start de MySQL-Server opnieuw op: Nadat de tabellen zijn hersteld, start je de MySQL-server opnieuw om de wijzigingen door te voeren.</li>
    </ol>
</body>
</html>
