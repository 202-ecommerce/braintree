<?php
/**
 * 2007-2020 PayPal
 *
 *  NOTICE OF LICENSE
 *
 *  This source file is subject to the Academic Free License (AFL 3.0)
 *  that is bundled with this package in the file LICENSE.txt.
 *  It is also available through the world-wide-web at this URL:
 *  http://opensource.org/licenses/afl-3.0.php
 *  If you did not receive a copy of the license and are unable to
 *  obtain it through the world-wide-web, please send an email
 *  to license@prestashop.com so we can send you a copy immediately.
 *
 *  DISCLAIMER
 *
 *  Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 *  versions in the future. If you wish to customize PrestaShop for your
 *  needs please refer to http://www.prestashop.com for more information.
 *
 *  @author 2007-2020 PayPal
 *  @author 202 ecommerce <tech@202-ecommerce.com>
 *  @copyright PayPal
 *  @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

require_once _PS_MODULE_DIR_ . 'braintreeofficial/controllers/admin/AdminBraintreeofficialProcessLogger.php';

class AdminBraintreeOfficialLogsController extends AdminBraintreeofficialProcessLoggerController
{
    public function init()
    {
        parent::init();

        $isWriteCookie = false;

        foreach ($this->getDefaultFilters() as $key => $value) {
            if (Tools::isSubmit('submitFilter' . $this->list_id) === false) {
                $this->context->cookie->__set($key, $value);
                $isWriteCookie = true;
            }
        }

        if ($isWriteCookie) {
            $this->context->cookie->write();
        }
    }

    public function initContent()
    {
        $this->content = $this->context->smarty->fetch($this->getTemplatePath() . '_partials/headerLogo.tpl');
        $this->content .= parent::initContent();
        $this->context->smarty->assign('content', $this->content);
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addCSS(_PS_MODULE_DIR_ . $this->module->name . '/views/css/bt_admin.css');
    }

    protected function getDefaultFilters()
    {
        return [
            $this->getCookieFilterPrefix() . $this->list_id . 'Filter_a!sandbox' => Configuration::get('BRAINTREEOFFICIAL_SANDBOX')
        ];
    }
}
