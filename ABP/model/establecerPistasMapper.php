<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/UsuarioRegistrado.php");
require_once(__DIR__."/../model/establecerPistas.php");

/**

* @author Victor
*/
class establecerPistasMapper {

	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function insertarPista(establecerPistas $pista) {

		$stmt = $this->db->prepare("INSERT INTO Pista (idPista) VALUES (?)");
		$stmt->execute(array($pista->getIdPista()));
		return $this->db->lastInsertId();
	}
	public function insertarHorario(establecerPistas $horario) {

		$stmt = $this->db->prepare("INSERT INTO Horario (horario,idPista,disponibilidad,fecha) VALUES (?,?,?,?)");
		$stmt->execute(array($horario->getHora(),$horario->getHorarioIdPista(),$horario->getDisponibilidad(),$horario->getFecha()));
		return $this->db->lastInsertId();
	}

        public function findAll(){
            
        $stmt = $this->db->query("SELECT * FROM Horario");
        $stmt->execute();
        $horarios_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $horarios = array();

        foreach ($horarios_db as $horario) {
            array_push($horarios, new Horario($horario["fecha"], $horario["idPista"], $horario["horario"], $horario["disponibilidad"]));
        }

        return $horarios;
        }
}
