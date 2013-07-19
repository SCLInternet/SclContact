<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContact\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * ContactOptions
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class ContactOptions extends AbstractOptions implements ContactOptionsInterface
{
    /**
     * countryManager
     *
     * @var string
     */
    protected $countryManager;

    /**
     * countryClass
     *
     * @var string
     */
    protected $countryClass;

    /**
     * sharedCountries
     *
     * @var bool
     */
    protected $sharedCountries;

    /**
     * defaultCountry
     *
     * @var mixed
     */
    protected $defaultCountry;

    /**
     * countryFilePath
     *
     * @var string
     */
    protected $countryFilePath;

    /**
     * {@inheritDoc}
     *
     * @param  string $manager
     * @return self
     */
    public function setCountryManager($manager)
    {
        $this->countryManager = (string) $manager;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getCountryManager()
    {
        return $this->countryManager;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $class
     * @return self
     */
    public function setCountryClass($class)
    {
        $this->countryClass = (string) $class;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getCountryClass()
    {
        return $this->countryClass;
    }

    /**
     * {@inheritDoc}
     *
     * @param  boolean $shared
     * @return self
     */
    public function setSharedCountries($shared)
    {
        $this->sharedCountries = (boolean) $shared;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return boolean
     */
    public function getSharedCountries()
    {
        return $this->sharedCountries;
    }

    /**
     * {@inheritDoc}
     *
     * @param  mixed $countryIdentifier
     * @return self
     */
    public function setDefaultCountry($countryIdentifier)
    {
        $this->defaultCountry = $countryIdentifier;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return mixed
     */
    public function getDefaultCountry()
    {
        return $this->defaultCountry;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $path
     * @return self
     */
    public function setCountryFilePath($path)
    {
        $this->countryFilePath = (string) $path;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return self
     */
    public function getCountryFilePath()
    {
        return $this->countryFilePath;
    }
}
