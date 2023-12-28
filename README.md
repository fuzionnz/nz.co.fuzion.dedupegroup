# Group Duplicate Contacts

Adds the potential duplicate contacts to a group based on config settings.

If a group is selected for dedupe, optionally ext can list the duplicate row only when contact A and B are both part of the group.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v7.0+
* CiviCRM (v5+)

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl nz.co.fuzion.dedupegroup@https://github.com/FIXME/nz.co.fuzion.dedupegroup/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/FIXME/nz.co.fuzion.dedupegroup.git
cv en dedupegroup
```

## Usage

- After installation, visit Administer » Customise Data and Screens » Dedupe Group Settings to configure.
- Select a group and a dedupe rule and click save.
- The scheduled job `Add Dupes to Group` will run daily and periodically refreshes the group with duplicate contacts matching the configured rule above.
- Users can then select this group while finding the duplicate contacts using `Find and Merge Duplicate Contacts`.
