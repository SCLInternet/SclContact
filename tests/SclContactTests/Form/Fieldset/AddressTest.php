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
     * @covers SclContact\Fieldset\Form\Address::__construct
     *
     * @return void
     */
    public function testConstruction()
    {
        $fieldset = new Address();

        $this->markTestIncomplete('Need to test elements are correctly added.');
    }
}
