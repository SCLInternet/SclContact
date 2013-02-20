<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Basic class for storing a postal address.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Address implements AddressInterface
{
    /**
     * First line of the address.
     *
     * @var string
     */
    protected $line1;

    /**
     * Second line of the address.
     *
     * @var string
     */
    protected $line2;

    /**
     * The town/city line of the address.
     *
     * @var string
     */
    protected $city;

    /**
     * The county/state line of the address.
     *
     * @var string
     */
    protected $county;

    /**
     * The post/zip code.
     *
     * @var PostcodeInterface
     */
    protected $postcode;

    /**
     * The country.
     *
     * @var CountryInterface
     */
    protected $country;

    /**
     * Initialise member variables.
     */
    public function __construct()
    {
        $this->postcode = new Postcode();
        $this->country = new Country();
    }

    /**
     * Gets the value for line1.
     *
     * @return string
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * Sets the value for line1.
     *
     * @param string $line1
     */
    public function setLine1($line1)
    {
        $this->line1 = (string) $line1;
    }

    /**
     * Gets the value for line2.
     *
     * @return string
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * Sets the value for line2.
     *
     * @param string $line2
     */
    public function setLine2($line2)
    {
        $this->line2 = (string) $line2;
    }

    /**
     * Gets the value for city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the value for city.
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = (string) $city;
    }

    /**
     * Gets the value for county.
     *
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Sets the value for county.
     *
     * @param string $county
     */
    public function setCounty($county)
    {
        $this->county = (string) $county;
    }

    /**
     * Gets the value for postcode.
     *
     * @return PostcodeInterface
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Sets the value for postcode.
     *
     * @param PostcodeInterface $postcode
     */
    public function setPostcode(PostcodeInterface $postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * Gets the value for country.
     *
     * @return CountryInterface
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the value for country.
     *
     * @param CountryInterface $country
     */
    public function setCountry(CountryInterface $country)
    {
        $this->country = $country;
    }

    /**
     * Reads the contents of a given address object into this object.
     *
     * @param ContactInterface $contact
     */
    public function import(AddressInterface $address)
    {
        $this->line1 = $address->getLine1();
        $this->line2 = $address->getLine2();
        $this->city = $address->getCity();
        $this->county = $address->getCounty();
        $this->postcode->import($address->getPostcode());
        $this->country->import($address->getCountry());
    }
}
