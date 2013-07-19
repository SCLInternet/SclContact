<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContact\Country;

trait CountryManagerAwareTrait
{
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
}
