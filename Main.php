<?php

/**
 * @package XSS filter
 * @author Iurii Makukh <gplcart.software@gmail.com>
 * @copyright Copyright (c) 2018, Iurii Makukh <gplcart.software@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GPL-3.0-or-later
 */

namespace gplcart\modules\xss;

use gplcart\core\Container;
use gplcart\core\Module;

/**
 * Main class for XSS filter module
 */
class Main
{
    /**
     * Module class instance
     * @var Module
     */
    protected $module;

    /**
     * Main constructor.
     * @param Module $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * Implements hook "route.list"
     * @param array $routes
     */
    public function hookRouteList(array &$routes)
    {
        $routes['admin/module/settings/xss'] = array(
            'access' => 'module_xss_edit',
            'handlers' => array(
                'controller' => array('gplcart\\modules\\xss\\controllers\\Settings', 'editSettings')
            )
        );
    }

    /**
     * Implements hook "user.role.permissions"
     * @param array $permissions
     */
    public function hookUserRolePermissions(array &$permissions)
    {
        $permissions['module_xss_edit'] = 'XSS filter: edit settings'; // @text
    }

    /**
     * Implements hook "filter"
     * @param string $text
     * @param array $filter
     * @param null|string $filtered
     */
    public function hookFilter($text, $filter, &$filtered)
    {
        if (!isset($filtered) && (!isset($filter['filter_id']) || $filter['filter_id'] === 'xss')) {
            $filtered = $this->filter($text);
        }
    }

    /**
     * Implements hook "filter.handlers"
     * @param array $filters
     */
    public function hookFilterHandlers(array &$filters)
    {
        $filters['xss'] = array(
            'name' => 'XSS', // @text
            'description' => 'Simple XSS filter', // @text
            'status' => true,
            'module' => 'xss'
        );
    }

    /**
     * Filter a string
     * @param string $text
     * @param null|array $allowed_tags
     * @param null|array $allowed_protocols
     * @return string
     */
    public function filter($text, $allowed_tags = null, $allowed_protocols = null)
    {
        $settings = $this->module->getSettings('xss');

        if (!isset($allowed_tags)) {
            $allowed_tags = $settings['tags'];
        }

        if (!isset($allowed_protocols)) {
            $allowed_protocols = $settings['protocols'];
        }

        return $this->getFilter()
            ->setTags($allowed_tags)
            ->setProtocols($allowed_protocols)
            ->filter($text);
    }

    /**
     * Returns Filter library class instance
     * @return helpers\Filter
     */
    public function getFilter()
    {
        /** @var \gplcart\modules\xss\helpers\Filter $instance */
        $instance = Container::get('gplcart\\modules\\xss\\helpers\\Filter');
        return $instance;
    }
}
