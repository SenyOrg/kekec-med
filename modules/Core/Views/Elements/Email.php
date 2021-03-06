<?php

namespace KekecMed\Core\Views\Elements;

use KekecMed\Core\Abstracts\Views\Elements\AbstractGenericInputParameters;

/**
 * Class Email
 *
 * @author  Selcuk Kekec <senycorp@googlemail.com>
 * @package KekecMed\Core\Views\Elements
 */
class Email extends AbstractGenericInputParameters
{
    /**
     * Configuration
     *
     * @var array
     */
    protected $configuration = [
        'icon'         => 'fa fa-envelope',
        'labelClass'   => 'primary',
        'trackChanges' => true,
    ];

    /**
     * Attribute
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Handle inputs make some
     *
     * @param null $viewMode
     */
    protected function handle($viewMode = null)
    {
        $this->defaultHandler();

        $this->parameters['type'] = 'email';
    }

    /**
     * Get Input Element Identifier
     * to resolve dependent Views automatically
     *
     * @return string
     */
    protected function getIdentifier()
    {
        return 'email';
    }
}