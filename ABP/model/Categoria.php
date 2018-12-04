<?php

require_once(__DIR__."/../core/ValidationException.php");

class Categoria {

	private $idCategoria;
	private $nivel;
	private $tipo;
	private $maxParticipantes;

	public function __construct($idCategoria=NULL, $nivel=NULL, $tipo=NULL, $maxParticipantes=NULL) {
		$this->idCategoria = $idCategoria;
		$this->nivel = $nivel;
		$this->tipo = $tipo;
		$this->maxParticipantes = $maxParticipantes;
	}

	public function getIdCategoria() {
		return $this->idCategoria;
	}

	public function getNivel() {
		return $this->nivel;
	}


	public function getTipo() {
		return $this->tipo;
	}

	public function getMaxParticipantes() {
		return $this->maxParticipantes;
	}

	public function setIdCategoria($idCategoria) {
			$this->idCategoria = $idCategoria;
	}

	public function setNivel($nivel) {
			$this->nivel = $nivel;
	}

	public function setTipo($tipo) {
			$this->tipo = $tipo;
	}

        public function setMaxParticipantes($maxParticipantes) {
		$this->maxParticipantes = $maxParticipantes;
	}
	/**
	* Checks if the current user instance is valid
	* for being registered in the database
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->usuario) < 3) {
			$errors["usuario"] = "Username must be at least 3 characters length";

		}
		if (strlen($this->password) < 3) {
			$errors["password"] = "Password must be at least 3 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}
        
        public function checkIsValidForCreate() {
		$errors = array();
                        
			if ($this->nivel == NULL) {
					$errors["nivel"] = "Nivel de categoria no encontrado";
			}
			if ($this->tipo == NULL) {
					$errors["tipo"] = "Tipo de categoria no encontrado";
			}
			if (sizeof($errors) > 0) {
					throw new ValidationException($errors, "Creacion de categoria no valida");
			}
	}
}
