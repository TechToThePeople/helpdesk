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
<tr>
  <td>{$a.subject}</td>
  <td>{$a.activity_date_time}</td>
  <td>
<a href="#" class="button button_close">Close</a>
<a href="#" class="button button_assign">Assign</a>
<a href="#" class="button button_reply">Reply</a>
 
</td>
</tr>
{/foreach}
</tbody>
</table>

{literal}
<script>
cj(function($) {
    $('#todo').dataTable();
} );

</script>
{/literal}

