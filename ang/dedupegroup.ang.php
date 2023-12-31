<?php
// This file declares an Angular module which can be autoloaded
// in CiviCRM. See also:
// \https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules/n
return [
  'js' => [
    'ang/dedupegroup.js',
    'ang/dedupegroup/*.js',
    'ang/dedupegroup/*/*.js',
  ],
  'css' => [
    'ang/dedupegroup.css',
  ],
  'partials' => [
    'ang/dedupegroup',
  ],
  'requires' => [
    'crmUi',
    'crmUtil',
    'ngRoute',
  ],
  'settings' => [],
];
