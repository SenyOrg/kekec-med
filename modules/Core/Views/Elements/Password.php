<?php

namespace KekecMed\Core\Views\Elements;

use KekecMed\Core\Abstracts\Views\Elements\AbstractGenericInputParameters;

/**
 * Class Password
 *
 * @author  Selcuk Kekec <senycorp@googlemail.com>
 * @package KekecMed\Core\Views\Elements
 */
class Password extends AbstractGenericInputParameters
{
    /**
     * Configuration
     *
     * @var array
     */
    protected $configuration = [
        'trackChanges' => true,
    ];

    /**
     * Attribute
     *
     * @var array
     */
    protected $attributes = [
        'onchange' => '',
    ];

    /**
     * Handle inputs make some
     *
     * @param null $viewMode
     */
    protected function handle($viewMode = null)
    {
        $this->defaultHandler();

        $this->parameters['type'] = 'password';
    }

    /**
     * Get Input Element Identifier
     * to resolve dependent Views automatically
     *
     * @return string
     */
    protected function getIdentifier()
    {
        return 'password';
    }
}