<?php

// Person.php
declare(strict_types=1);

require_once 'DatabaseConnectionHandler.php';

class Person
{
    private $id;
    private $familienaam;
    private $voornaam;


    public function __construct(int $id, string $familienaam, string $voornaam)
    {
        $this->id = $id;
        $this->familienaam = $familienaam;
        $this->voornaam = $voornaam;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFamilienaam(): string
    {
        return $this->familienaam;
    }

    public function getVoornaam(): string
    {
        return $this->voornaam;
    }
}

class PersonService extends DatabaseConnectionHandler
{
    public function getPersonen(): array
    {
        $query = "SELECT id, familienaam, voornaam FROM personen ORDER BY familienaam ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();


        $personen = [];
        foreach ($stmt as $row) {
            $personen[] = new Person((int) $row['id'], $row['familienaam'], $row['voornaam']);
        }

        return $personen;

    }

    public function getPersoonName(int $persoonID): string
    {
        $query = "SELECT CONCAT(familienaam, ', ', voornaam) as name FROM personen WHERE id = :persoonID";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':persoonID' => $persoonID]);
        return $stmt->fetchColumn();
    }


}
