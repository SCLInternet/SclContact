<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests\Form\Fieldset;

use SclContact\Form\Fieldset\Address;

/**
 * Unit tests for the {@see Address} class.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class AddressTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the construction of the Address fieldset.
     *
     * @covers SclContact\Form\Fieldset\Address::init
     *
     * @return void
     */
    public function testConstruction()
    {
        $fieldset = new Address();

        $fieldset->setCountryManager($this->getMock('SclContact\Country\CountryManagerInterface'));

        $fieldset->init();

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('address-line1'),
            'Line 1'
        );

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('address-line2'),
            'Line 2'
        );

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('address-city'),
            'City'
        );

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('address-county'),
            'County'
        );

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('address-postcode'),
            'Postcode'
        );

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('address-postcode'),
            'Country'
        );
    }
}
