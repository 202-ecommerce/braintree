{*
* 2007-2019 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
* @author 202-ecommerce <tech@202-ecommerce.com>
* @copyright Copyright (c) 202-ecommerce
* @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
* International Registered Trademark & Property of PrestaShop SA
*}


<div>
    <button class="btn btn-default" type="button" data-role-collapse data-collapsed="#apiHelpMessage">
        {l s='Impossible to access to API via Braintree account?' mod='braintreeofficial'}
    </button>

    <div class="alert alert-info bt__mt-2" style="display: none" id="apiHelpMessage">
        <p>
            {{l s='If you get an error message "[b]You do not have the proper authorization for this request[/b]" when you access to your [a @href1@]API keys[/a] via your Braintree account:' mod='braintreeofficial'}|braintreereplace:['@href1@' => {'https://signups.braintreepayments.com/'}, '@target@' => {'target="blank"'}]}
        </p>

        <p class="bt__mt-2">
            {{l s='[b]Your account was already configured:[/b]' mod='braintreeofficial'}|braintreereplace}
        </p>

        <p>
            {l s='- You are able to use your API keys if you stored them previously and to continue to accept payments via Braintree if your account is already correctly configurated. No actions required on your side.' mod='braintreeofficial'}
        </p>

        <p>
            {{l s='[b]You would like to change your account configurations but your can not get your API keys:[/b]' mod='braintreeofficial'}|braintreereplace}
        </p>

        <p>
            {l s='- If you have not stored your API keys somewhere on your side, you will no longer be able to use your current account API credentials as we can\'t provide them for you. If you would like to continue using your current PrestaShop Braintree module which requires API keys, you will need to apply for a Braintree Direct account by clicking the “Sign up” button at the bottom of Braintree homepage. Once you have been approved for the new account, you will be able to log in and retrieve your API keys. If you have any issues on the approval process by Braintree, please contact Braintree Support on their website.' mod='braintreeofficial'}
        </p>

    </div>
</div>

