<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContact\Form\Fieldset;

use Zend\Form\Fieldset;

/**
 * Fieldset for use with {@see SclContact\Contact}.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Contact extends Fieldset
{
    /**
     * Add the elements to the fieldset.
     *
     * @param  string $name
     * @param  array  $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(
            array(
                'name' => 'contact-first-name',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'      => 'contact-first-name',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'First Name',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'contact-last-name',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'       => 'contact-last-name',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Last Name',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'contact-company',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'contact-last-name',
                ),
                'options' => array(
                    'label' => 'Company',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'contact-email',
                'type' => 'Zend\Form\Element\Email',
                'attributes' => array(
                    'id'       => 'contact-email-name',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Email Address',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'contact-address',
                'type' => 'SclContact\Form\Fieldset\Address',
            )
        );

        $this->add(
            array(
                'name' => 'contact-phone-no',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'contact-phone-no',
                ),
                'options' => array(
                    'label' => 'Phone Number',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'contact-fax-no',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'contact-fax-no',
                ),
                'options' => array(
                    'label' => 'Fax Number',
                ),
            )
        );
    }
}
