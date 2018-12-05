<?php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Campeonato.php");
require_once(__DIR__."/../model/Categoria.php");

class CampeonatoCategoriaMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save(CampeonatoCategoria $campeonatoCategoria) {

		$stmt = $this->db->prepare("INSERT INTO Campeonato_Categoria(idCampeonato, idCategoria) values (?,?)");
		$stmt->execute(array($campeonatoCategoria->getIdCampeonato(),$campeonatoCategoria->getIdCategoria()));
	}
        
        public function findByCampeonatoId($idCampeonato){
            
        $stmt = $this->db->query("SELECT idCategoria FROM Campeonato_Categoria WHERE idCampeonato = $idCampeonato");
	$categorias_db = $stmt->fetchall(PDO::FETCH_ASSOC);
        var_dump($categorias_db);die;
        return $categorias_db["idCategoria"];
        }
        
	}

