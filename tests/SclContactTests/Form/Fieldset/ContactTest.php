<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests\Form\Fieldset;

use SclContact\Form\Fieldset\Contact;

/**
 * Unit tests for the {@see Contact} class.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class ContactTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the construction of the Contact fieldset.
     *
     * @covers SclContact\Form\Fieldset\Contact::init
     *
     * @return void
     */
    public function testConstruction()
    {
        $this->markTestIncomplete('The Address element needs to have the CountryManager set.');
        return;

        $fieldset = new Contact();

        $fieldset->init();

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('contact-first-name'),
            'First Name'
        );

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('contact-last-name'),
            'Last name'
        );

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('contact-company'),
            'Company'
        );

        $this->assertInstanceOf(
            'Zend\Form\Element\Email',
            $fieldset->get('contact-email'),
            'Email'
        );

        $this->assertInstanceOf(
            'SclContact\Form\Fieldset\Address',
            $fieldset->get('contact-address'),
            'Address'
        );

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('contact-phone-no'),
            'Phone no'
        );

        $this->assertInstanceOf(
            'Zend\Form\Element\Text',
            $fieldset->get('contact-fax-no'),
            'Fax no'
        );
    }
}
