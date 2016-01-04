<?php
namespace Profile\Form\Element;

use Profile\Service\ProfileService;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class Profiles extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $profileService;
    
    public function __construct(ProfileService $profileService, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->profileService = $profileService;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();

        $profiles = $this->profileService->findAll();
        foreach ($profiles as $profile){
            $data[$profile->getUserId()] = $profile->getName();
        }
        $this->setValueOptions($data);
    }
    
    public function setServiceLocator(ServiceLocatorInterface $sl)
    {
        $this->serviceLocator = $sl;
    }
    
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
