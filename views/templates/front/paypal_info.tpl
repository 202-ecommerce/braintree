{capture name='data_content' assign='data_content'}
<div class="pp-info" data-pp-info>
	<div class="row">
		<div class="col-md-6 item bt__mb-3">
			{include file='module:braintree/views/templates/front/_partials/verified_user.tpl'}
			<div class="header bt__pt-1">{l s="Safer and more protected" mod="braintree"}</div>
			<div class="desc bt__pt-1">{l s="Buyer protection covers account and eligible purchases." mod="braintree"}</div>
		</div>
		<div class="col-md-6 item bt__mb-3">
			{include file='module:braintree/views/templates/front/_partials/language.tpl'}
			<div class="header bt__pt-1">{l s="Simple and convenient" mod="braintree"}</div>
			<div class="desc bt__pt-1">{l s="Skip entering your financial info and prefered address to pay even faster." mod="braintree"}</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 item bt__mb-3">
			{include file='module:braintree/views/templates/front/_partials/offline_bolt.tpl'}
			<div class="header bt__pt-1">{l s="Wherever you are" mod="braintree"}</div>
			<div class="desc bt__pt-1">{l s="Local Payment Methods according to your country and purchase." mod="braintree"}</div>
		</div>
		<div class="col-md-6 item bt__mb-3">
			{include file='module:braintree/views/templates/front/_partials/monetization.tpl'}
			<div class="header bt__pt-1">{l s="No additional fees" mod="braintree"}</div>
			<div class="desc bt__pt-1">{l s="Free to open account and only conversion fees." mod="braintree"}</div>
		</div>
	</div>
</div>
{/capture}
<div data-bt-paypal-info class="bt__pl-2 bt__d-table-cell">
	<a href="#"
		 class="bt__text-primary"
		 data-bt-paypal-info-popover 
		 data-html="true" 
		 data-trigger="hover" 
		 data-container="body"
		 data-content="{$data_content}"
	>
		<i class="material-icons">info</i>
	</a>
</div>