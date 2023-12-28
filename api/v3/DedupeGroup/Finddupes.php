<?php
use CRM_Dedupegroup_ExtensionUtil as E;

/**
 * DedupeGroup.Finddupes API
 *
 * @param array $params
 *
 * @return array
 *   API result descriptor
 *
 * @see civicrm_api3_create_success
 *
 * @throws API_Exception
 */
function civicrm_api3_dedupe_group_Finddupes($params) {
  $returnValues = [];
  $obj = new CRM_DedupeGroup();
  $obj->findDuplicates();

  // Spec: civicrm_api3_create_success($values = 1, $params = [], $entity = NULL, $action = NULL)
  return civicrm_api3_create_success($returnValues, $params, 'DedupeGroup', 'Finddupes');
}
