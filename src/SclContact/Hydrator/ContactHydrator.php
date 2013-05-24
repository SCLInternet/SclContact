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

        $object->setCompany($data[self::COMPANY]);

        $object->getEmail()->set($data[self::EMAIL]);

        $this->addressHydrator->hydrate($data, $object->getAddress());

        $object->getPhone()->set($data[self::PHONE_NO]);
        $object->getFax()->set($data[self::FAX_NO]);

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

        $data = $this->addressHydrator->extract($object->getAddress());

        $data[self::FIRST_NAME] = $object->getName()->getFirstName();
        $data[self::LAST_NAME]  = $object->getName()->getLastName();
        $data[self::EMAIL]      = $object->getEmail()->get();
        $data[self::COMPANY]    = $object->getCompany();
        $data[self::PHONE_NO]   = $object->getPhone()->get();
        $data[self::FAX_NO]     = $object->getFax()->get();

        return $data;
    }
}
