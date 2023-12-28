<div id="group_dupe-div-label">{$form.group_dupe.label}</div>
<div id="group_dupe-div-html">{$form.group_dupe.html}
  <span class='description'>{ts}If selected, the next screen will list the dupes only when both contact A and B are part of the above group.{/ts}</span>
</div>

<script type="text/javascript">
{literal}
CRM.$(function($) {
  $('#group_id').closest('tr').after('<tr id="group_dupe-tr"><td id="group_dupe_label"></td><td id="group_dupe_element"></td></tr>');
  $("#group_dupe-div-label").detach().appendTo("#group_dupe_label");
  $("#group_dupe-div-html").detach().appendTo("#group_dupe_element");
});
{/literal}
</script>