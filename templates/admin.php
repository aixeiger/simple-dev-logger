<?php
use SDevLogger\Facades\Logger;

$data = Logger::getData(500);
?>
<div class="wrap">
	<h2 style="margin-bottom: 20px;">Logs</h2>
	<p>Usage: <span style="background: #fff; padding: 5px 10px; margin: 0 5px; border: 1px solid #ccc; font-weight: 500; font-size: 14px;">SDLO::log(string, string|int|array|obj, optional-string|int|array|obj);</span> or <span style="background: #fff; padding: 5px 10px; margin: 0 5px; border: 1px solid #ccc; font-weight: 500; font-size: 14px;">sdlo(string, string|int|array|obj, optional-string|int|array|obj);</span></p>
	<table class="wp-list-table widefat fixed striped table-view-lists posts">
		<tr>
			<th style="width: 60px;">Id</th>
			<th>Title</th>
			<th>Value</th>
			<th>Data</th>
			<th style="width: 200px;">Date</th>
		</tr>
		<?php foreach ($data as $log): ?>
		<tr>
			<td style="width: 60px;"><?php echo esc_html($log->id); ?></td>
			<td><?php echo esc_html($log->title); ?></td>
			<td><?php echo esc_html($log->value); ?></td>
			<td><?php echo esc_html($log->data); ?></td>
			<td style="width: 200px;"><?php echo esc_html($log->date_create); ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>