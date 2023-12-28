<?php
// This file declares a managed database record of type "Job".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
return [
  [
    'name' => 'Add Dupes to Group',
    'entity' => 'Job',
    'params' => [
      'version' => 3,
      'name' => 'Add Dupes to Group',
      'description' => 'Find Duplicates and add to group',
      'run_frequency' => 'Daily',
      'api_entity' => 'DedupeGroup',
      'api_action' => 'Finddupes',
      'parameters' => '',
    ],
  ],
];
