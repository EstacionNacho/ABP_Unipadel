<?php

require_once(__DIR__ . "/../model/Campeonato.php");
require_once(__DIR__ . "/../model/CampeonatoMapper.php");
require_once(__DIR__ . "/../model/Categoria.php");
require_once(__DIR__ . "/../model/CategoriaMapper.php");
require_once(__DIR__ . "/../model/CampeonatoCategoria.php");
require_once(__DIR__ . "/../model/CampeonatoCategoriaMapper.php");

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class CampeonatoController extends BaseController {

    private $campeonatoMapper;
    private $categoriaMapper;
    private $campeonatoCategoriaMapper;

    public function __construct() {
        parent::__construct();

        $this->campeonatoMapper = new CampeonatoMapper();
        $this->categoriaMapper = new CategoriaMapper();
        $this->campeonatoCategoriaMapper = new campeonatoCategoriaMapper();
    }

    public function index() {
        if (!isset($this->currentUser)) {
            $this->view->render("usuarios", "login");
        } else {
            //if($this->currentUser->getTipo()!='admin'){
            //$errors = array();
            //$errors["general"] = "Usuario no valido para crear campeonatos";
            //$this->view->setVariable("errors", $errors);
            //$this->view->redirect("home", "index");
            //}
            $campeonatos = $this->campeonatoMapper->findAll();
            $this->view->setVariable("campeonatos", $campeonatos, false);
            $this->view->render("campeonato", "index");
        }
    }

    public function add() {

        function creacionCategoria($idCampeonato, $tipoCategoria, $nivel) {

            $categoria = new Categoria();
            $categoriaMapper = new CategoriaMapper();
            $campeonatoCategoria = new CampeonatoCategoria();
            $campeonatoCategoriaMapper = new CampeonatoCategoriaMapper();

            $categoria->setTipo($tipoCategoria);
            $categoria->setNivel($nivel);
            $categoria->setMaxParticipantes($_POST["maxParticipantes"]);
            
            try {

                $categoria->checkIsValidForCreate();
                $idCategoria = $categoriaMapper->save($categoria);
                
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }

            $campeonatoCategoria->setIdCampeonato($idCampeonato);
            $campeonatoCategoria->setIdCategoria($idCategoria);

            try {
                
                $campeonatoCategoria->checkIsValidForCreate();
                $campeonatoCategoriaMapper->save($campeonatoCategoria);
                
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $campeonato = new Campeonato();

        if (isset($_POST["nombreCampeonato"])) {

            $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
            $campeonato->setFechaInicio($_POST["fechaInicio"]);
            $campeonato->setFechaFin($_POST["fechaFin"]);
            $campeonato->setInicioInscripcion($_POST["inicioInscripcion"]);
            $campeonato->setFinInscripcion($_POST["finInscripcion"]);
            $campeonato->setReglas($_POST["reglas"]);

            try {

                $campeonato->checkIsValidForCreate();
                $idcam = $this->campeonatoMapper->save($campeonato);

                if (isset($_POST["masculina"])) {

                    $tipoCategoria = $_POST["masculina"];

                    if (isset($_POST["nivelMAS1"])) {

                        $nivel = $_POST["nivelMAS1"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMAS2"])) {

                        $nivel = $_POST["nivelMAS2"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMAS3"])) {

                        $nivel = $_POST["nivelMAS3"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                }
                if (isset($_POST["femenina"])) {
                    
                    $tipoCategoria = $_POST["femenina"];
                    
                    if (isset($_POST["nivelFEM1"])) {

                        $nivel = $_POST["nivelFEM1"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelFEM2"])) {

                        $nivel = $_POST["nivelFEM2"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelFEM3"])) {

                        $nivel = $_POST["nivelFEM3"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                }
                if (isset($_POST["mixta"])) {
                    
                    $tipoCategoria = $_POST["mixta"];
                    
                    if (isset($_POST["nivelMIX1"])) {

                        $nivel = $_POST["nivelMIX1"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMIX2"])) {

                        $nivel = $_POST["nivelMIX2"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMIX3"])) {

                        $nivel = $_POST["nivelMIX3"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                }
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
            $campeonatos = $this->campeonatoMapper->findAll();
            $this->view->setVariable("campeonatos", $campeonatos, false);
            $this->view->render("campeonato", "index");

    }

    public function view() {
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("Necesario un identificador de campeonato");
        }

        $idCampeonato = $_REQUEST["id"];

        if ($idCampeonato == NULL) {
            throw new Exception("No se han realizado campeonatos");
        }
        
        $campeonato = $this->campeonatoMapper->findById($idCampeonato);
        $idCategorias = $this->campeonatoCategoriaMapper->findByCampeonatoId($idCampeonato);
        $categoria = $this->categoriaMapper->findById($idCategorias);
        
	$this->view->setVariable("campeonato", $campeonato, false);
	$this->view->setVariable("categoria", $categoria, false);

	$this->view->render("campeonato", "view");
        
    }

}
