<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Buttons for each role
	|--------------------------------------------------------------------------
	|
	| Here you may specify the buttons that may appear per role as long the key is
	| in permissions
	|
	|
	*/
	'details_page' => array(
		'others.send_qr' => array(
				'display_value' => 'Send QR Code',
				'function_url'	=> '',
				'page_viewable' => 'both',
			),
		'others.send_sms' => array(
				'display_value' => 'Send SMS Verification',
				'function_url'	=> '',
				'page_viewable' => 'both',
			),
		'others.send_email' => array(
				'display_value' => 'Send Email Authentication',
				'function_url'	=> '',
				'page_viewable' => 'both',
			),
		'others.send_sms' => array(
				'display_value' => 'Send SMS Verification',
				'function_url'	=> '',
				'page_viewable' => 'both',
			),
		'api.create_customer' => array(
				'display_value' => 'Create Customer',
				'function_url'	=> '',
				'page_viewable' => 'account',
			),
		'api.blacklist' => array(
				'display_value' => 'Check Blacklist',
				'function_url'	=> '',
				'page_viewable' => '',
			),
		'api.create_case' => array(
				'display_value' => 'Create Case',
				'function_url'	=> '',
				'page_viewable' => 'account',
			),
		'api.create_order' => array(
				'display_value' => 'Create Order',
				'function_url'	=> '',
				'page_viewable' => 'order',
			),
		'crud.edit' => array(
				'display_value' => 'Update Record',
				'function_url'	=> '',
				'page_viewable' => 'account',
			),
		'crud.edit_order' => array(
				'display_value' => 'Update Order',
				'function_url'	=> '',
				'page_viewable' => 'order',
			),
	),
	'list_page' => array(
		'others.bulk_approve' => array(
				'display_value' => 'Approve All Checked',
				'function_url'	=> '',
			),
		'others.leads_extraction' => array(
				'display_value' => 'Extract All',
				'function_url'	=> '',
			),
		'others.mass_download' => array(
				'display_value' => 'Download All Forms',
				'function_url'	=> '',
			),
		'others.view_form' => array(
				'display_value' => 'Print All Forms',
				'function_url'	=> '',
			),
	),
);