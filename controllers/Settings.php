<?php

/**
 * @package XSS filter
 * @author Iurii Makukh <gplcart.software@gmail.com>
 * @copyright Copyright (c) 2018, Iurii Makukh <gplcart.software@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GPL-3.0-or-later
 */

namespace gplcart\modules\xss\controllers;

use gplcart\core\controllers\backend\Controller;

/**
 * Handles incoming requests and outputs data related to XSS filter module
 */
class Settings extends Controller
{

    /**
     * Route page callback to display the module settings page
     */
    public function editSettings()
    {
        $this->setTitleEditSettings();
        $this->setBreadcrumbEditSettings();

        $this->setData('settings', $this->getModuleSettings('xss'));

        $this->submitSettings();
        $this->setDataEditSettings();
        $this->outputEditSettings();
    }

    /**
     * Prepare an set template variables
     */
    protected function setDataEditSettings()
    {
        foreach (array('settings.tags', 'settings.protocols') as $field) {

            $data = $this->getData($field);

            if (is_array($data)) {
                $this->setData($field, implode(',', $data));
            }
        }
    }

    /**
     * Set title on the module settings page
     */
    protected function setTitleEditSettings()
    {
        $title = $this->text('Edit %name settings', array('%name' => $this->text('XSS filter')));
        $this->setTitle($title);
    }

    /**
     * Set breadcrumbs on the module settings page
     */
    protected function setBreadcrumbEditSettings()
    {
        $breadcrumbs = array();

        $breadcrumbs[] = array(
            'text' => $this->text('Dashboard'),
            'url' => $this->url('admin')
        );

        $breadcrumbs[] = array(
            'text' => $this->text('Modules'),
            'url' => $this->url('admin/module/list')
        );

        $this->setBreadcrumbs($breadcrumbs);
    }

    /**
     * Saves the submitted settings
     */
    protected function submitSettings()
    {
        if ($this->isPosted('save') && $this->validateSettings()) {
            $this->updateSettings();
        }
    }

    /**
     * Validate submitted module settings
     * @return bool
     */
    protected function validateSettings()
    {
        $this->setSubmitted('settings');

        foreach (array('tags', 'protocols') as $field) {
            $string = str_replace(' ', '', $this->getSubmitted($field));
            $this->setSubmitted($field, array_filter(explode(',', $string)));
        }

        return !$this->hasErrors();
    }

    /**
     * Update module settings
     */
    protected function updateSettings()
    {
        $this->controlAccess('module_edit');
        $this->controlAccess('module_xss_edit');

        $this->module->setSettings('xss', $this->getSubmitted());
        $this->redirect('', $this->text('Settings have been updated'), 'success');
    }

    /**
     * Render and output the module settings page
     */
    protected function outputEditSettings()
    {
        $this->output('xss|settings');
    }
}
