<?php

namespace Atractivo\Form;

use Zend\Form\Form;

class AtractivoForm extends Form
{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('atractivo');

		$this->add(array(
			'name' => 'cod_at',
			'type' => 'Hidden',
		));
		$this->add(array(
			'name' => 'nombre_at',
			'type' => 'Text',
			'options' => array(
				'label' => 'El nombre del atractivo turístico',
			),
		));
		$this->add(array(
			'name' => 'descripcion',
			'type' => 'Text',
			'options' => array(
				'label' => 'La descripción',
			),
		));
		$this->add(array(
			'name' => 'fotos',
			'type' => 'Text',
			'options' => array(
				'label' => 'Cantidad de imágenes',
			),
		));
		$this->add(array(
			'name' => 'coordenadas',
			'type' => 'Text',
			'options' => array(
				'label' => 'La coordenada',
			),
		));
		$this->add(array(
			'name' => 'direc_foto',
			'type' => 'Text',
			'options' => array(
				'label' => 'Ingresar la dirección de la imagen',
			),
		));

		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'Ay vamos',
				'id' => 'submitbutton',
			),

		));

	}

}
