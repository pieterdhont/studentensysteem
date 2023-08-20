<?php

// Module.php
declare(strict_types=1);

class Module
{
    private $id;
    private $naam;

    public function __construct(int $id, string $naam)
    {
        $this->id = $id;
        $this->naam = $naam;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }
}

class ModuleService
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getModules(): array
    {
        $query = "SELECT id, naam FROM modules ORDER BY naam ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $modules = [];
        foreach ($stmt as $row) {
            $module = new Module((int) $row['id'], $row['naam']);
            $modules[] = $module;
        }

        return $modules;
    }

    public function getModuleName(int $moduleID): string
    {
        $query = "SELECT naam FROM modules WHERE id = :moduleID";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':moduleID' => $moduleID]);
        return $stmt->fetchColumn();
    }
}
