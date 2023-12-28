<?php

require_once 'dedupegroup.civix.php';
use CRM_Dedupegroup_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function dedupegroup_civicrm_config(&$config) {
  _dedupegroup_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function dedupegroup_civicrm_install() {
  _dedupegroup_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function dedupegroup_civicrm_enable() {
  _dedupegroup_civix_civicrm_enable();
}

/**
 * Add group dedupe element on the finder form.
 */
function dedupegroup_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Contact_Form_DedupeFind') {
    $form->add('advcheckbox', 'group_dupe', ts('Enable Group Dupe?'));
    $group_dupe = CRM_Utils_Request::retrieve('group_dupe', 'Positive');
    if (!empty($group_dupe)) {
      $template = CRM_Core_Smarty::singleton();
      $urlQuery = $template->get_template_vars('urlQuery');
      $urlQuery .= "&group_dupe=1";
      $template->assign('urlQuery', $urlQuery);
    }
    $templatePath = realpath(dirname(__FILE__)."/templates");
    CRM_Core_Region::instance('page-body')->add(array(
      'template' => "{$templatePath}/group_merge.tpl"
    ));
  }
}

/**
 * Add group_dedupe in the url.
 */
function dedupegroup_civicrm_alterRedirect(&$url, $context) {
  $group_dupe = CRM_Utils_Request::retrieve('group_dupe', 'Positive');
  if (!empty($group_dupe)) {
    $urlString = CRM_Utils_Url::unparseUrl($url);
    if (strpos($urlString, 'civicrm/contact/dedupefind') !== false && strpos($urlString, 'action=update') !== false && strpos($urlString, 'rgid=') !== false) {
      $urlString .= "&group_dupe=1";
    }
    $url = CRM_Utils_Url::parseUrl($urlString);
  }
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function dedupegroup_civicrm_navigationMenu(&$menu) {
  _dedupegroup_civix_insert_navigation_menu(
    $menu,
    'Administer/Customize Data and Screens',
    [
      'label'      => E::ts('Dedupe Group Settings'),
      'name'       => 'dedupe_group_settings',
      'url'        => 'civicrm/a/#/dedupegroup',
      'permission' => 'administer CiviCRM',
      'operator'   => 'OR',
      'separator'  => 0,
    ]
  );
  _dedupegroup_civix_navigationMenu($menu);
}
