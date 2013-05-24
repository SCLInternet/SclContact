<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContact\Hydrator;

use SclContact\AddressInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

class AddressHydrator implements HydratorInterface
{
    const LINE1    = 'address-line1';
    const LINE2    = 'address-line2';
    const CITY     = 'address-city';
    const COUNTY   = 'address-county';
    const POSTCODE = 'address-postcode';
    const COUNTRY  = 'address-country';

    /**
     * {@inheritDoc}
     *
     * @param  array $data data
     * @param mixed $object object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof AddressInterface) {
            return $object;
        }

        $object->setLine1($data[self::LINE1])
               ->setLine2($data[self::LINE2])
               ->setCity($data[self::CITY])
               ->setCounty($data[self::COUNTY]);

        $postcode = $object->getPostcode();
        $postcode->set($data[self::POSTCODE]);

        $country = $object->getCountry();
        $country->setCode($data[self::COUNTRY]);

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
        if (!$object instanceof AddressInterface) {
            return array();
        }

        return array(
            self::LINE1    => $object->getLine1(),
            self::LINE2    => $object->getLine2(),
            self::CITY     => $object->getCity(),
            self::COUNTY   => $object->getCounty(),
            self::POSTCODE => $object->getPostcode()->get(),
            self::COUNTRY  => $object->getCountry()->getCode(),
        );
    }
}
