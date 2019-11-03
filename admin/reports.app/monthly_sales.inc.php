<?php
  $_GET['date_from'] = !empty($_GET['date_from']) ? date('Y-m-d 00:00:00', strtotime($_GET['date_from'])) : null;
  $_GET['date_to'] = !empty($_GET['date_to']) ? date('Y-m-d 23:59:59', strtotime($_GET['date_to'])) : date('Y-m-d H:i:s');

  if ($_GET['date_from'] > $_GET['date_to']) list($_GET['date_from'], $_GET['date_to']) = array($_GET['date_to'], $_GET['date_from']);

  $date_first_order = database::fetch(database::query("select min(date_created) from ". DB_TABLE_ORDERS ." limit 1;"));
  $date_first_order = $date_first_order['min(date_created)'];
  if (empty($date_first_order)) $date_first_order = date('Y-m-d 00:00:00');
  if ($_GET['date_from'] < $date_first_order) $_GET['date_from'] = $date_first_order;

  if ($_GET['date_from'] > date('Y-m-d H:i:s')) $_GET['date_from'] = date('Y-m-d H:i:s');
  if ($_GET['date_to'] > date('Y-m-d H:i:s')) $_GET['date_to'] = date('Y-m-d H:i:s');
?>

<style>
.border-left {
  border-left: 1px #999 dashed;
}
</style>

<div style="float: right; display: inline;">
  <?php echo functions::form_draw_form_begin('filter_form', 'get'); ?>
    <?php echo functions::form_draw_hidden_field('app'); ?>
    <?php echo functions::form_draw_hidden_field('doc'); ?>
    <table>
      <tr>
        <td><?php echo language::translate('title_date_period', 'Date Period'); ?>:</td>
        <td><?php echo functions::form_draw_month_field('date_from'); ?> - <?php echo functions::form_draw_month_field('date_to'); ?></td>
        <td><?php echo functions::form_draw_button('filter', language::translate('title_filter_now', 'Filter')); ?></td>
      </tr>
    </table>
  <?php echo functions::form_draw_form_end(); ?>
</div>

<h1 style="margin-top: 0px;"><?php echo $app_icon; ?> <?php echo language::translate('title_monthly_sales', 'Monthly Sales'); ?></h1>

<table width="100%" align="center" class="dataTable">
  <tr class="header">
    <th width="100%"><?php echo language::translate('title_month', 'Month'); ?></th>
    <th style="text-align: center;" class="border-left"><?php echo language::translate('title_subtotal', 'Subtotal'); ?></th>
    <th style="text-align: center;" class="border-left"><?php echo language::translate('title_shipping_fees', 'Shipping Fees'); ?></th>
    <th style="text-align: center;" class="border-left"><?php echo language::translate('title_payment_fees', 'Payment Fees'); ?></th>
    <th style="text-align: center;" class="border-left"><?php echo language::translate('title_total', 'Total'); ?></th>
    <th style="text-align: center;"><?php echo language::translate('title_tax', 'Tax'); ?></th>
  </tr>
<?php
  $order_statuses = array();
  $orders_status_query = database::query(
    "select id from ". DB_TABLE_ORDER_STATUSES ." where is_sale;"
  );
  while ($order_status = database::fetch($orders_status_query)) {
    $order_statuses[] = (int)$order_status['id'];
  }

  $timestamp_from = mktime(0, 0, 0, date('m', strtotime($_GET['date_from'])), 1, date('Y', strtotime($_GET['date_from'])));
  $timestamp_to = mktime(23, 59, 59, date('m', strtotime($_GET['date_to'])), date('t', strtotime($_GET['date_to'])), date('Y', strtotime($_GET['date_to'])));

  for ($timestamp = mktime(0, 0, 0, date('m', strtotime($_GET['date_to'])), date(1, strtotime($_GET['date_to'])), date('Y', strtotime($_GET['date_to']))); $timestamp >= $timestamp_from; $timestamp = strtotime('-1 month', $timestamp)) {

    $orders_query = database::query(
      "select
        sum(o.payment_due) - sum(o.tax_total) as total_sales,
        sum(o.tax_total) as total_tax,
        sum(otst.value) as total_subtotal,
        sum(otsf.value) as total_shipping_fees,
        sum(otpf.value) as total_payment_fees
      from ". DB_TABLE_ORDERS ." o
      left join (
        select order_id, value from ". DB_TABLE_ORDERS_TOTALS ."
        where module_id = 'ot_subtotal'
      ) otst on (o.id = otst.order_id)
      left join (
        select order_id, value from ". DB_TABLE_ORDERS_TOTALS ."
        where module_id = 'ot_shipping_fee'
      ) otsf on (o.id = otsf.order_id)
      left join (
        select order_id, value from ". DB_TABLE_ORDERS_TOTALS ."
        where module_id = 'ot_payment_fee'
      ) otpf on (o.id = otpf.order_id)
      where o.order_status_id in ('". implode("', '", $order_statuses) ."')
      and o.date_created >= '". date('Y-m-1 00:00:00', $timestamp) ."'
      and o.date_created <= '". date('Y-m-t 23:59:59', $timestamp) ."';"
    );

    $orders = database::fetch($orders_query);
?>
  <tr class="row">
    <td><?php echo ucfirst(language::strftime('%B, %Y', $timestamp)); ?></td>
    <td style="text-align: right;" class="border-left"><?php echo currency::format($orders['total_subtotal'], false, false, settings::get('store_currency_code')); ?></td>
    <td style="text-align: right;" class="border-left"><?php echo currency::format($orders['total_shipping_fees'], false, false, settings::get('store_currency_code')); ?></td>
    <td style="text-align: right;" class="border-left"><?php echo currency::format($orders['total_payment_fees'], false, false, settings::get('store_currency_code')); ?></td>
    <td style="text-align: right;" class="border-left"><strong><?php echo currency::format($orders['total_sales'], false, false, settings::get('store_currency_code')); ?></strong></td>
    <td style="text-align: right;"><?php echo currency::format($orders['total_tax'], false, false, settings::get('store_currency_code')); ?></td>
  </tr>
<?php
    if (!isset($total)) $total = array();
    foreach (array_keys($orders) as $key) {
      if (!isset($total[$key])) $total[$key] = $orders[$key];
      else $total[$key] += $orders[$key];
    }
  }

  if (!empty($total)) {
?>
  <tr class="footer">
    <td style="text-align: right;"><?php echo strtoupper(language::translate('title_total', 'Total')); ?></td>
    <td style="text-align: right;" class="border-left"><?php echo currency::format($total['total_subtotal'], false, false, settings::get('store_currency_code')); ?></td>
    <td style="text-align: right;" class="border-left"><?php echo currency::format($total['total_shipping_fees'], false, false, settings::get('store_currency_code')); ?></td>
    <td style="text-align: right;" class="border-left"><?php echo currency::format($total['total_payment_fees'], false, false, settings::get('store_currency_code')); ?></td>
    <td style="text-align: right;" class="border-left"><strong><?php echo currency::format($total['total_sales'], false, false, settings::get('store_currency_code')); ?></strong></td>
    <td style="text-align: right;"><?php echo currency::format($total['total_tax'], false, false, settings::get('store_currency_code')); ?></td>
  </tr>
<?php
  }
?>
</table>