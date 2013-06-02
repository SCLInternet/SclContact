<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests;

use SclContact\Email;

/**
 * Unit tests for the {@see Email} class.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class EmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic getting and setting of the value of a Email object.
     *
     * @covers SclContact\Email::__construct
     * @covers SclContact\Email::set
     * @covers SclContact\Email::get
     * @covers SclContact\Email::__toString
     *
     * @return void
     */
    public function testGetSet()
    {
        $value = 'info@scl.co.uk';

        $email = new Email($value);

        $this->assertEquals(
            $value,
            $email->get(),
            'Get didn\'t return the value set via the constructor'
        );

        $this->assertEquals(
            $value,
            (string) $email,
            'toString didn\'t return the value set the constructor'
        );

        $value = 'tom@scl.co.uk';

        $email->set($value);

        $this->assertEquals(
            $value,
            $email->get(),
            'Get didn\'t return the value set via set()'
        );

        $this->assertEquals(
            $value,
            (string) $email,
            'toString didn\'t return the value set via set()'
        );
    }


    /**
     * Test the import function.
     *
     * @depends testGetSet
     * @covers SclContact\Email::import
     *
     * @return void
     */
    public function testImport()
    {
        $source = new Email('info@scl.co.uk');

        $email = new Email();

        $email->import($source);

        $this->assertEquals(
            'info@scl.co.uk',
            $email->get(),
            'Value does not match value of object imported'
        );
    }
}
