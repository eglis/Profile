<?php
namespace Profile\Factory;

use Profile\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProfileControllerFactory implements FactoryInterface
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
        $profileSettingService = $realServiceLocator->get('ProfileSettingsService');
        $eventService = $realServiceLocator->get('ProfileService');
        $eventSettings = $realServiceLocator->get('SettingsService');
        
        $form = $realServiceLocator->get('FormElementManager')->get('Profile\Form\ProfileForm');
        $formfilter = $realServiceLocator->get('ProfileFilter');
        
        return new IndexController($eventService, $profileSettingService, $form, $formfilter, $eventSettings);
    }
}