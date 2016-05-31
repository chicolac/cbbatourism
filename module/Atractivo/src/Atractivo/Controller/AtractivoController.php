<?php

namespace Atractivo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Atractivo\Model\Atractivo;		// <-- Add this import
use Atractivo\Form\AtractivoForm;

class AtractivoController extends AbstractActionController
{
	protected $atractivoTable;

	public function indexAction()
	{
		$view = new ViewModel(array(
			'atractivos' => $this->getAtractivoTable()->fetchAll(),
		));

		$this->layout('layout/lista');
		$this->layout()->saludo = "hola soy el parámetroooo";
		$this->layout()->title = "mi nuevo layout";

		return $view;
	}

	public function listaAction()
	{
		$view = new ViewModel(array(
			'atractivos' => $this->getAtractivoTable()->fetchAll(),
		));

		$this->layout('layout/lista');
		$this->layout()->saludo = "hola soy el parámetroooo";
		$this->layout()->title = "mi nuevo layout";

		// Get the "layout" view model and inject a cabecera
        $layout = $this->layout();

        $cabeceraView = new ViewModel();
        $cabeceraView->setTemplate('complemento/cabecera');

        $pieView = new ViewModel();
        $pieView->setTemplate('complemento/pie');

		$topbarView = new ViewModel();
        $topbarView->setTemplate('complemento/topbar');

        $layout->addChild($cabeceraView, 'cabecera')
			   ->addChild($pieView, 'pie')
			   ->addChild($topbarView, 'topbar');

		/*$topbarView = new ViewModel();
        $topbarView->setTemplate('complemento/topbar');

        $view->addChild($topbarView, 'topbar');*/

		return $view;
	}

	public function atractivoAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);

		$view = new ViewModel();

		$this->layout('layout/atractivo');
		/*$this->layout()->saludo = "hola soy el parámetroooo";
		$this->layout()->title = "mi nuevo layout";*/

		// Get the "layout" view model and inject a cabecera
        $layout = $this->layout();

        $cabeceraView = new ViewModel();
        $cabeceraView->setTemplate('complemento/cabecera');

        $layout->addChild($cabeceraView, 'cabecera');

		$navegacionatView = new ViewModel();
        $navegacionatView->setTemplate('complemento/navegacionat');

        $cejatView = new ViewModel();
        $cejatView->setTemplate('complemento/cejat');

		$ventanatView = new ViewModel(array(
			"titulo"	=>	"Mostrando detalle del atractivo",
			'atractivos' => $this->getAtractivoTable()->getAtractivo($id),
		));

        $ventanatView->setTemplate('complemento/ventanat');

		$primeraimpresionView = new ViewModel();
        $primeraimpresionView->setTemplate('complemento/primeraimpresion');

        $segundaimpresionView = new ViewModel();
        $segundaimpresionView->setTemplate('complemento/segundaimpresion');

		$mevoyView = new ViewModel();
        $mevoyView->setTemplate('complemento/mevoy');

		$pieView = new ViewModel();
        $pieView->setTemplate('complemento/pie');

		$puertatView = new ViewModel();
        $puertatView->setTemplate('complemento/puertat');

        $puertatView->addChild($primeraimpresionView, 'primeraimpresion')
					->addChild($segundaimpresionView, 'segundaimpresion');

        $view->addChild($navegacionatView, 'navegacionat')
			   ->addChild($cejatView, 'cejat')
			   ->addChild($ventanatView, 'ventanat')
			   ->addChild($puertatView, 'puertat')
			   ->addChild($pieView, 'pie')
			   ->addChild($mevoyView, 'mevoy');

		return $view;
	}

	public function addAction()
	{
		$form = new AtractivoForm();
		$form->get('submit')->setValue('Nuevo atractivo');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$atractivo = new Atractivo();
			$form->setInputFilter($atractivo->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$atractivo->exchangeArray($form->getData());
				$this->getAtractivoTable()->saveAtractivo($atractivo);

				// Redirect to list of atractivos
				//return $this->redirect()->toRoute('atractivo');

				return $this->redirect()->toRoute('atractivo',
				  array('controller'=> 'atractivo',
						'action' => 'lista',
						));
			}
		}

		return array('form' => $form);
	}

	public function nuevoatAction()
	{
		$form = new AtractivoForm();
		$form->get('submit')->setValue('Nuevo atractivo');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$atractivo = new Atractivo();
			$form->setInputFilter($atractivo->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$atractivo->exchangeArray($form->getData());
				$this->getAtractivoTable()->saveAtractivo($atractivo);

				// Redirect to list of atractivos
				//return $this->redirect()->toRoute('atractivo');

				return $this->redirect()->toRoute('atractivo',
				  array('controller'=> 'atractivo',
						'action' => 'lista',
						));
			}
		}

		return array('form' => $form);
	}

	public function editAction()
	{
		$cod_at = (int) $this->params()->fromRoute('id', 0);

		if (!$cod_at) {
			return $this->redirect()->toRoute('atractivo', array(
				'action' => 'add'
			));
		}

		// Get the Atractivo with the specified id. An exception is thrown
		// if it cannot be found, in which case go to the index page.
		try {
			$atractivo = $this->getAtractivoTable()->getAtractivo($cod_at);
		}
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('atractivo', array(
				'action' => 'index'
			));
		}

		$form = new AtractivoForm();
		$form->bind($atractivo);
		$form->get('submit')->setAttribute('value', 'Edit');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($atractivo->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$this->getAtractivoTable()->saveAtractivo($atractivo);

				// Redirect to list of albums
				return $this->redirect()->toRoute('atractivo');

			}

		}

		return array(
			'cod_at' => $cod_at,
			'form' => $form,
		);
	}

// module/Atractivo/src/Atractivo/Controller/AtractivoController.php:
//...
// Add content to the following method:
	public function deleteAction()
	{
		$cod_at = (int) $this->params()->fromRoute('id', 0);
		if (!$cod_at) {
			return $this->redirect()->toRoute('atractivo');
		}

		$request = $this->getRequest();
		
		if ($request->isPost()) {
			$del = $request->getPost('del', 'No');

			if ($del == 'Yes') {
				$cod_at = (int) $request->getPost('cod_at');

				$this->getAtractivoTable()->deleteAtractivo($cod_at);

			}

			// Redirect to list of albums
			return $this->redirect()->toRoute('atractivo');

		}

		return array(
			'cod_at' => $cod_at,
			'atractivo' => $this->getAtractivoTable()->getAtractivo($cod_at)
		);

	}
	//...
	public function verAction()
	{
		//$this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
		//$u = new Usuarios( $this->dbAdapter );
		$id = (int) $this->params()->fromRoute('id', 0);

		$valores = array
		(
			"titulo"	=>	"Mostrando detalle del atractivo",
//			'datos'		=>	$u->getUsuarioPorId($id)
			'atractivos' => $this->getAtractivoTable()->getAtractivo($id),
		);

        return new ViewModel($valores);
	}

	public function getAtractivoTable()
	{
		if (!$this->atractivoTable) {
			$sm = $this->getServiceLocator();
			$this->atractivoTable = $sm->get('Atractivo\Model\AtractivoTable');
		}
		
		return $this->atractivoTable;

	}
}
