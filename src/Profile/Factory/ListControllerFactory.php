<?php
namespace Profile\Factory;

use Profile\Controller\ListController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListControllerFactory implements FactoryInterface
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
        $eventService = $realServiceLocator->get('ProfileService');
        $eventSettings = $realServiceLocator->get('SettingsService');
        
        $form = $realServiceLocator->get('FormElementManager')->get('Profile\Form\ProfileForm');
        $formfilter = $realServiceLocator->get('ProfileFilter');
        
        return new ListController($eventService, $form, $formfilter, $eventSettings);
    }
}