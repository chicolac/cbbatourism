<?php

namespace Atractivo\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Atractivo
{
	public $cod_at;
	public $nombre_at;
	public $descripcion;
	public $fotos;
	public $coordenadas;
	public $direc_foto;

	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->cod_at = (!empty($data['cod_at'])) ? $data['cod_at'] : null;
		$this->nombre_at = (!empty($data['nombre_at'])) ? $data['nombre_at'] : null;
		$this->descripcion = (!empty($data['descripcion'])) ? $data['descripcion'] : null;
		$this->fotos = (!empty($data['fotos'])) ? $data['fotos'] : null;
		$this->coordenadas = (!empty($data['coordenadas'])) ? $data['coordenadas'] : null;
		$this->direc_foto = (!empty($data['direc_foto'])) ? $data['direc_foto'] : null;
	}

	// Add the following method:
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

	// Add content to these methods:
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}

	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();

			$inputFilter->add(array(
				'name' => 'cod_at',
				'required' => true,
				'filters' => array(
					array('name' => 'Int'),
				),

			));

			$inputFilter->add(array(
				'name' => 'nombre_at',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 100,
						),
					),
				),
			));

			$inputFilter->add(array(
				'name' => 'descripcion',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 2000,
						),
					),
				),
			));

			$inputFilter->add(array(
				'name' => 'fotos',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 100,
						),
					),
				),
			));

			$inputFilter->add(array(
				'name' => 'coordenadas',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 100,
						),
					),
				),
			));

			$inputFilter->add(array(
				'name' => 'direc_foto',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 100,
						),
					),
				),
			));

			$this->inputFilter = $inputFilter;

		}

		return $this->inputFilter;

	}
}

