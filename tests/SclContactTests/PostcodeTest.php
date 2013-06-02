<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests;

use SclContact\Postcode;

/**
 * Unit tests for the {@see Postcode} class.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class PostcodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic getting and setting of the value of a Postcode object.
     *
     * @covers SclContact\Postcode::__construct
     * @covers SclContact\Postcode::set
     * @covers SclContact\Postcode::get
     * @covers SclContact\Postcode::__toString
     *
     * @return void
     */
    public function testGetSet()
    {
        $value = 'SA43 1JD';

        $postcode = new Postcode($value);

        $this->assertEquals(
            $value,
            $postcode->get(),
            'Get didn\'t return the value set via the constructor'
        );

        $this->assertEquals(
            $value,
            (string) $postcode,
            'toString didn\'t return the value set the constructor'
        );

        $value = 'AB12 3CD';

        $postcode->set($value);

        $this->assertEquals(
            $value,
            $postcode->get(),
            'Get didn\'t return the value set via set()'
        );

        $this->assertEquals(
            $value,
            (string) $postcode,
            'toString didn\'t return the value set via set()'
        );
    }


    /**
     * Test the import function.
     *
     * @depends testGetSet
     * @covers SclContact\Postcode::import
     *
     * @return void
     */
    public function testImport()
    {
        $source = new Postcode('AB12 3CD');

        $postcode = new Postcode();

        $postcode->import($source);

        $this->assertEquals(
            'AB12 3CD',
            $postcode->get(),
            'Value does not match value of object imported'
        );
    }
}
