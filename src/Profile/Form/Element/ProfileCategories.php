<?php
namespace Profile\Form\Element;

use Profile\Service\ProfileCategoryService;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class ProfileCategories extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $eventcategoryService;
    
    public function __construct(ProfileCategoryService $eventcategoryService, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->eventcategoryService = $eventcategoryService;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();
        
        $eventcategories = $this->eventcategoryService->findVisible();
        foreach ($eventcategories as $eventcategory){
            $data[$eventcategory->getId()] = $this->translator->translate($eventcategory->getCategory());
        }
        asort($data);
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
