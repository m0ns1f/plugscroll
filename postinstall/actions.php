<?php
/**
 * @package		LinkedIn Company Updates
 * @subpackage	mod_linkedin
 * @copyright	Copyright (C) 2016 Bmore Creative, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @website		https://www.bmorecreativeinc.com/joomla/extensions
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// http://magazine.joomla.org/issues/issue-december-2013/item/1649-joomla-3-2-new-features-postinstall-messages

function plugscroll_postinstall_condition() {
	/*
	// get the module parameters
	$db = JFactory::getDBO();
	$query = $db->getQuery(true);
	
	$query
		->select('params')
		->from($db->quoteName('#__modules'))
		->where($db->quoteName('module').'='.$db->quote('mod_linked'))
		->setLimit('1');
	$db->setQuery($query);
	$data = $db->loadResult();
	$params = new JRegistry($data);
	
	$gendate = $params->get('gendate');
	
	// LinkedIn access token expires every 60 days
	// Start notifying the administrator within the final 5 days
	$panic = false;
	$expdate = date($gendate, strtotime('+55 days'));
	if ($gendate > $expdate) $panic = true;
	return $panic;
	*/
	return true;
}

function plugscroll_postinstall_action(){
	/*// get the module id
	$db = JFactory::getDBO();
	$query = $db->getQuery(true);
	
	$query
		->select('id')
		->from($db->quoteName('#__modules'))
		->where($db->quoteName('module').'='.$db->quote('mod_linkedin'))
		->setLimit('1');
	$db->setQuery($query);
	$moduleid = $db->loadResult();

	// redirect the administrator to the mod_linkedin module
	$url = 'index.php?option=com_modules&task=module.edit&id='.$moduleid;
	JFactory::getApplication()->redirect($url);*/
	return true;
}