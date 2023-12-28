<?php


class CRM_DedupeGroup {

  /**
   * Find duplicate contacts and add to group.
   */
  public function findDuplicates() {
    $config = json_decode(Civi::settings()->get('dedupegroup'), TRUE) ?? [];
    if (empty($config['group']) || empty($config['rule'])) {
      return;
    }
    $existingContacts = \Civi\Api4\GroupContact::get(TRUE)
      ->addSelect('contact_id')
      ->addWhere('group_id', '=', $config['group'])
      ->execute()
      ->column('contact_id');
    if (!empty($existingContacts)) {
      $existingContacts = array_flip($existingContacts);
    }

    $duplicates = CRM_Dedupe_Merger::getDuplicatePairs($config['rule'], FALSE, TRUE, 0, FALSE);
    foreach ($duplicates as $duplicate) {
      foreach (['srcID', 'dstID'] as $k) {
        if (!empty($duplicate[$k])) {
          $contactsToAdd[$duplicate[$k]] = 1;
        }
      }
    }

    $contactsToRemove = array_diff_key($existingContacts, $contactsToAdd);
    $contactsToAdd = array_diff_key($contactsToAdd, $existingContacts);
    foreach ($contactsToAdd as $cid => $ignore) {
      $this->addToGroup($cid, $config['group']);
    }

    foreach ($contactsToRemove as $cid => $ignore) {
      $this->removeFromGroup($cid, $config['group']);
    }
  }

  /**
   * Add duplicate contacts to group
   */
  protected function addToGroup($cid, $gid) {
    static $added = [];
    if (!empty($added[$cid])) {
      return;
    }
    \Civi\Api4\GroupContact::create(TRUE)
      ->addValue('group_id', $gid)
      ->addValue('contact_id', $cid)
      ->execute();
    $added[$cid] = TRUE;
  }

  /**
   * Remove contact from group.
   */
  protected function removeFromGroup($cid, $gid) {
    static $removed = [];
    if (!empty($removed[$cid])) {
      return;
    }
    \Civi\Api4\GroupContact::delete(TRUE)
      ->addValue('group_id', $gid)
      ->addValue('contact_id', $cid)
      ->execute();
    $removed[$cid] = TRUE;
  }

}