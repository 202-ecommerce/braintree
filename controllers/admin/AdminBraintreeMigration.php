<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to a commercial license from SARL 202 ecommerce
 * Use, copy, modification or distribution of this source file without written
 * license agreement from the SARL 202 ecommerce is strictly forbidden.
 * In order to obtain a license, please contact us: tech@202-ecommerce.com
 * ...........................................................................
 * INFORMATION SUR LA LICENCE D'UTILISATION
 *
 * L'utilisation de ce fichier source est soumise a une licence commerciale
 * concedee par la societe 202 ecommerce
 * Toute utilisation, reproduction, modification ou distribution du present
 * fichier source sans contrat de licence ecrit de la part de la SARL 202 ecommerce est
 * expressement interdite.
 * Pour obtenir une licence, veuillez contacter 202-ecommerce <tech@202-ecommerce.com>
 * ...........................................................................
 *
 * @author    202-ecommerce <tech@202-ecommerce.com>
 * @copyright Copyright (c) 202-ecommerce
 * @license   Commercial license
 * @version   develop
 */

use BraintreeAddons\classes\AdminBraintreeController;
use BraintreeAddons\classes\AbstractMethodBraintree;
use Symfony\Component\HttpFoundation\JsonResponse;
use BraintreeAddons\services\ServiceBraintreeCustomer;
use BraintreeAddons\services\ServiceBraintreeVaulting;
use BraintreeAddons\services\ServiceBraintreeOrder;
use BraintreeAddons\services\ServiceBraintreeCapture;
use BraintreeAddons\services\ServiceBraintreeLog;

class AdminBraintreeMigrationController extends AdminBraintreeController
{
    public function initContent()
    {

        $this->context->smarty->assign('content', $this->content);
        Media::addJsDef(array(
            'controllerUrl' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite($this->controller_name)
        ));
        $this->addJS('modules/' . $this->module->name . '/views/js/setupAdmin.js');
    }

    protected function doMigration()
    {
        $serviceBraintreeCustomer = new ServiceBraintreeCustomer();
        $serviceBraintreeVaulting = new ServiceBraintreeVaulting();
        $serviceBraintreeOrder = new ServiceBraintreeOrder();
        $serviceBraintreeCapture = new ServiceBraintreeCapture();
        $serviceBraintreeLog = new ServiceBraintreeLog();

        $serviceBraintreeCustomer->doMigration();
        $serviceBraintreeVaulting->doMigration();
        $serviceBraintreeOrder->doMigration();
        $serviceBraintreeCapture->doMigration();
        $serviceBraintreeLog->doMigration();

        Configuration::updateValue('BRAINTREE_MERCHANT_ID_SANDBOX', Configuration::get('PAYPAL_SANDBOX_BRAINTREE_MERCHANT_ID'));
        Configuration::updateValue('BRAINTREE_MERCHANT_ID_LIVE', Configuration::get('PAYPAL_LIVE_BRAINTREE_MERCHANT_ID'));
        Configuration::updateValue('BRAINTREE_API_INTENT', Configuration::get('PAYPAL_API_INTENT'));
        Configuration::updateValue('BRAINTREE_SANDBOX', Configuration::get('PAYPAL_SANDBOX'));
        Configuration::updateValue('BRAINTREE_ACTIVE_PAYPAL', Configuration::get('PAYPAL_BY_BRAINTREE'));
        Configuration::updateValue('BRAINTREE_SHOW_PAYPAL_BENEFITS', Configuration::get('PAYPAL_API_ADVANTAGES'));
        Configuration::updateValue('BRAINTREE_VAULTING', Configuration::get('PAYPAL_VAULTING'));
        Configuration::updateValue('BRAINTREE_CARD_VERIFICATION', Configuration::get('PAYPAL_BT_CARD_VERIFICATION'));
        Configuration::updateValue('BRAINTREE_3DSECURE', Configuration::get('PAYPAL_USE_3D_SECURE'));
        Configuration::updateValue('BRAINTREE_3DSECURE_AMOUNT', Configuration::get('PAYPAL_3D_SECURE_AMOUNT'));

        $merchant_account_id_currency_sandbox = Tools::jsonDecode(Configuration::get('PAYPAL_SANDBOX_BRAINTREE_ACCOUNT_ID'));
        $merchant_account_id_currency_live = Tools::jsonDecode(Configuration::get('PAYPAL_LIVE_BRAINTREE_ACCOUNT_ID'));

        if ($merchant_account_id_currency_sandbox) {
            $this->doMigrateMerchantAccountIdCurrency((array)$merchant_account_id_currency_sandbox, 1);
        }

        if ($merchant_account_id_currency_live) {
            $this->doMigrateMerchantAccountIdCurrency((array)$merchant_account_id_currency_live, 0);
        }
    }

    protected function doMigrateMerchantAccountIdCurrency($merchantAccountIdCurrency, $sandbox)
    {
        if (is_array($merchantAccountIdCurrency) == false) {
            return;
        }

        foreach ($merchantAccountIdCurrency as $currency => $merchantAccountId) {
            Configuration::updateValue($this->module->getNameMerchantAccountForCurrency($currency, $sandbox), $merchantAccountId);
        }
    }

    public function ajaxDisplayMigration()
    {
        $this->doMigration();
    }
}
