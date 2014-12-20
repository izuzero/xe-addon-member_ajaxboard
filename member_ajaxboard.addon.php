<?php
/*! Copyright (C) 2014 AJAXBOARD. All rights reserved. */
/**
 * @file   member_ajaxboard.addon.php
 * @author Eunsoo Lee (contact@ajaxboard.co.kr)
 * @brief  Add member menu of ajaxboard.
 */

if (!defined('__XE__'))
{
	exit();
}

$logged_info = Context::get('logged_info');
if (!$logged_info || isCrawler())
{
	return;
}

if ($called_position == 'before_module_init')
{
	Context::loadLang(_XE_PATH_ . 'addons/member_ajaxboard/lang');
	$menu_name = $addon_info->menu_name ? $addon_info->menu_name : Context::getLang('cmd_ajaxboard_menu_name');
	$GLOBALS['__ajaxboard__']['addon']['menu_name'] = $menu_name;

	$selected = $addon_info->selected != 'DEFAULT';
	$GLOBALS['__ajaxboard__']['addon']['selected'] = $selected;

	$target = explode(PHP_EOL, $addon_info->target);
	$oAjaxboardController = getController('ajaxboard');
	$oAjaxboardController->insertAddonUserInfo($target);

	if ($this->module != 'member')
	{
		$oMemberController = getController('member');
		$oMemberController->addMemberMenu('dispAjaxboardNotificationConfig', $menu_name);
	}
}

/* End of file member_ajaxboard.addon.php */
/* Location: ./addons/member_ajaxboard/member_ajaxboard.addon.php */
