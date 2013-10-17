<h3>To DO</h3>
<table id="todo" class="crm-datatable">
<thead>
<tr>
<th>Subject</th>
<th>Date</th>
<th></th>
</tr>
</thead>
<tbody>
{foreach from=$activities.values item="a"}
<tr id="activity-{$a.id}" data-id="{$a.id}" data-type="activity" class="crm-entity">
  <td><a href="{crmURL p="civicrm/activity?" q="$bla}&atype={$a.activity_type_id}&action=view&reset=1&id={$a.id}&cid={$a.source_contact_id}&context=activity"}" class="crm-editable crm-dialog">{$a.subject}</a></td>
  <td>{$a.activity_date_time}</td>
  <td>
<a href="#" class="button button_close">Close</a>
<a href="{crmURL p="civicrm/activity?" q="$bla}&atype={$a.activity_type_id}&action=update&reset=1&id={$a.id}&cid={$a.source_contact_id}&context=activity"}" class="button button_assign crm-editable crm-dialog">Assign</a>
<a href="{crmURL p="civicrm/activity/email/add?" q="$dummy}&atype=3&reset=1&id=&cid={$a.source_contact_id}&context=activity"}" class="button button_reply crm-editable crm-dialog">Reply</a>
</td>
</tr>
{/foreach}
</tbody>
</table>

{literal}
<script>
cj(function($) {
  $('#todo').dataTable();
  $('.button_close').click(function(){
    $tr=$(this).closest("tr");
    id= $tr.data("id");
    CRM.api("Activity","create", {activity_status_id:2,id:id,sequential:true},
      {success:function () {
         $tr.slideUp("slow");
      }
    });
  }); 
});

</script>
{/literal}
{include file="CRM/common/wysiwyg.tpl" includeWysiwygEditor=true}
{include file="CRM/common/crmeditable.tpl"}
