<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests\Hydrator;

use SclContact\Hydrator\AddressHydrator;

/**
 * Unit tests for {@see AddressHydrator}.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class AddressHydratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The instance to be tested
     *
     * @var AddressHydrator
     */
    protected $hydrator;

    /**
     * Prepare the objects to be tested.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->hydrator = new AddressHydrator;
    }

    /**
     * Test the extract method with a good object.
     *
     * Given an object which is an instance of AddressInterface
     * When it is passed to extract
     * Then the extracted data is returned
     *
     * @covers SclContact\Hydrator\AddressHydrator::extract
     *
     * @return void
     */
    public function testExtract()
    {
        $country = $this->getMock('SclContact\CountryInterface');

        $countryManager = $this->getMock('SclContact\Country\CountryManagerInterface');

        $this->hydrator->setCountryManager($countryManager);

        $countryManager->expects($this->once())
                       ->method('getIdentifier')
                       ->with($this->equalTo($country))
                       ->will($this->returnValue('uk'));

        $address = new \SclContact\Address();

        $address->setLine1('line 1')
                ->setLine2('line 2')
                ->setCity('city')
                ->setCounty('county')
                ->setPostcode(new \SclContact\Postcode('pc123'))
                ->setCountry($country);

        $result = $this->hydrator->extract($address);

        $this->assertEquals('line 1', $result['address-line1']);
        $this->assertEquals('line 2', $result['address-line2']);
        $this->assertEquals('city', $result['address-city']);
        $this->assertEquals('county', $result['address-county']);
        $this->assertEquals('pc123', $result['address-postcode']);
        $this->assertEquals('uk', $result['address-country']);
    }

    /**
     * Test the extract method with a bad object.
     *
     * Given an object which is not an instance of AddressInterface
     * When it is passed to extract
     * Then an empty array is returned
     *
     * @return void
     */
    public function testExtractWithBadObject()
    {
        $this->hydrator->setCountryManager($this->getMock('SclContact\Country\CountryManagerInterface'));

        $object = new \stdClass();

        $result = $this->hydrator->extract($object);

        $this->assertInternalType('array', $result);
        $this->assertEmpty($result);
    }

    /**
     * Test the hydrate method with a good object.
     *
     * Given an object which is an instance of AddressInterface
     * When it is passed to hydrate
     * Then the hydrated object is returned
     *
     * @covers SclContact\Hydrator\AddressHydrator::hydrate
     *
     * @return void
     */
    public function testHydrate()
    {
        $country = $this->getMock('SclContact\CountryInterface');

        $countryManager = $this->getMock('SclContact\Country\CountryManagerInterface');

        $this->hydrator->setCountryManager($countryManager);

        $countryManager->expects($this->once())
                       ->method('loadCountry')
                       ->with($this->equalTo('uk'))
                       ->will($this->returnValue($country));

        $address = new \SclContact\Address();

        $data = array(
            'address-line1'    => 'line 1',
            'address-line2'    => 'line 2',
            'address-city'     => 'city',
            'address-county'   => 'county',
            'address-postcode' => 'pc123',
            'address-country'  => 'uk',
        );

        $result = $this->hydrator->hydrate($data, $address);

        $this->assertEquals($address, $result, 'The address object was not returned.');

        $this->assertEquals('line 1', $result->getLine1());
        $this->assertEquals('line 2', $result->getLine2());
        $this->assertEquals('city', $result->getCity());
        $this->assertEquals('county', $result->getCounty());
        $this->assertEquals('pc123', $result->getPostcode()->get());
        $this->assertSame($country, $result->getCountry());
    }

    /**
     * Test the hydrate method with a bad object.
     *
     * Given an object which is not an instance of AddressInterface
     * When it is passed to extract
     * Then the unmodified object is returned
     *
     * @return void
     */
    public function testHydrateWithBadObject()
    {
        $this->hydrator->setCountryManager($this->getMock('SclContact\Country\CountryManagerInterface'));

        $object = new \stdClass();

        $result = $this->hydrator->hydrate(array(), $object);

        $this->assertEquals($object, $result);
    }
}
