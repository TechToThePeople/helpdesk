<?php

require_once 'helpdesk.civix.php';


function helpdesk_civicrm_pre( $op, $objectName, $id, &$params ) {
  if ("create" != $op || "Activity" != $objectName)
    return;
  
  $inbound = civicrm_api('OptionValue', 'getsingle', 
    array ('version' => 3,'sequential' => 1, 'name'=> 'Inbound Email'));
  if ($params["activity_type_id"] != $inbound["value"])
    return;
  $hd = civicrm_api('OptionValue', 'getsingle', array ('version' => 3,'sequential' => 1,'name' => 'helpdesk'));

  $params["activity_type_id"] = $hd["value"];
  $params["status_id"] = 2; //scheduled
}

/**
 * Implementation of hook_civicrm_config
 */
function helpdesk_civicrm_config(&$config) {
  _helpdesk_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function helpdesk_civicrm_xmlMenu(&$files) {
  _helpdesk_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function helpdesk_civicrm_install() {
  return _helpdesk_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function helpdesk_civicrm_uninstall() {
  return _helpdesk_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function helpdesk_civicrm_enable() {
  return _helpdesk_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function helpdesk_civicrm_disable() {
  return _helpdesk_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function helpdesk_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _helpdesk_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function helpdesk_civicrm_managed(&$entities) {

  $entities[] = array(
    'module' => 'eu.tttp.helpdesk',
    'name' => 'support requests',
    'entity' => 'OptionValue',
    'params' => array(
      'version' => 3,
      'name' => 'helpdesk',
      'description' => 'Request received, usually automatically in a mailbox and converted into an activity',
      'option_group_id' => 2,
      'label' => 'Helpdesk request',
      'weight' => 99,
    ),
  );

}
