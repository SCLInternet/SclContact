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
 * Fieldset for use with {@see SclContact\Address}.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Address extends Fieldset
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
                'name' => 'address-line1',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'      => 'address-line1',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Address 1',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'address-line2',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'address-line2',
                ),
                'options' => array(
                    'label' => 'Address 2',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'address-city',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'       => 'address-city',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'City',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'address-county',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'       => 'address-county',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'County',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'address-postcode',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'       => 'address-postcode',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Postcode',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'address-country',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'       => 'address-country',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Country',
                ),
            )
        );
    }
}
