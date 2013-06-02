<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests;

use SclContact\Country;

/**
 * Unit tests for the {@see Country} class.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class CountryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic getting and setting of the value of a Country object.
     *
     * @covers SclContact\Country::__construct
     * @covers SclContact\Country::setCode
     * @covers SclContact\Country::getCode
     * @covers SclContact\Country::__toString
     *
     * @return void
     */
    public function testGetSet()
    {
        $value = 'uk';

        $country = new Country($value);

        $this->assertEquals(
            $value,
            $country->getCode(),
            'Get didn\'t return the value set via the constructor'
        );

        $this->assertEquals(
            'UK',
            (string) $country,
            'toString didn\'t return the value set the constructor'
        );

        $value = 'gb';

        $country->setCode($value);

        $this->assertEquals(
            $value,
            $country->getCode(),
            'Get didn\'t return the value set via set()'
        );

        $this->assertEquals(
            'GB',
            (string) $country,
            'toString didn\'t return the value set via set()'
        );
    }

    /**
     * Test the setCode with string which is not 2 chars long.
     *
     * @covers SclContact\Country::setCode
     * @expectedException SclContact\Exception\InvalidArgumentException
     *
     * @return void
     */
    public function testSetInvalidCode()
    {
        $country = new Country();

        $country->setCode('X');
    }

    /**
     * Test the import function.
     *
     * @depends testGetSet
     * @covers SclContact\Country::import
     *
     * @return void
     */
    public function testImport()
    {
        $source = new Country('uk');

        $country = new Country();

        $country->import($source);

        $this->assertEquals(
            'uk',
            $country->getCode(),
            'Value does not match value of object imported'
        );
    }
}
