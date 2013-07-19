<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContact\Form\Fieldset;

use SclContact\Country\CountryManagerInterface;
use SclContact\Exception\RuntimeException;
use Zend\Form\Fieldset;

/**
 * Fieldset for use with {@see SclContact\Address}.
 *
 * @author Tom Oram <tom@scl.co.uk>
 * @todo   Use CountryManagerAwareTrait
 */
class Address extends Fieldset
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

    /**
     * Add the elements to the fieldset.
     *
     * @return void
     * @throws RuntimeException If the country manager has not yet been set.
     */
    public function init()
    {
        if (!$this->countryManager instanceof CountryManagerInterface) {
            throw RuntimeException::countryManagerNotSet(__METHOD__, __LINE__);
        }

        $this->add(
            array(
                'name' => 'address-line1',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'      => 'address-line1',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Address 1',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'address-line2',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'address-line2',
                ),
                'options' => array(
                    'label' => 'Address 2',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'address-city',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'       => 'address-city',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'City',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'address-county',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'       => 'address-county',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'County',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'address-postcode',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id'       => 'address-postcode',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Postcode',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'address-country',
                'type' => 'Zend\Form\Element\Select',
                'attributes' => array(
                    'id'       => 'address-country',
                    'required' => 'required',
                    'value'    => $this->countryManager->defaultCountry(),
                ),
                'options' => array(
                    'label'     => 'Country',
                    'options' => $this->countryManager->countryList(),
                ),
            )
        );
    }
}
