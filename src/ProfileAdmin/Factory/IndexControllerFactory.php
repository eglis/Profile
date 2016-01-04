<?php
namespace ProfileAdmin\Factory;

use ProfileAdmin\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ProfileAdmin\Model\ProfileDatagrid;

class IndexControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $service = $realServiceLocator->get('ProfileService');
        $settings = $realServiceLocator->get('SettingsService');
        $dbAdapter = $realServiceLocator->get('Zend\Db\Adapter\Adapter');
        $datagrid = $realServiceLocator->get('ZfcDatagrid\Datagrid');
        $form = $realServiceLocator->get('FormElementManager')->get('ProfileAdmin\Form\ProfileForm');
        $formfilter = $realServiceLocator->get('ProfileAdminFilter');
        
        // prepare the datagrid to handle the custom columns and data
        $theDatagrid = new ProfileDatagrid($dbAdapter, $datagrid, $settings);
        $grid = $theDatagrid->getDatagrid();
        
        return new IndexController($service, $form, $formfilter, $grid, $settings);
    }
}