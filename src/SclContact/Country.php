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
     * {@inheritDoc}
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
     * {@inheritDoc}
     *
     * @return string
     */
    public function __toString()
    {
        return strtoupper($this->code);
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $code
     * @return self
     * @throws InvalidArgumentException When $code is not 2 characters long.
     */
    public function setCode($code)
    {
        $code = strtolower($code);

        if (strlen($code) !== 2) {
            throw new InvalidArgumentException(
                "Country code must be 2 letters long, got '$code'."
            );
        }

        $this->code = $code;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @param  CountryInterface $country
     * @return self
     */
    public function import(CountryInterface $country)
    {
        $this->setCode($country->getCode());

        return $this;
    }
}
