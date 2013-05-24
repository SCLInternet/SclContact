<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests\Hydrator;

use SclContact\Contact;
use SclContact\PersonName;
use SclContact\Email;
use SclContact\PhoneNumber;
use SclContact\Address;
use SclContact\Hydrator\ContactHydrator;

/**
 * Unit tests for {@see ContactHydrator}.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class ContactHydratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The instance to be tested
     *
     * @var ContactHydrator
     */
    protected $hydrator;

    /**
     * Mock address hydrator.
     *
     * @var \SclContact\Hydrator\AddressHydrator
     */
    protected $addressHydrator;

    /**
     * Prepare the objects to be tested.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->addressHydrator = $this->getMock('SclContact\Hydrator\AddressHydrator');

        $this->hydrator = new ContactHydrator($this->addressHydrator);
    }

    /**
     * Test the extract method with a good object.
     *
     * Given an object which is an instance of ContactInterface
     * When it is passed to extract
     * Then the extracted data is returned
     *
     * @covers SclContact\Hydrator\ContactHydrator::extract
     *
     * @return void
     */
    public function testExtract()
    {
        $contact = new Contact();

        $addressData = array('address' => 'the-address');

        $contact->setName(new PersonName('first', 'last'))
                ->setCompany('the-company')
                ->setEmail(new Email('abc@efg.hjk'))
                ->setPhone(new PhoneNumber('01234567890'))
                ->setFax(new PhoneNumber('09876543210'));

        $this->addressHydrator
             ->expects($this->once())
             ->method('extract')
             ->with($this->equalTo($contact->getAddress()))
             ->will($this->returnValue($addressData));

        $result = $this->hydrator->extract($contact);

        $this->assertEquals('first', $result['contact-first-name']);
        $this->assertEquals('last', $result['contact-last-name']);
        $this->assertEquals('the-company', $result['contact-company']);
        $this->assertEquals($addressData, $result['contact-address']);
        $this->assertEquals('abc@efg.hjk', $result['contact-email']);
        $this->assertEquals('01234567890', $result['contact-phone-no']);
        $this->assertEquals('09876543210', $result['contact-fax-no']);
    }

    /**
     * Test the extract method with a bad object.
     *
     * Given an object which is not an instance of ContactInterface
     * When it is passed to extract
     * Then an empty array is returned
     *
     * @return void
     */
    public function testExtractWithBadObject()
    {
        $object = new \stdClass();

        $result = $this->hydrator->extract($object);

        $this->assertInternalType('array', $result);
        $this->assertEmpty($result);
    }

    /**
     * Test the hydrate method with a good object.
     *
     * Given an object which is an instance of ContactInterface
     * When it is passed to hydrate
     * Then the hydrated object is returned
     *
     * @covers SclContact\Hydrator\ContactHydrator::hydrate
     *
     * @return void
     */
    public function testHydrate()
    {
        $contact = new \SclContact\Contact();

        $data = array(
            'contact-first-name' => 'first',
            'contact-last-name'  => 'last',
            'contact-company'    => 'the-company',
            'contact-email'      => 'abc@def@hij',
            'contact-phone-no'   => '01234567890',
            'contact-fax-no'     => '09876543210',
            'contact-address'    => array('address-data'),
        );

        $this->addressHydrator
             ->expects($this->once())
             ->method('hydrate')
             ->with(
                $this->equalTo($data['contact-address']),
                $this->equalTo($contact->getAddress())
              );

        $result = $this->hydrator->hydrate($data, $contact);

        $this->assertEquals($contact, $result, 'The contact object was not returned.');

        $this->assertEquals('first', $result->getName()->getFirstName());
        $this->assertEquals('last', $result->getName()->getLastName());
        $this->assertEquals('the-company', $result->getCompany());
        $this->assertEquals('abc@def@hij', $result->getEmail()->get());
        $this->assertEquals('01234567890', $result->getPhone()->get());
        $this->assertEquals('09876543210', $result->getFax()->get());
    }

    /**
     * Test the hydrate method with a bad object.
     *
     * Given an object which is not an instance of ContactInterface
     * When it is passed to extract
     * Then the unmodified object is returned
     *
     * @return void
     */
    public function testHydrateWithBadObject()
    {
        $object = new \stdClass();

        $result = $this->hydrator->hydrate(array(), $object);

        $this->assertEquals($object, $result);
    }
}
