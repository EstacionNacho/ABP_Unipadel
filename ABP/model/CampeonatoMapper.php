<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

require_once(__DIR__ . "/../model/Campeonato.php");
require_once(__DIR__ . "/../model/Categoria.php");

class CampeonatoMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function findAll() {

        $stmt = $this->db->query("SELECT * FROM Campeonato");
        $stmt->execute();
        $campeonatos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $campeonatos = array();

        foreach ($campeonatos_db as $campeonato) {
            array_push($campeonatos, new Campeonato($campeonato["idCampeonato"], $campeonato["nombre"], $campeonato["fechaInicio"], $campeonato["fechaFin"], $campeonato["inicioInscripcion"], $campeonato["finInscripcion"], NULL));
        }

        return $campeonatos;
    }

    public function findById($idCampeonato) {

        $stmt = $this->db->prepare("SELECT * FROM Campeonato WHERE idCampeonato = $idCampeonato");
        $stmt->execute();
        $campeonato = $stmt->fetch(PDO::FETCH_ASSOC);

        return $campeonato;
    }

    public function save(Campeonato $campeonato) {

        $stmt = $this->db->prepare("INSERT INTO Campeonato(nombre, fechaInicio, fechaFin, inicioInscripcion, finInscripcion, reglas) values (?,?,?,?,?,?)");
        $stmt->execute(array($campeonato->getNombreCampeonato(), $campeonato->getFechaInicio(), $campeonato->getFechaFin(), $campeonato->getInicioInscripcion(), $campeonato->getFinInscripcion(), $campeonato->getReglas()));
        return $this->db->lastInsertId();
    }
    
    public function update(Campeonato $campeonato){
        
        $idCampeonato = $campeonato->getIdCampeonato();

        $stmt = $this->db->prepare("UPDATE Campeonato SET nombre = ?,fechaInicio = ?,fechaFin = ?,inicioInscripcion = ?,finInscripcion = ?,reglas = ? WHERE idCampeonato=$idCampeonato");
        $stmt->execute(array($campeonato->getNombreCampeonato(), $campeonato->getFechaInicio(), $campeonato->getFechaFin(), $campeonato->getInicioInscripcion(), $campeonato->getFinInscripcion(), $campeonato->getReglas()));
    }
    
    public function delete($idCampeonato){ 
        
        $stmt = $this->db->prepare("DELETE FROM Campeonato WHERE idCampeonato = $idCampeonato");
        $stmt->execute();
    }

}
