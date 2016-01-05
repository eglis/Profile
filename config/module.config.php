<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonprofile for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
        'asset_manager' => array(
                'resolver_configs' => array(
                        'collections' => array(
                                'css/application.css' => array(
                                        'css/profile.css',
                                ),
                        ),
                        'paths' => array(
                                __DIR__ . '/../public',
                        ),
                ),
        ),        
		'bjyauthorize' => array(
				'guards' => array(
					'BjyAuthorize\Guard\Route' => array(
							
		                // Generic route guards
		                array('route' => 'profile', 'roles' => array('user')),
		                array('route' => 'profile/default', 'roles' => array('user')),
		                array('route' => 'profile/list', 'roles' => array('user')),
		                array('route' => 'profile/public_profile', 'roles' => array('guest')),

					     // Custom Module
						array('route' => 'zfcadmin/profile', 'roles' => array('admin')),
						array('route' => 'zfcadmin/profile/default', 'roles' => array('admin')),
						array('route' => 'zfcadmin/profile/settings', 'roles' => array('admin')),
						
					),
			  ),
		),
		'navigation' => array(
        		'default' => array(
         		        'profile' => array(
         		                'label' => _('Members'),
         		                'route' => 'profile/list',
         		                'resource' => 'menu',  // look at the bjyauthorize.global.php config file
         		                'privilege' => 'list',
         		        ),
        		       
        		),
				'admin' => array(
        				'settings' => array(
                				'label' => _('Settings'),
                				'route' => 'zfcadmin',
        				        'pages' => array (
    				                    array (
    				                        'label' => 'Profile',
    				                        'route' => 'zfcadmin/profile/settings',
    				                        'icon' => 'fa fa-user'
        				                ),
        				        ),
								'resource' => 'adminmenu',
        				),				
						'profile' => array(
								'label' => _('Customers'),
								'resource' => 'menu',
								'route' => 'zfcadmin/profile',
								'privilege' => 'list',
								'icon' => 'fa fa-list',
								'pages' => array (
										array (
												'label' => 'Our Customers',
												'route' => 'zfcadmin/profile',
												'icon' => 'fa fa-list'
										),
								),
						),
				),
		),
    'router' => array(
        'routes' => array(
        		'zfcadmin' => array(
        				'child_routes' => array(
        						'profile' => array(
        								'type' => 'literal',
        								'options' => array(
        										'route' => '/profile',
        										'defaults' => array(
        												'controller' => 'ProfileAdmin\Controller\Index',
        												'action'     => 'index',
        										),
        								),
        								'may_terminate' => true,
        								'child_routes' => array (
        										'default' => array (
        												'type' => 'Segment',
        												'options' => array (
        														'route' => '/[:action[/:id]]',
        														'constraints' => array (
        																'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        																'id' => '[0-9]*'
        														),
        														'defaults' => array ()
        												)
        										),
        										'settings' => array (
        												'type' => 'Segment',
        												'options' => array (
        														'route' => '/settings/[:action[/:id]]',
        														'constraints' => array (
        																'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        																'id' => '[0-9]*'
        														),
        														'defaults' => array (
            														'controller' => 'ProfileSettings\Controller\Index',
            														'action'     => 'index',
        														)
        												)
        										)
        								),
        						),
        				),
        		),
        		
            'profile' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/profile',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Profile\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        'page'			=> 1
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                
                       'list' => array(
                        'type'    => 'Segment',
                        'options' => array(
                                'route'    => '/list/[/:action]',
                                'constraints' => array(
                                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                ),
                                'defaults' => array(
                                        'controller'        => 'List',
                                        'action'        => 'Index',
                                ),
                        ),
                    ),
                    'public_profile' => array(
                        'type'    => 'Segment',
                        'options' => array(
                                'route'    => '[/:slug].html',
                                'constraints' => array(
                                        'slug'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                ),
                                'defaults' => array(
                                        'action'        => 'show',
                                ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),

		'controllers' => array(
        'invokables' => array(
        ),
        'factories' => array(
        		'Profile\Controller\Index' => 'Profile\Factory\ProfileControllerFactory',
        		'Profile\Controller\Paypal' => 'Profile\Factory\PaypalControllerFactory',
        		'Profile\Controller\Google' => 'Profile\Factory\GoogleControllerFactory',
        		'Profile\Controller\List' => 'Profile\Factory\ListControllerFactory',
        		'ProfileAdmin\Controller\Index' => 'ProfileAdmin\Factory\IndexControllerFactory',
        )
    ),
    'view_helpers' => array (
    		'invokables' => array (
    		)
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
