<!-- PDF style -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/pdfStyle.css">

<?php if ($showEntries) {  ?>
	<div class="subtitle text-center">
		<?php echo $subtitle; ?>
	</div>
	<div class="row" style="margin-bottom: 10px;">
		<div class="col-md-6">
			<table class="summary stripped table-condensed">
				<tr>
					<td class="td-fixwidth-summary"><?php echo ('Bank or cash account'); ?></td>
					<td>

						<?php
							if ($ledger_data['type'] == 1) {
								echo lang('yes');
							} else {
								echo lang('no');
							}
						?>
					</td>
				</tr>
				<tr>
					<td class="td-fixwidth-summary"><?php echo ('Notes'); ?></td>
					<td><?php echo ($ledger_data['notes']); ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<table class="summary stripped table-condensed">
				<tr>
					<td class="td-fixwidth-summary"><?php echo $opening_title; ?></td>
					<td><?php echo $this->functionscore->toCurrency($op['dc'], $op['amount']); ?></td>
				</tr>
				<tr>
					<td class="td-fixwidth-summary"><?php echo $closing_title; ?></td>
					<td><?php echo $this->functionscore->toCurrency($cl['dc'], $cl['amount']); ?></td>
				</tr>
			</table>
		</div>
	</div>
	<table class="stripped" style="width: 100%">
		<thead>
			<tr>
				<th><?php echo lang('date'); ?></th>
				<th><?php echo lang('number'); ?></th>
				<th><?php echo lang('ledger'); ?></th>
				<th><?php echo lang('entries_views_index_th_type'); ?></th>
				<th><?php echo lang('entries_views_index_th_tag'); ?></th>
				<th><?php echo lang('entries_views_index_th_debit_amount'); ?><?php echo ' (' . $this->mAccountSettings->currency_symbol . ')'; ?></th>
				<th><?php echo lang('entries_views_index_th_credit_amount'); ?><?php echo ' (' . $this->mAccountSettings->currency_symbol . ')'; ?></th>
			</tr>
		</thead>
		<?php
			/* Show the entries table */
			foreach ($entries as $entry) {
				$et = $this->DB1->where('id', $entry['entrytype_id'])->get('entrytypes')->row_array();
				$entryTypeName = $et['name'];
				$entryTypeLabel = $et['label'];

				echo '<tr>';
				echo '<td>' . $this->functionscore->dateFromSql($entry['date']) . '</td>';
				echo '<td>' . ($this->functionscore->toEntryNumber($entry['number'], $entry['entrytype_id'])) . '</td>';
				echo '<td>' . ($this->functionscore->entryLedgers($entry['id'])) . '</td>';
				echo '<td>' . ($entryTypeName) . '</td>';
				echo '<td>' . $this->functionscore->showTag($entry['tag_id'])  . '</td>';
				if ($entry['dc'] == 'D') {
					echo '<td>' . $this->functionscore->toCurrency('D', $entry['amount']) . '</td>';
					echo '<td>-</td>';
				} else if ($entry['dc'] == 'C') {
					echo '<td>-</td>';
					echo '<td>' . $this->functionscore->toCurrency('C', $entry['amount']) . '</td>';
				} else {
					echo '<td>' . lang('error') . '</td>';
					echo '<td>' . lang('error') . '</td>';
				}
				?>			
				<?php
				echo '</tr>';
			}
		?>
	</table>
<?php } ?>