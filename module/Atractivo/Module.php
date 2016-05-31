<?php

namespace Atractivo;

// Add these import statements:
use Atractivo\Model\Atractivo;
use Atractivo\Model\AtractivoTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php',
			),
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}
	
	// Add this method:
	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'Atractivo\Model\AtractivoTable' => function($sm) {
					$tableGateway = $sm->get('AtractivoTableGateway');
					$table = new AtractivoTable($tableGateway);
					return $table;
				},
				'AtractivoTableGateway' => function ($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Atractivo());
					return new TableGateway('atractivo', $dbAdapter, null, $resultSetPrototype);
				},
			),
		);
	}

}
