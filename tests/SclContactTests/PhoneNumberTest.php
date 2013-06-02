<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests;

use SclContact\PhoneNumber;

/**
 * Unit tests for the {@see PhoneNumber} class.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class PhoneNumberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic getting and setting of the value of a PhoneNumber object.
     *
     * @covers SclContact\PhoneNumber::__construct
     * @covers SclContact\PhoneNumber::set
     * @covers SclContact\PhoneNumber::get
     * @covers SclContact\PhoneNumber::__toString
     *
     * @return void
     */
    public function testGetSet()
    {
        $value = '01234567890';

        $name = new PhoneNumber($value);

        $this->assertEquals(
            $value,
            $name->get(),
            'Get didn\'t return the value set via the constructor'
        );

        $this->assertEquals(
            $value,
            (string) $name,
            'toString didn\'t return the value set the constructor'
        );

        $value = '09876543210';

        $name->set($value);

        $this->assertEquals(
            $value,
            $name->get(),
            'Get didn\'t return the value set via set()'
        );

        $this->assertEquals(
            $value,
            (string) $name,
            'toString didn\'t return the value set via set()'
        );
    }


    /**
     * Test the import function.
     *
     * @depends testGetSet
     * @covers SclContact\PhoneNumber::import
     *
     * @return void
     */
    public function testImport()
    {
        $source = new PhoneNumber('01234567890');

        $name = new PhoneNumber();

        $name->import($source);

        $this->assertEquals(
            '01234567890',
            $name->get(),
            'Value does not match value of object imported'
        );
    }
}
