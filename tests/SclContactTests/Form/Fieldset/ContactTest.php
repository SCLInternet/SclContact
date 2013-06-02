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
     * @covers SclContact\Form\Fieldset\Contact::__construct
     *
     * @return void
     */
    public function testConstruction()
    {
        $fieldset = new Contact();

        $this->markTestIncomplete('Need to test elements are correctly added.');
    }
}
