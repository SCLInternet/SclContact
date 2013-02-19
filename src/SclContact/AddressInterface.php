<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Interface for a postal address class.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
interface AddressInterface
{
    /**
     * Gets the value for line1.
     *
     * @return string
     */
    public function getLine1();

    /**
     * Sets the value for line1.
     *
     * @param string $line1
     */
    public function setLine1($line1);

    /**
     * Gets the value for line2.
     *
     * @return string
     */
    public function getLine2();

    /**
     * Sets the value for line2.
     *
     * @param string $line2
     */
    public function setLine2($line2);

    /**
     * Gets the value for city.
     *
     * @return string
     */
    public function getCity();

    /**
     * Sets the value for city.
     *
     * @param string $city
     */
    public function setCity($city);

    /**
     * Gets the value for county.
     *
     * @return string
     */
    public function getCounty();

    /**
     * Sets the value for county.
     *
     * @param string $county
     */
    public function setCounty($county);

    /**
     * Gets the value for postcode.
     *
     * @return PostcodeInterface
     */
    public function getPostcode();

    /**
     * Sets the value for postcode.
     *
     * @param PostcodeInterface $postcode
     */
    public function setPostcode(PostcodeInterface $postcode);

    /**
     * Gets the value for country.
     *
     * @return CountryInterface
     */
    public function getCountry();

    /**
     * Sets the value for country.
     *
     * @param CountryInterface $country
     */
    public function setCountry(CountryInterface $country);
    /**
     * Reads the contents of a given address object into this object.
     *
     * @param ContactInterface $contact
     */
    public function import(AddressInterface $address);
}
