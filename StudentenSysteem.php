<?php
// Studentensysteem.php

declare(strict_types=1);

require_once 'db.php';
require_once 'Module.php';
require_once 'Person.php';
require_once 'Punten.php';

class StudentenSysteem
{
    private $db;
    private $puntenService;
    private $moduleService;
    private $personService;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->puntenService = new PuntenService($db);
        $this->moduleService = new ModuleService($db);
        $this->personService = new PersonService($db);
    }

    public function __destruct()
    {
        $this->db = null;
    }

    public function voegPuntToe(int $moduleID, int $persoonID, int $punt): string
    {
        return $this->puntenService->voegPuntToe($moduleID, $persoonID, $punt);
    }

    public function getModules(): array
    {
        return $this->moduleService->getModules();
    }

    public function getModuleName(int $moduleID): string
    {
        return $this->moduleService->getModuleName($moduleID);
    }

    public function getPersonen(): array
    {
        return $this->personService->getPersonen();
    }

    public function getPersoonName(int $persoonID): string
    {
        return $this->personService->getPersoonName($persoonID);
    }

    public function getPuntenPerModule(int $moduleID): array
    {
        return $this->puntenService->getPuntenPerModule($moduleID);
    }

    public function getPuntenPerPersoon(int $persoonID): array
    {
        return $this->puntenService->getPuntenPerPersoon($persoonID);
    }

    
    
}
