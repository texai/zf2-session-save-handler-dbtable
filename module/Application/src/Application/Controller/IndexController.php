<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
         /*
            CREATE TABLE `session` (
                `id` char(32),
                `name` char(32),
                `modified` int,
                `lifetime` int,
                `data` text,
                 PRIMARY KEY (`id`, `name`)
            );
         */
        $dbAdapter = $this->getServiceLocator()->get('dbadapter');
        $tableGateway = new \Zend\Db\TableGateway\TableGateway('session', $dbAdapter);
        $savehanlerOptions = new \Zend\Session\SaveHandler\DbTableGatewayOptions();
        $saveHandler  = new \Zend\Session\SaveHandler\DbTableGateway($tableGateway, $savehanlerOptions);
        $sessManager = new \Zend\Session\SessionManager();
        $sessManager->setSaveHandler($saveHandler);
        $sessManager->start(true);
        \Zend\Session\Container::setDefaultManager($sessManager);
        return new ViewModel();
    }
}
