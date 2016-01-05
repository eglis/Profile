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
* @subpackage Controller
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace ProfileAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Model\UrlRewrites as UrlRewrites;
use Base\Hydrator\Strategy\DateTimeStrategy;

class IndexController extends AbstractActionController
{
	protected $profileservice;
	protected $datagrid;
	protected $form;
	protected $filter;
	protected $settings;
	protected $translator;
	
	/**
	 * preDispatch of the page
	 *
	 * (non-PHPdoc)
	 * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
	 */
	public function onDispatch(\Zend\Mvc\MvcEvent $e){
	    $this->translator = $e->getApplication()->getServiceManager()->get('translator');
	    return parent::onDispatch( $e );
	}
	
	/**
	 * Class constructor
	 *  
	 * @param \Profile\Service\ProfileerviceInterface $recordService
	 * @param \Profile\Form\EventForm $form
	 * @param \Profile\Form\EventFilter $formfilter
	 * @param \ZfcDatagrid\Datagrid $datagrid
	 * @param \Base\Service\SettingsServiceInterface $settings
	 */
	public function __construct(\Profile\Service\ProfileserviceInterface $recordService,
								\ProfileAdmin\Form\ProfileForm $form, 
								\ProfileAdmin\Form\ProfileFilter $formfilter, 
								\ZfcDatagrid\Datagrid $datagrid, 
								\Base\Service\SettingsServiceInterface $settings)
	{
		$this->profileservice = $recordService;
		$this->datagrid = $datagrid;
		$this->form = $form;
		$this->filter = $formfilter;
		$this->settings = $settings;
	}
	
	/**
	 * List of all records
	 */
	public function indexAction ()
	{
	    // prepare the datagrid
	    $this->datagrid->render();
	    
	    // get the datagrid ready to be shown in the template view
	    $response = $this->datagrid->getResponse();
	    
	    if ($this->datagrid->isHtmlInitReponse()) {
	        $view = new ViewModel();
	        $view->addChild($response, 'grid');
	        return $view;
	    } else {
	        return $response;
	    }
	}
	
	/**
	 * Add new information
	 */
	public function addAction ()
	{
	
	    $form = $this->form;
	
	    $viewModel = new ViewModel(array (
	            'form' => $form,
	    ));
	
	    $viewModel->setTemplate('profile-admin/index/edit');
	    return $viewModel;
	}
	
	/**
	 * Edit the main profile information
	 */
	public function editAction ()
	{
	    $id = $this->params()->fromRoute('id');
	     
	    $form = $this->form;
	
	    // Get the record by its id
	    $rsprofile = $this->profileservice->find($id);
	     
	    if(empty($rsprofile)){
	        $this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not found!');
	        return $this->redirect()->toRoute('zfcadmin/profile/default');
	    }
	
	    // Bind the data in the form
	    if (! empty($rsprofile)) {
	        $form->bind($rsprofile);
	    }
	     
	    $viewModel = new ViewModel(array (
	            'form' => $form,
	    ));
	
	    return $viewModel;
	}
	
	
	/**
	 * Prepare the data and then save them
	 *
	 * @return \Zend\View\Model\ViewModel
	 */
	public function processAction ()
	{
	    $urlRewrite = new UrlRewrites();
	    $request = $this->getRequest();
	     
	    // create the profile upload directories
	    @mkdir(__DIR__ . "/../../../../documents/");
	    @mkdir(__DIR__ . "/../../../../documents/profile");
	
	     
	    if (! $this->request->isPost()) {
	        return $this->redirect()->toRoute(NULL, array (
	                'controller' => 'profile',
	                'action' => 'index'
	        ));
	    }
	
	    $post = $this->request->getPost();
	    $inputFilter = $this->filter;
	    $dateStrategy = new DateTimeStrategy();
	     
	    //     	$start = $dateStrategy->hydrate($post['start']);
	    //     	$end = $dateStrategy->hydrate($post['end']);
	     
	    $form = $this->form;
	     
	    $post = array_merge_recursive(
	            $request->getPost()->toArray(),
	            $request->getFiles()->toArray()
	    );
	     
	    $strslug = !empty($post['slug']) ? $post['slug'] : $urlRewrite->format($post['title']);
	     
	    // customize the path
	    if(!empty($strslug)){
	        @mkdir(__DIR__ . "/../../../../documents/profile/" . $strslug);
	        $path = __DIR__ . "/../../../../documents/profile/" . $strslug . '/';
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
	
	        $viewModel->setTemplate('profile-admin/index/edit');
	        return $viewModel;
	    }
	
	    // Get the posted vars
	    $data = $form->getData();
	    $slug = $data->getSlug();
	    $parent = 0 == $data->getParentId() ? null : $data->getParentId();
	     
	    $strslug = !empty($slug) ? $slug : $urlRewrite->format($data->getTitle());
	    $data->setSlug($strslug);
	    $data->setParentId($parent);
	
	    // set the input filter
	    $form->setInputFilter($inputFilter);
	     
	    $filename = $data->getFile();
	    if(!empty($filename['name'])) {
	        $data->setFile('/documents/profile/' . $strslug . "/" . $filename['name']);
	    }else{
	        if(!empty($post['id'])){
	            $attachment = $this->profileservice->getAttachment($post['id']);
	            if($attachment){
	                $data->setFile($attachment->getFile());
	            }else{
	                $data->setFile(null);
	            }
	        }else{
	            $data->setFile(null);
	        }
	    }
	     
	    $userId = $this->zfcUserAuthentication()->getIdentity()->getId();
	    $data->setUserId($userId);
	     
	    // Save the data in the database
	    $record = $this->profileservice->save($data);
	     
	    $this->flashMessenger()->setNamespace('success')->addMessage($this->translator->translate('The information have been saved.'));
	
	    return $this->redirect()->toRoute(NULL, array (
	            'controller' => 'profile',
				'action' => 'Edit',
	            'id' => $record->getId()
	    ));
	}
	
	/**
	 * Delete the records
	 *
	 * @return \Zend\Http\Response
	 */
	public function deleteAction ()
	{
	    $id = $this->params()->fromRoute('id');
	
	    if (is_numeric($id)) {
	
	        // Delete the record informaiton
	        $this->profileservice->delete($id);
	
	        // Go back showing a message
	        $this->flashMessenger()->setNamespace('success')->addMessage($this->translator->translate('The record has been deleted!'));
	        return $this->redirect()->toRoute('zfcadmin/profile');
	    }
	
	    $this->flashMessenger()->setNamespace('danger')->addMessage($this->translator->translate('The record has been not deleted!'));
	    return $this->redirect()->toRoute('zfcadmin/profile');
	}
}