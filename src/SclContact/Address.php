<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

use SclContact\Exception\InvalidArgumentException;

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
     * {@inheritDoc}
     *
     * @return string
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $line1
     */
    public function setLine1($line1)
    {
        $this->line1 = (string) $line1;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $line2
     */
    public function setLine2($line2)
    {
        $this->line2 = (string) $line2;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = (string) $city;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $county
     */
    public function setCounty($county)
    {
        $this->county = (string) $county;
    }

    /**
     * {@inheritDoc}
     *
     * @return PostcodeInterface
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * {@inheritDoc}
     *
     * @param PostcodeInterface|string $postcode
     */
    public function setPostcode($postcode)
    {
        if (!is_object($postcode)) {
            $this->postcode->set($postcode);
        }

        if (!$postcode instanceof PostcodeInterface) {
            throw new InvalidArguementException(
                sprintf(
                    'Expected instance of \SclContact\PostcodeInterface or string; got "%s"',
                    get_class($postcode)
                )
            );
        }

        $this->postcode = $postcode;
    }

    /**
     * {@inheritDoc}
     *
     * @return CountryInterface
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * {@inheritDoc}
     *
     * @param CountryInterface|string $country
     */
    public function setCountry($country)
    {
        if (!is_object($country)) {
            $this->country->set($postcode);
        }

        if (!$country instanceof CountryInterface) {
            throw new InvalidArguementException(
                sprintf(
                    'Expected instance of \SclContact\CountryInterface or string; got "%s"',
                    get_class($country)
                )
            );
        }

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
