<?php

namespace Atractivo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CambioController extends AbstractActionController
{
    public function viewAction()
    {
        // get the article from the persistence layer, etc...

        $view = new ViewModel();

        // this is not needed since it matches "module/controller/action"
        $view->setTemplate('atractivo/cambio/view');
/*
        $articleView = new ViewModel(array('article' => $article));
        $articleView->setTemplate('content/article');

        $primarySidebarView = new ViewModel();
        $primarySidebarView->setTemplate('content/main-sidebar');

        $secondarySidebarView = new ViewModel();
        $secondarySidebarView->setTemplate('content/secondary-sidebar');

        $sidebarBlockView = new ViewModel();
        $sidebarBlockView->setTemplate('content/block');

        $secondarySidebarView->addChild($sidebarBlockView, 'block');

        $view->addChild($articleView, 'article')
             ->addChild($primarySidebarView, 'sidebar_primary')
             ->addChild($secondarySidebarView, 'sidebar_secondary');
*/

        return $view;
    }
}
