<?php

namespace SclContactTests;

use SclContact\Address;
use SclContact\Country;
use SclContact\Postcode;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    protected $address;

    protected function setUp()
    {
        $this->address = new Address;
    }

    /**
     * Test all the getter and setters.
     *
     * @dataProvider getterSetterProvider
     * @covers SclContact\Address::__construct
     * @covers SclContact\Address::getLine1
     * @covers SclContact\Address::getLine1
     * @covers SclContact\Address::getLine2
     * @covers SclContact\Address::setLine2
     * @covers SclContact\Address::getCity
     * @covers SclContact\Address::setCity
     * @covers SclContact\Address::getCounty
     * @covers SclContact\Address::setCounty
     * @covers SclContact\Address::getPostcode
     * @covers SclContact\Address::getPostcode
     * @covers SclContact\Address::getCountry
     * @covers SclContact\Address::getCountry
     *
     * @param  string $parameter The parameter to be tested
     * @param  mixed  $value     The value to use to test
     * @return void
     */
    public function testGetSet($parameter, $value)
    {
        $getter = 'get' . $parameter;
        $setter = 'set' . $parameter;

        $this->address->$setter($value);

        $this->assertEquals(
            $value,
            $this->address->$getter(),
            'Failed to test getters and setter for ' . $parameter
        );
    }

    /**
     * Provides values to test the getters & setters
     *
     * @return void
     */
    public function getterSetterProvider()
    {
        return array(
            array('line1', 'The House'),
            array('line2', 'The Street'),
            array('city', 'Town'),
            array('county', 'County'),
            array('postcode', new Postcode('SA12 2FC')),
            array('country', new Country('gb')),
        );
    }
}
