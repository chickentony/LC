<div style="float: right;"><?php echo functions::form_draw_link_button(document::link('', array('app' => $_GET['app'], 'doc' => 'edit_supplier')), language::translate('title_add_new_supplier', 'Add New Supplier'), '', 'add'); ?></div>
<h1 style="margin-top: 0px;"><?php echo $app_icon; ?> <?php echo language::translate('title_suppliers', 'Suppliers'); ?></h1>

<?php echo functions::form_draw_form_begin('suppliers_form', 'post'); ?>
<table class="dataTable" width="100%">
  <tr class="header">
    <th><?php echo functions::draw_fonticon('fa-check-square-o fa-fw checkbox-toggle'); ?></th>
    <th width="100%"><?php echo language::translate('title_name', 'Name'); ?></th>
    <th>&nbsp;</th>
  </tr>
<?php
    $suppliers_query = database::query(
      "select id, name from ". DB_TABLE_SUPPLIERS ."
      order by name asc;"
    );

    if (database::num_rows($suppliers_query) > 0) {
      while ($supplier = database::fetch($suppliers_query)) {
?>
  <tr class="row">
    <td><?php echo functions::form_draw_checkbox('suppliers['. $supplier['id'] .']', $supplier['id']); ?></td>
    <td><a href="<?php echo document::href_link('', array('doc' => 'edit_supplier', 'supplier_id' => $supplier['id']), array('app')); ?>"><?php echo $supplier['name']; ?></a></td>
    <td><a href="<?php echo document::href_link('', array('app' => $_GET['app'], 'doc' => 'edit_supplier', 'supplier_id' => $supplier['id'])); ?>" title="<?php echo language::translate('title_edit', 'Edit'); ?>"><?php echo functions::draw_fonticon('fa-pencil'); ?></a></td>
  </tr>
<?php
      }
    }
?>
  <tr class="footer">
    <td colspan="3"><?php echo language::translate('title_suppliers', 'Suppliers'); ?>: <?php echo database::num_rows($suppliers_query); ?></td>
  </tr>
</table>

<script>
  $(".dataTable .checkbox-toggle").click(function() {
    $(this).closest("form").find(":checkbox").each(function() {
      $(this).attr('checked', !$(this).attr('checked'));
    });
    $(".dataTable .checkbox-toggle").attr("checked", true);
  });

  $('.dataTable tr').click(function(event) {
    if ($(event.target).is('input:checkbox')) return;
    if ($(event.target).is('a, a *')) return;
    if ($(event.target).is('th')) return;
    $(this).find('input:checkbox').trigger('click');
  });
</script>

<?php echo functions::form_draw_form_end(); ?>