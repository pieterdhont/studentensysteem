<?php
//Punten.php

declare(strict_types=1);

class Punten
{
    private $moduleID;
    private $persoonID;
    private $punt;

    public function __construct(int $moduleID, int $persoonID, int $punt)
    {
        $this->moduleID = $moduleID;
        $this->persoonID = $persoonID;
        $this->punt = $punt;
    }

    public function getModuleID(): int
    {
        return $this->moduleID;
    }

    public function getPersoonID(): int
    {
        return $this->persoonID;
    }

    public function getPunt(): int
    {
        return $this->punt;
    }
}

class PuntenService
{
    private const MIN_PUNT = 0;
    private const MAX_PUNT = 100;

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function voegPuntToe(int $moduleID, int $persoonID, int $punt): string
    {
        if ($punt > self::MAX_PUNT || $punt < self::MIN_PUNT) {
            return "Punt moet tussen " . self::MIN_PUNT . " en " . self::MAX_PUNT . " liggen";
        }

        $query = "SELECT * FROM punten WHERE moduleID = :moduleID AND persoonID = :persoonID";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':moduleID' => $moduleID, ':persoonID' => $persoonID]);
        if ($stmt->fetch()) {
            return "Punt voor deze combinatie is al ingegeven.";
        }

        $query = "INSERT INTO punten (moduleID, persoonID, punt) VALUES (:moduleID, :persoonID, :punt)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':moduleID' => $moduleID,
            ':persoonID' => $persoonID,
            ':punt' => $punt
        ]);

        return "Punt toegevoegd.";
    }

    public function getPuntenPerModule(int $moduleID): array
    {
        $query = "
            SELECT p.moduleID, p.persoonID, p.punt, per.id AS person_id, per.familienaam, per.voornaam 
            FROM punten p
            JOIN personen per ON p.persoonID = per.id
            WHERE p.moduleID = :moduleID";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':moduleID' => $moduleID]);

       $punten = [];
        foreach ($stmt as $row) {
            $person = new Person($row['person_id'], $row['familienaam'], $row['voornaam']);
            $punt = new Punten((int) $row['moduleID'], (int) $row['persoonID'], (int) $row['punt']);
            $punten[] = ['punt' => $punt, 'person' => $person];
        }

        return $punten;
    }

    public function getPuntenPerPersoon(int $persoonID): array
    {
        $query = "
            SELECT p.moduleID, p.persoonID, p.punt, m.id AS module_id, m.naam AS module_naam
            FROM punten p
            JOIN modules m ON p.moduleID = m.id
            WHERE p.persoonID = :persoonID";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':persoonID' => $persoonID]);

        $punten = [];
        foreach ($stmt as $row) {
            $module = new Module($row['module_id'], $row['module_naam']);
            $punt = new Punten((int) $row['moduleID'], (int) $row['persoonID'], (int) $row['punt']);
            $punten[] = ['punt' => $punt, 'module' => $module];
        }

        return $punten;
    }
}
 
