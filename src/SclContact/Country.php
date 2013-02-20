<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Basic class for storing a country.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Country implements CountryInterface
{
    /**
     * The 2 letter country code.
     *
     * @var string
     */
    protected $code;
    
    /**
     * Initialise the country class
     *
     * @param string $code
     */
    public function __construct($code = null)
    {
        if (null !== $code) {
            $this->setCode($code);
        }
    }

    /**
     * Used to diplay the country to the user.
     *
     * @return string
     */
    public function __toString()
    {
        return strtoupper($this->code);
    }

    /**
     * Gets the value for code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets the value for code.
     *
     * @param string $code
     */
    public function setCode($code)
    {
        $code = strtolower($code);

        if (strlen($code) !== 2) {
            throw new \InvalidArgumentException(
                "Country code must be 2 letters long, got '$code'."
            );
        }

        $this->code = $code;
    }

    /**
     * Reads the contents of a CountryInterface object into this.
     *
     * @param EmailAddressInterface $country
     */
    public function import(CountryInterface $country)
    {
        $this->setCode($country->getCode());
    }
}
