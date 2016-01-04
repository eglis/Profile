<?php
/**
* Copyright (c) 2014 Shine Software.
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions
* are met:
*
* * Redistributions of source code must retain the above copyright
* notice, this list of conditions and the following disclaimer.
*
* * Redistributions in binary form must reproduce the above copyright
* notice, this list of conditions and the following disclaimer in
* the documentation and/or other materials provided with the
* distribution.
*
* * Neither the names of the copyright holders nor the names of the
* contributors may be used to endorse or promote products derived
* from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
* "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
* LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
* FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
* COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
* BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
* LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
* CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
* LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
* ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
*
* @package Profile
* @subpackage Entity
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/


namespace Profile;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Profile\Entity\Profile;
use Profile\Entity\ProfileCategory;
use Profile\Entity\ProfileSettings;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

class Module implements DependencyIndicatorInterface{
	
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    
    /**
     * Check the dependency of the module
     * (non-PHPdoc)
     * @see Zend\ModuleManager\Feature.DependencyIndicatorInterface::getModuleDependencies()
     */
    public function getModuleDependencies()
    {
    	return array('Base');
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    
    /**
     * Set the Services Manager items
     */
    public function getServiceConfig ()
    { 
    	return array(
    			'factories' => array(
    					'ProfileService' => function  ($sm)
    					{
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$translator = $sm->get('translator');
							$settings = $sm->get('SettingsService');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Profile());
    						$tableGateway = new TableGateway('profile', $dbAdapter, null, $resultSetPrototype);
    						$service = new \Profile\Service\ProfileService($tableGateway, $settings, $translator);
    						return $service;
    					},
    					'ProfileCategoryService' => function  ($sm)
    					{
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new ProfileCategory());
    						$tableGateway = new TableGateway('profile_category', $dbAdapter, null, $resultSetPrototype);
    						$service = new \Profile\Service\ProfileCategoryService($tableGateway);
    						return $service;
    					},
    					'ProfileSettingsService' => function  ($sm)
    					{
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new ProfileSettings());
    						$tableGateway = new TableGateway('profile_settings', $dbAdapter, null, $resultSetPrototype);
    						$service = new \Profile\Service\ProfileSettingsService($tableGateway);
    						return $service;
    					},
    					
    					'ProfileForm' => function  ($sm)
    					{
    						$form = new \Profile\Form\ProfileForm();
    						$form->setInputFilter($sm->get('ProfileFilter'));
    						return $form;
    					},
    					'ProfileFilter' => function  ($sm)
    					{
    						return new \Profile\Form\ProfileFilter();
    					},
    					
    					'ProfileAdminForm' => function  ($sm)
    					{
    						$form = new \ProfileAdmin\Form\ProfileForm();
    						$form->setInputFilter($sm->get('ProfileAdminFilter'));
    						return $form;
    					},
    					'ProfileAdminFilter' => function  ($sm)
    					{
    						return new \ProfileAdmin\Form\ProfileFilter();
    					},
    					
    					'ProfileCategoryForm' => function  ($sm)
    					{
    						$form = new \Profile\Form\ProfileCategoryForm();
    						$form->setInputFilter($sm->get('ProfileCategoryFilter'));
    						return $form;
    					},
    					'ProfileCategoryFilter' => function  ($sm)
    					{
    						return new \Profile\Form\ProfileCategoryFilter();
    					},
    				),
    			);
    }
    
    
    /**
     * Get the form elements
     */
    public function getFormElementConfig ()
    {
    	return array (
    			'factories' => array (
					'Profile\Form\Element\ProfileCategories' => function  ($sm)
					{
						$serviceLocator = $sm->getServiceLocator();
						$translator = $sm->getServiceLocator()->get('translator');
						$service = $serviceLocator->get('ProfileCategoryService');
						$element = new \Profile\Form\Element\ProfileCategories($service, $translator);
						return $element;
					},
					'Profile\Form\Element\Profiles' => function  ($sm)
					{
						$serviceLocator = $sm->getServiceLocator();
						$service = $serviceLocator->get('ProfileService');
						$translator = $sm->getServiceLocator()->get('translator');
						$element = new \Profile\Form\Element\Profiles($service, $translator);
						return $element;
					},
				)
    		);
    }
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    __NAMESPACE__ . "Admin" => __DIR__ . '/src/' . __NAMESPACE__ . "Admin",
                    __NAMESPACE__ . "Settings" => __DIR__ . '/src/' . __NAMESPACE__ . "Settings",
                ),
            ),
        );
    }
}
