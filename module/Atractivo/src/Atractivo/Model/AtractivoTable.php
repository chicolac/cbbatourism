<?php

namespace Atractivo\Model;

use Zend\Db\TableGateway\TableGateway;

class AtractivoTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getAtractivo($cod_at)
	{
		$cod_at = (int) $cod_at;
		$rowset = $this->tableGateway->select(array('cod_at' => $cod_at));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("No hay registros asociados a valor $cod_at");
		}
	
		return $row;

	}

	public function saveAtractivo(Atractivo $atractivo)
	{
		$data = array(
			'nombre_at' => $atractivo->nombre_at,
			'descripcion' => $atractivo->descripcion,
			'fotos' => $atractivo->fotos,
			'coordenadas' => $atractivo->coordenadas,
			'direc_foto' => $atractivo->direc_foto,
		);

		$cod_at = (int) $atractivo->cod_at;
		if ($cod_at == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getAtractivo($cod_at)) {
				$this->tableGateway->update($data, array('cod_at' => $cod_at));
			} else {
				throw new \Exception('Atractivo cod_at does not exist');
			}
		}

	}

	public function deleteAtractivo($cod_at)
	{
		$this->tableGateway->delete(array('cod_at' => (int) $cod_at));
	}

}

