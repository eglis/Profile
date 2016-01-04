<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Profile\Controller;

use Profile\Entity\Event;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Profile\Service\ProfileServiceInterface;
use Base\Service\SettingsServiceInterface;
use Base\Model\UrlRewrites as UrlRewrites;

class ListController extends AbstractActionController
{
	protected $profileService;
	protected $form;
	protected $filter;
	protected $profileSettings;
	protected $translator;
	
	/**
	 * preDispatch profile of the profile
	 * 
	 * (non-PHPdoc)
	 * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
	 */
	public function onDispatch(\Zend\Mvc\MvcEvent $e){
		$this->translator = $e->getApplication()->getServiceManager()->get('translator');
		
		return parent::onDispatch( $e );
	}
	
	public function __construct(ProfileServiceInterface $profileService, 
	                            \Profile\Form\ProfileForm $form, 
								\Profile\Form\ProfileFilter $formfilter, 
	                            SettingsServiceInterface $settings)
	{
		$this->profileService = $profileService;
		$this->profileSettings = $settings;
		$this->form = $form;
		$this->filter = $formfilter;
	}
	
	/**
	 * Get the list of the active and visible profile 
	 * 
	 * (non-PHPdoc)
	 * @see Zend\Mvc\Controller.AbstractActionController::indexAction()
	 */
    public function indexAction ()
    {

        $profiles = $this->profileService->findAll();
        
        $viewModel = new ViewModel(array ('profiles' => $profiles
    	));    	
        
        return $viewModel;
    }
	
	/**
	 * Show the user profile 
	 * 
	 */
    public function showAction ()
    {
    	$profile = $this->params()->fromRoute('profile');
    	$ItemCountPerEvent = $this->profileSettings->getValueByParameter('Profile', 'profileperprofile');
    	
    	if (!$this->zfcUserAuthentication()->hasIdentity()) {
    	    $this->flashMessenger()->setNamespace('danger')->addMessage('The user profile has been not found!');
    	    return $this->redirect()->toRoute('zfcuser/login');
    	}
    	
        $slug = $this->params()->fromRoute('slug');
    	
    	if(empty($slug)){
    		return $this->redirect()->toRoute('home');
    	}
    	
    	$form = $this->form;
    	
    	// Get the record by its id
    	$profile = $this->profileService->getBySlug($slug);
    	
    	// Bind the data in the form
    	if (! empty($profile)) {
    	    $viewModel = new ViewModel(array ('profile' => $profile));
    	    return $viewModel;
    	}else{
    	    $this->flashMessenger()->setNamespace('danger')->addMessage('Profile has been not found!');
    	    return $this->redirect()->toRoute('home');
    	}
    }
    
    /**
     * Delete the file
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function delfileAction ()
    {
        $userId = $this->zfcUserAuthentication()->getIdentity()->getId();
        
        // Get the record by its id
        $profile = $this->profileService->getByUserId($userId );
        
        $file = $profile->getFile();
        if(file_exists(__DIR__ . "/../../../../" . $file)){
            unlink(__DIR__ . "/../../../../" . $file);
            $this->flashMessenger()->setNamespace('success')->addMessage('The file has been deleted!');
        }else{
            $this->flashMessenger()->setNamespace('danger')->addMessage('The file has been not found!');
        }
        
        $theProfile = $this->profileService->find($profile->getId());
        $profile->setFile(null);
        $this->profileService->save($profile);
        
         return $this->redirect()->toRoute(NULL, array (
                'action' => 'index'
        ));
    }
    
    /**
     * Prepare the data and then save them
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function saveAction ()
    {
        $urlRewrite = new UrlRewrites();
        $request = $this->getRequest();
        $inputFilter = $this->filter;
        $post = $this->request->getPost();
        $userId = $this->zfcUserAuthentication()->getIdentity()->getId();
         
        // create the profile upload directories
        @mkdir(__DIR__ . "/../../../../" . '/documents/');
        @mkdir(__DIR__ . "/../../../../" . '/documents/profiles');
        $path = __DIR__ . "/../../../../" . '/documents/profiles/';
         
        if (! $this->request->isPost()) {
            return $this->redirect()->toRoute(NULL, array (
                    'action' => 'index'
            ));
        }
        
        $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
        );
        
        $form = $this->form;
        $strslug = $urlRewrite->format($post['name']);
        
        // customize the path
        if(!empty($strslug)){
            @mkdir(__DIR__ . "/../../../../" . '/documents/profiles/' . $strslug);
            $path = __DIR__ . "/../../../../" . '/documents/profiles/' . $strslug . '/';
            $fileFilter = $inputFilter->get('file')->getFilterChain()->getFilters()->top()->setTarget($path);
        }
        
        $form->setData($post);
        $form->setInputFilter($inputFilter);
        
        if (!$form->isValid()) {
    
            // Get the record by its id
            $viewModel = new ViewModel(array (
                    'error' => true,
                    'form' => $form,
            ));
    
            $viewModel->setTemplate('profile/index/index');
            return $viewModel;
        }
    
        // Get the posted vars
        $data = $form->getData();
        
        $filename = $data->getFile();
        if(!empty($filename['name'])) {
            $data->setFile('/documents/profiles/' . $strslug .'/'. $filename['name']);
        }else{
            $attachment = $this->profileService->getAttachment($post['id']);
            if($attachment){
                $data->setFile($attachment->getFile());
            }else{
                $data->setFile(null);
            }
        }
        
        $data->setSlug($strslug);
        $data->setUserId($userId);
        
        // Save the data in the database
        $record = $this->profileService->save($data);
         
        $this->flashMessenger()->setNamespace('success')->addMessage($this->translator->translate('The information have been saved.'));
    
        return $this->redirect()->toRoute(NULL, array (
                'action' => 'index'
        ));
    }
}
