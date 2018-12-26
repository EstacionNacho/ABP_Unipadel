<?php
// file: model/CategoriaMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Categoria.php");
/**
 * Class CampeonatoMapper
 *
 */
class CategoriaMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  public function save(Categoria $categoria) {
    $stmt = $this->db->prepare("INSERT INTO Categoria(nivel, tipo, maxParticipantes) values (?,?,?)");
    $stmt->execute(array($categoria->getNivel(), $categoria->getTipo(), $categoria->getMaxParticipantes()));
    return $this->db->lastInsertId();
  }

    public function findById($idCategorias) {
        
        $categoria = NULL;
        
        foreach ($idCategorias as $idCategoria) {

            $stmt = $this->db->prepare("SELECT * FROM Categoria WHERE idCategoria = $idCategoria[idCategoria]");
            $stmt->execute();
            $categoria[$idCategoria["idCategoria"]] = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $categoria;
    }
    
    public function findCategoria($idCategoria,$nivel,$tipo){
    
        $stmt = $this->db->prepare("SELECT * FROM Categoria WHERE idCategoria = $idCategoria AND nivel = $nivel AND tipo = '$tipo' ");
            
        $stmt->execute();
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

        return $categoria;
    }
    
}
