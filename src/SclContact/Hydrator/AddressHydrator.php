<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContact\Hydrator;

use SclContact\AddressInterface;
use SclContact\Country\CountryManagerInterface;
use SclContact\Exception\RuntimeException;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Hydrator for instances of {@see AddressInterface}.
 *
 * @author Tom Oram <tom@scl.co.uk>
 * @todo   Use CountryManagerAwareTrait
 */
class AddressHydrator implements HydratorInterface
{
    const LINE1    = 'address-line1';
    const LINE2    = 'address-line2';
    const CITY     = 'address-city';
    const COUNTY   = 'address-county';
    const POSTCODE = 'address-postcode';
    const COUNTRY  = 'address-country';

    /**
     * The country manager.
     *
     * @var CountryManagerInterface
     */
    protected $countryManager;

    /**
     * Set the country manager to be used.
     *
     * @param  CountryManagerInterface $manager
     * @return self
     */
    public function setCountryManager(CountryManagerInterface $manager)
    {
        $this->countryManager = $manager;

        return $this;
    }

    /**
     * Return the country manager.
     *
     * @return CountryManagerInterface
     */
    public function getCountryManager()
    {
        return $this->countryManager;
    }

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

        if (!$this->countryManager instanceof CountryManagerInterface) {
            throw RuntimeException::countryManagerNotSet(__METHOD__, __LINE__);
        }

        $object->setLine1($data[self::LINE1])
               ->setLine2($data[self::LINE2])
               ->setCity($data[self::CITY])
               ->setCounty($data[self::COUNTY]);

        $postcode = $object->getPostcode();
        $postcode->set($data[self::POSTCODE]);

        $country = $this->countryManager->loadCountry($data[self::COUNTRY]);
        $object->setCountry($country);

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

        if (!$this->countryManager instanceof CountryManagerInterface) {
            throw RuntimeException::countryManagerNotSet(__METHOD__, __LINE__);
        }

        return array(
            self::LINE1    => $object->getLine1(),
            self::LINE2    => $object->getLine2(),
            self::CITY     => $object->getCity(),
            self::COUNTY   => $object->getCounty(),
            self::POSTCODE => $object->getPostcode()->get(),
            self::COUNTRY  => $this->countryManager->getIdentifier($object->getCountry()),
        );
    }
}
