<?php
namespace ProfileAdmin\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use \Base\Hydrator\Strategy\DateTimeStrategy;

class ProfileForm extends Form
{

    public function init ()
    {
        $hydrator = new ClassMethods;

        $this->setAttribute('method', 'post');
        $this->setHydrator($hydrator)->setObject(new \Profile\Entity\Profile());
        
//         $hydrator->addStrategy('start', new DateTimeStrategy());
//         $hydrator->addStrategy('end', new DateTimeStrategy());
        
        $this->add(array ( 
                'name' => 'name', 
                'attributes' => array ( 
                        'type' => 'text', 
                        'class' => 'form-control',
                		'placeholder' => _('Write here your name'),
                ), 
                'options' => array ( 
                        'label' => _('Name'),
                ), 
                'filters' => array ( 
                        array ( 
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array ( 
                'name' => 'biography', 
                'attributes' => array ( 
                        'type' => 'textarea', 
                        'class' => 'form-control wysiwyg',
                		'placeholder' => _('Write here your own biography'),
                ), 
                'options' => array ( 
                        'label' => _('Biography'),
                ), 
                'filters' => array ( 
                        array ( 
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array (
        		'type' => 'Profile\Form\Element\ProfileCategories',
        		'name' => 'category_id',
        		'attributes' => array (
        				'class' => 'form-control'
        		),
        		'options' => array (
        				'label' => _('Category')
        		)
        ));
        
        $this->add ( array ('type' => 'Zend\Form\Element\File', 
                            'name' => 'file', 
                            'attributes' => array ('id' => 'file' ), 
                            'options' => array (
                                'label' => _ ( 'Upload File' ) ), 
                                'filters' => array (array ('required' => false )  
        ) ) );
        
        
        $this->add(array (
                'name' => 'slogan',
                'attributes' => array (
                        'type' => 'text',
                        'class' => 'form-control',
                        'placeholder' => _('Write here your slogan'),
                ),
                'options' => array (
                        'label' => _('Slogan'),
                ),
                'filters' => array (
                        array (
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array (
                'name' => 'googleplus',
                'attributes' => array (
                        'type' => 'text',
                        'class' => 'form-control',
                        'placeholder' => _('Write here your google+ username'),
                ),
                'options' => array (
                        'label' => 'Google+',
                ),
                'filters' => array (
                        array (
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array (
                'name' => 'facebook',
                'attributes' => array (
                        'type' => 'text',
                        'class' => 'form-control',
                        'placeholder' => _('Write here your facebook username'),
                ),
                'options' => array (
                        'label' => 'Facebook',
                ),
                'filters' => array (
                        array (
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array (
                'name' => 'twitter',
                'attributes' => array (
                        'type' => 'text',
                        'class' => 'form-control',
                        'placeholder' => _('Write here your twitter username'),
                ),
                'options' => array (
                        'label' => 'Twitter',
                ),
                'filters' => array (
                        array (
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array (
                'name' => 'instagram',
                'attributes' => array (
                        'type' => 'text',
                        'class' => 'form-control',
                        'placeholder' => _('Write here your instagram username'),
                ),
                'options' => array (
                        'label' => 'Instagram',
                ),
                'filters' => array (
                        array (
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array (
                'name' => 'url',
                'attributes' => array (
                        'type' => 'text',
                        'class' => 'form-control',
                        'placeholder' => _('Write here your website url. eg: http://www.mysite.com'),
                ),
                'options' => array (
                        'label' => _('Website'),
                ),
                'filters' => array (
                        array (
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array (
                'name' => 'address',
                'attributes' => array (
                        'type' => 'textarea',
                        'class' => 'form-control',
                        'placeholder' => _('Write here your full address'),
                ),
                'options' => array (
                        'label' => _('Address'),
                ),
                'filters' => array (
                        array (
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array (
                'name' => 'telephone',
                'attributes' => array (
                        'type' => 'text',
                        'class' => 'form-control',
                        'placeholder' => _('Write here your telephone. (eg. +39.1234567)'),
                ),
                'options' => array (
                        'label' => _('Telephone'),
                ),
                'filters' => array (
                        array (
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        
        $this->add(array (
                'type' => 'Zend\Form\Element\Select',
                'name' => 'public',
                'attributes' => array (
                        'class' => 'form-control'
                ),
                'options' => array (
                        'label' => _('Would you like publish your personal information?'),
                        'value_options' => array (
                                '1' => _('Yes, I would like to publish my personal information'),
                                '0' => _("No, I don't want to publish my personal information"),
                        )
                )
        ));
        
        $this->add(array ( 
                'name' => 'submit', 
                'attributes' => array ( 
                        'type' => 'submit', 
                        'class' => 'btn btn-success', 
                        'value' => _('Save your profile')
                )
        ));
        $this->add(array (
                'name' => 'id',
                'attributes' => array (
                        'type' => 'hidden'
                )
        ));
    }
}