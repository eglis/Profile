<?php
namespace Profile\Form;
use Zend\InputFilter\InputFilter;

class ProfileCategoryFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'category',
    			'required' => true
    	));
    }
}