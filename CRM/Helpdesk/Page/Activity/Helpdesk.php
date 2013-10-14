<?php

require_once 'CRM/Core/Page.php';

class CRM_Helpdesk_Page_Activity_Helpdesk extends CRM_Core_Page {
  function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('Activity_Helpdesk'));

  $hd = civicrm_api('OptionValue', 'getsingle', array ('version' => 3,'sequential' => 1,'name' => 'helpdesk'));

  $activities = civicrm_api('Activity', 'get', array ('version' => 3,'sequential' => 1,'option.limit'=>500, 'activity_type_id'=>$hd["value"]));

    $this->assign('activities', $activities);

    parent::run();
  }
}
