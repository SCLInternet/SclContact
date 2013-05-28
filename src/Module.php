<?php

namespace SclContact;

use Zend\ModuleManager\Feature\FilterProviderInterface;
use Zend\ModuleManager\Feature\HydratorProviderInterface;

/**
 * Zend Framework 2 module class which provide hydrators and filters when
 * using SclContact in a ZF2 project.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Module implements
    FilterProviderInterface,
    HydratorProviderInterfaced
{
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
     * @return array
     */
    public function getHydratorConfig()
    {
        return array(
            'invokables' => array(
                'SclContact\Hydrator\AddressHydrator' => 'SclContact\Hydrator\AddressHydrator',
            ),
            'factories' => array(
                'SclContact\Hydrator\ContactHydrator' => function ($sm) {
                    return new \SclContact\Hydrator\ContactHydrator(
                        $sm->get('SclContact\Hydrator\AddressHydrator')
                    );
                },
            ),
        );
    }
}
