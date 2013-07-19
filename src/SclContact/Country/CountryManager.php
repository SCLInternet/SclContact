<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContact\Country;

use SclContact\CountryInterface as Country;
use SclContact\Exception\RuntimeException;
use SclContact\Options\ContactOptionsInterface;
use Zend\ServiceManager\serviceLocatorInterface;

/**
 * Basic country manager which uses
 *
 * @uses CountryManagerInterface
 * @author Tom Oram <tom@scl.co.uk>
 */
class CountryManager implements CountryManagerInterface
{
    /**
     * Stored cache of loaded countries.
     *
     * @var Country[]
     */
    protected $countries = array();

    /**
     * Cached list of countries to avoid multiple includes.
     *
     * @var array
     */
    protected $countryList;

    /**
     * The module options.
     *
     * @var ContactOptionsInterface
     */
    protected $options;

    /**
     * The Zend Framework service locator.
     *
     * @var serviceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * __construct
     *
     * @param ContactOptionsInterface $options
     */
    public function __construct(ContactOptionsInterface $options, ServiceLocatorInterface $serviceLocator)
    {
        $this->options        = $options;
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * {@inheritDoc}
     *
     * @return string[]
     * @throws RuntimeException If the config file doesn't exist.
     * @throws RuntimeException If the config file doesn't return an array.
     */
    public function countryList()
    {
        if (is_array($this->countryList)) {
            return $this->countryList;
        }

        $configFile = $this->options->getCountryFilePath();

        if (!file_exists($configFile)) {
            throw RuntimeException::fileDoesNotExist($configFile, __METHOD__, __LINE__);
        }

        $countries = include $configFile;

        if (!is_array($countries)) {
            throw RuntimeException::countriesExpectedArray($countries, __METHOD__, __LINE__);
        }

        $this->countryList = $countries;

        return $countries;
    }

    /**
     * {@inheritDoc}
     *
     * @param  mixed $identifier
     * @return CountryInterface
     */
    public function loadCountry($identifier)
    {
        if ($this->options->getSharedCountries()
            && array_key_exists($identifier, $this->countries)
        ) {
            return $this->countries[$identifier];
        }

        $countryList = $this->countryList();

        if (!array_key_exists($identifier, $countryList)) {
            return null;
        }

        $className = $this->options->getCountryClass();

        if ($this->serviceLocator->has($className)) {
            $country = $this->serviceLocator->get($className);
        } else {
            $country = new $className();
        }

        if (!$country instanceof Country) {
            throw RuntimeException::invalidType(
                'SclContact\CountryInterface',
                $country,
                __METHOD__,
                __LINE__
            );
        }

        $country->setCode($identifier);

        $this->countries[$identifier] = $country;

        return $country;
    }

    /**
     * {@inheritDoc}
     *
     * @return CountryInterface
     */
    public function defaultCountry()
    {
        return $this->options->getDefaultCountry();
    }

    /**
     * {@inheritDoc}
     *
     * @param  Country $country
     * @return mixed
     */
    public function getIdentifier(Country $country)
    {
        return $country->getCode();
    }
}
