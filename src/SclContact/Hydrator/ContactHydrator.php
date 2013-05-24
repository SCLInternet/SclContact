<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContact\Hydrator;

use SclContact\ContactInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Hydrator for instances of {@see ContactInterface}.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class ContactHydrator implements HydratorInterface
{
    const FIRST_NAME = 'contact-first-name';
    const LAST_NAME  = 'contact-last-name';
    const COMPANY    = 'contact-company';
    const EMAIL      = 'contact-email';
    const ADDRESS    = 'contact-address';
    const PHONE_NO   = 'contact-phone-no';
    const FAX_NO     = 'contact-fax-no';

    /**
     * The address hydrator
     *
     * @var AddressHydrator
     */
    protected $addressHydrator;

    /**
     * Inject an AddressHydrator.
     *
     * @param  AddressHydrator $addressHydrator
     */
    public function __construct(AddressHydrator $addressHydrator)
    {
        $this->addressHydrator = $addressHydrator;
    }

    /**
     * {@inheritDoc}
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof ContactInterface) {
            return $object;
        }

        $name = $object->getName();
        $name->setFirstName($data[self::FIRST_NAME])
             ->setLastName($data[self::LAST_NAME]);
        $object->setName($name);

        $object->setCompany($data[self::COMPANY]);

        $email = $object->getEmail();
        $email->set($data[self::EMAIL]);
        $object->setEmail($email);

        if (is_array($data[self::ADDRESS])) {
            $address = $object->getAddress();
            $this->addressHydrator->hydrate(
                $data[self::ADDRESS],
                $address
            );
            $object->setAddress($address);
        }

        $phone = $object->getPhone();
        $phone->set($data[self::PHONE_NO]);
        $object->setPhone($phone);

        $fax = $object->getFax();
        $fax->set($data[self::FAX_NO]);
        $object->setFax($fax);

        return $object;
    }

    /**
     * {@inheritDoc}
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof ContactInterface) {
            return array();
        }

        return array(
            self::FIRST_NAME => $object->getName()->getFirstName(),
            self::LAST_NAME  => $object->getName()->getLastName(),
            self::ADDRESS    => $this->addressHydrator->extract($object->getAddress()),
            self::EMAIL      => $object->getEmail()->get(),
            self::COMPANY    => $object->getCompany(),
            self::PHONE_NO   => $object->getPhone()->get(),
            self::FAX_NO     => $object->getFax()->get(),
        );
    }
}
