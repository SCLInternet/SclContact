<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContact\Country;

use SclContact\CountryInterface;

/**
 * Interface for class to load customer objects.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
interface CountryManagerInterface
{
    /**
     * Returns a list of countries.
     *
     * @return string[]
     */
    public function countryList();

    /**
     * Return the country for the given identifier.
     *
     * @param  mixed $identifier
     * @return CountryInterface
     */
    public function loadCountry($identifier);

    /**
     * Returns the identifier for the default country.
     *
     * @return CountryInterface
     */
    public function defaultCountry();

    /**
     * Returns the identifier for the given country.
     *
     * @param  CountryInterface $country
     * @return mixed
     */
    public function getIdentifier(CountryInterface $country);
}
