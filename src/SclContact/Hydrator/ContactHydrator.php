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

        $object->setCompany($data[self::COMPANY]);

        $object->getEmail()->set($data[self::EMAIL]);

        if (is_array($data[self::ADDRESS])) {
            $this->addressHydrator->hydrate(
                $data[self::ADDRESS],
                $object->getAddress()
            );
        }

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
