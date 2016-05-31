<?php

return array(
	'controllers' => array(
		'invokables' => array(
			'Atractivo\Controller\Atractivo' => 'Atractivo\Controller\AtractivoController',
			'Atractivo\Controller\Cambio' => 'Atractivo\Controller\CambioController'
		),
	),

	// The following section is new and should be added to your file
	'router' => array(
		'routes' => array(
			'atractivo' => array(
				'type' => 'segment',
				'options' => array(
//					'route' => '/[:controller[/:action[/:id]]]',
					'route' => '/atractivo[/:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Atractivo\Controller\Atractivo',
						'action' => 'index',
					),

				),

			),

		),

	),

	'view_manager' => array(
		'template_map' => array(
//			'layout/layout' => __DIR__ . '/../view/layout/lista.phtml',
			'layout/lista' 						=> __DIR__ . '/../view/layout/lista.phtml',
            'layout/atractivo'        			=> __DIR__ . '/../view/layout/atractivol.phtml',
			'complemento/cabecera'				=> __DIR__ . '/../view/complemento/cabecera.phtml',
			'complemento/pie' 					=> __DIR__ . '/../view/complemento/pie.phtml',
			'complemento/topbar' 				=> __DIR__ . '/../view/complemento/topbar.phtml',
			'complemento/navegacionat'  		=> __DIR__ . '/../view/complemento/navegacionat.phtml',
			'complemento/cejat' 				=> __DIR__ . '/../view/complemento/cejat.phtml',
			'complemento/ventanat' 				=> __DIR__ . '/../view/complemento/ventanat.phtml',
			'complemento/primeraimpresion'  	=> __DIR__ . '/../view/complemento/primeraimpresion.phtml',
			'complemento/segundaimpresion' 		=> __DIR__ . '/../view/complemento/segundaimpresion.phtml',
			'complemento/mevoy' 				=> __DIR__ . '/../view/complemento/mevoy.phtml',
		),
		'template_path_stack' => array(
			'atractivo' => __DIR__ . '/../view',
		),
	),
);
