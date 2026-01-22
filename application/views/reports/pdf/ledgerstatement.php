<!-- PDF style -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/pdfStyle.css">

<?php if ($showEntries) :  ?>
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
							echo ($ledger_data['type'] == 1) ? 'Yes' : 'No';
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
				<th><?php echo lang('type'); ?></th>
				<th><?php echo lang('tag'); ?></th>
				<th><?php echo lang('dr_amount'); ?><?php echo ' (' . $this->mAccountSettings->currency_symbol . ')'; ?></th>
				<th><?php echo lang('cr_amount'); ?><?php echo ' (' . $this->mAccountSettings->currency_symbol . ')'; ?></th>
				<th><?php echo lang('balance'); ?><?php echo ' (' . $this->mAccountSettings->currency_symbol . ')'; ?></th>
			</tr>
		</thead>
		<?php
			/* Current opening balance */
			$entry_balance['amount'] = $current_op['amount'];
			$entry_balance['dc'] = $current_op['dc'];
			echo '<tr class="tr-highlight">';
			echo '<td colspan="7">';
			echo lang('curr_opening_balance');
			echo '</td>';
			echo '<td>' . $this->functionscore->toCurrency($op['dc'], $op['amount']) . '</td>';
			echo '<td></td>';
			echo '</tr>';
		?>

		<?php
			/* Show the entries table */
			foreach ($entries as $entry) {
				/* Calculate current entry balance */
				$entry_balance = $this->functionscore->calculate_withdc(
					$entry_balance['amount'], $entry_balance['dc'],
					$entry['amount'], $entry['dc']
				);

				$et = $this->DB1->where('id', $entry['entrytype_id'])->get('entrytypes')->row_array();
				$entryTypeName = $et['name'];
				$entryTypeLabel = $et['label'];

				/* Negative balance if its a cash or bank account and balance is Cr */
				if ($ledger_data['type'] == 1) {
					if ($entry_balance['dc'] == 'C' && $entry_balance['amount'] != '0.00') {
						echo '<tr class="error-text">';
					} else {
						echo '<tr>';
					}
				} else {
					echo '<tr>';
				}

				echo '<td>' . $this->functionscore->dateFromSql($entry['date']) . '</td>';
				echo '<td>' . ($this->functionscore->toEntryNumber($entry['number'], $entry['entrytype_id'])) . '</td>';
				echo '<td>' . ($this->functionscore->entryLedgers($entry['id'])) . '</td>';
				echo '<td>' . ($entryTypeName) . '</td>';
				echo '<td>' . $this->functionscore->showTag($entry['tag_id'])  . '</td>';
				if ($entry['dc'] == 'D') {
					echo '<td>' . $this->functionscore->toCurrency('D', $entry['amount']) . '</td>';
					echo '<td>' . '</td>';
				} else if ($entry['dc'] == 'C') {
					echo '<td>' . '</td>';
					echo '<td>' . $this->functionscore->toCurrency('C', $entry['amount']) . '</td>';
				} else {
					echo '<td>' . lang('error') . '</td>';
					echo '<td>' . lang('error') . '</td>';
				}

				echo '<td>' . $this->functionscore->toCurrency($entry_balance['dc'], $entry_balance['amount']) . '</td>';

				// echo '<td>';
				?>
					<!-- <a href="<?= base_url();?>entries/view/<?= ($entryTypeLabel); ?>/<?= $entry['id']; ?>" class="no-hover" escape="false"><i class="glyphicon glyphicon-log-in"></i> <?= lang('view');?></a>
					<span class="link-pad"></span>
					<a href="<?= base_url();?>entries/edit/<?= ($entryTypeLabel); ?>/<?= $entry['id']; ?>" class="no-hover" escape="false"><i class="glyphicon glyphicon-edit"></i> <?= lang('edit');?></a>
					<span class="link-pad"></span>
					<a href="<?= base_url();?>entries/delete/<?= ($entryTypeLabel); ?>/<?= $entry['id']; ?>" class="no-hover" escape="false"><i class="glyphicon glyphicon-trash"></i> <?= lang('delete');?></a>
					 -->
				<?php
				// echo '</td>';
				echo '</tr>';
			}
		?>

		<?php
			/* Current closing balance */
			echo '<tr class="tr-highlight">';
			echo '<td colspan="7">';
			echo lang('curr_closing_balance');
			echo '</td>';
			echo '<td>' . $this->functionscore->toCurrency($cl['dc'], $cl['amount']) . '</td>';
			echo '<td></td>';
			echo '</tr>';
		?>
	</table>
<?php endif; ?>