<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\FilterProviderInterface;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ModuleManager\Feature\HydratorProviderInterface;
use Zend\ModuleManager\Feature\ServiceConfigProviderInterface;

/**
 * Zend Framework 2 module class which provide hydrators and filters when
 * using SclContact in a ZF2 project.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    FilterProviderInterface,
    FormElementProviderInterface,
    HydratorProviderInterface
{
    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getFilterConfig()
    {
        return array();
    }

    /**
     * {@inheritDoc}
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getFormElementConfig()
    {
        return array(
            'invokables' => array(
                'SclContact\Form\Fieldset\Contact' => 'SclContact\Form\Fieldset\Contact',
            ),
            'factories' => array(
                'SclContact\Form\Fieldset\Address' => function ($em) {
                    $sm = $em->getServiceLocator();

                    $address = new \SclContact\Form\Fieldset\Address();

                    $address->setCountryManager(
                        $sm->get('SclContact\Country\CountryManagerInterface')
                    );

                    return $address;
                },
            ),
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getHydratorConfig()
    {
        return array(
            'factories' => array(
                'SclContact\Hydrator\AddressHydrator' => function ($hm) {
                    $sm = $hm->getServiceLocator();

                    $address = new \SclContact\Hydrator\AddressHydrator();

                    $address->setCountryManager(
                        $sm->get('SclContact\Country\CountryManagerInterface')
                    );

                    return $address;
                },
                'SclContact\Hydrator\ContactHydrator' => function ($hm) {
                    return new \SclContact\Hydrator\ContactHydrator(
                        $hm->get('SclContact\Hydrator\AddressHydrator')
                    );
                },
            ),
        );
    }

    /**
     * {@inheritDoc}
     *
     * return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'SclContact\Options\ContactOptionsInterface' => function ($sm) {
                    $config = $sm->get('Config');

                    return new \SclContact\Options\ContactOptions(
                        $config['scl_contact']
                    );
                },
                // Returns the configured country manager
                'SclContact\Country\CountryManagerInterface' => function ($sm) {
                    $options = $sm->get('SclContact\Options\ContactOptionsInterface');

                    return $sm->get($options->getCountryManager());
                },
                // Returns an instance of the default country manager
                'SclContact\Country\CountryManager' => function ($sm) {
                    return new \SclContact\Country\CountryManager(
                        $sm->get('SclContact\Options\ContactOptionsInterface'),
                        $sm
                    );
                },
            ),
        );
    }
}
