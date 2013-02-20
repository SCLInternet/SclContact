<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Interface for a country class country.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
interface CountryInterface
{
    /**
     * Initialise the country class
     *
     * @param string|null $code
     */
    public function __construct($code = null);

    /**
     * Used to diplay the country to the user.
     *
     * @return string
     */
    public function __toString();

    /**
     * Gets the value for code.
     *
     * @return string
     */
    public function getCode();

    /**
     * Sets the value for code.
     *
     * @param string $code
     */
    public function setCode($code);

    /**
     * Reads the contents of a CountryInterface object into this.
     *
     * @param EmailAddressInterface $country
     */
    public function import(CountryInterface $country);
}
