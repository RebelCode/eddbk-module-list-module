<?php

namespace RebelCode\EddBookings\Module;

use Dhii\Data\Container\ContainerFactoryInterface;
use Psr\Container\ContainerInterface;
use RebelCode\Modular\Module\AbstractBaseModule;

/**
 * A module that adds a page showing a list of the modules loaded for EDDBK.
 *
 * @since [*next-version*]
 */
class ModulesListModule extends AbstractBaseModule
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param ContainerFactoryInterface $containerFactory The container factory.
     */
    public function __construct(ContainerFactoryInterface $containerFactory)
    {
        $this->_initModule($containerFactory, 'modules-list');
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function setup()
    {
        return $this->_createContainer();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function run(ContainerInterface $c = null)
    {
        // Register page
        add_action('admin_menu', [$this, 'registerPage']);
        // Add row link
        add_filter('plugin_row_meta', [$this, 'addPluginRowLink'], 10, 2);
    }

    /**
     * Registers the module list page.
     *
     * @since [*next-version*]
     */
    public function registerPage()
    {
        add_submenu_page(
            null,
            'EDD Bookings Modules',
            'EDD Bookings Modules',
            'manage_options',
            'eddbk-modules',
            [$this, 'renderModuleListPage']
        );
    }

    /**
     * Adds a "Modules" row link to the plugin in the WordPress Plugins page.
     *
     * @since [*next-version*]
     */
    public function addPluginRowLink($links, $file)
    {
        if (strpos($file, 'eddbk/plugin.php') !== false) {
            $new_links = [
                'modules' => sprintf(
                    '<a href="%1$s">%2$s</a>',
                    admin_url('edit.php?page=eddbk-modules'),
                    __('Modules')
                ),
            ];

            $links = array_merge($links, $new_links);
        }

        return $links;
    }

    /**
     * Renders the module list page.
     *
     * @since [*next-version*]
     */
    public function renderModuleListPage()
    {
        include EDDBK_MODULE_LIST_MODULE_DIR . '/templates/module-list-page.php';
    }
}
