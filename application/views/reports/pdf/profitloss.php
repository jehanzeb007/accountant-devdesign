<!-- PDF style -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/pdfStyle.css">
<?php
function account_st_short($account, $c = 0, $THIS, $dc_type)
{
  	$CI =& get_instance();

	$counter = $c;
	if ($account->id > 4)
	{
		if ($dc_type == 'D' && $account->cl_total_dc == 'C' && $CI->functionscore->calculate($account->cl_total, 0, '!=')) {
			echo '<tr class="tr-group dc-error">';
		} else if ($dc_type == 'C' && $account->cl_total_dc == 'D' && $CI->functionscore->calculate($account->cl_total, 0, '!=')) {
			echo '<tr class="tr-group dc-error">';
		} else {
			echo '<tr class="tr-group">';
		}

		echo '<td class="td-group width-70">';
		echo print_space($counter);
		echo ($CI->functionscore->toCodeWithNamePDF($account->code, $account->name, $counter));
		echo '</td>';

		echo '<td class="text-right width-30">';
		echo $CI->functionscore->toCurrency($account->cl_total_dc, $account->cl_total);
		// echo print_space($counter);
		echo '</td>';

		echo '</tr>';
	}
	foreach ($account->children_groups as $id => $data)
	{
		$counter++;
		account_st_short($data, $counter, $THIS, $dc_type);
		$counter--;
	}
	if (count($account->children_ledgers) > 0)
	{
		$counter++;
		foreach ($account->children_ledgers as $id => $data)
		{
			if ($dc_type == 'D' && $data['cl_total_dc'] == 'C' && $CI->functionscore->calculate($data['cl_total'], 0, '!=')) {
				echo '<tr class="tr-ledger dc-error">';
			} else if ($dc_type == 'C' && $data['cl_total_dc'] == 'D' && $CI->functionscore->calculate($data['cl_total'], 0, '!=')) {
				echo '<tr class="tr-ledger dc-error">';
			} else {
				echo '<tr class="tr-ledger">';
			}

			echo '<td class="td-ledger width-70">';
			echo print_space($counter);
			echo $CI->functionscore->toCodeWithNamePDF($data['code'], $data['name'], $counter);
			echo '</td>';

			echo '<td class="text-right width-30">';
			echo $CI->functionscore->toCurrency($data['cl_total_dc'], $data['cl_total']);
			// echo print_space($counter);
			echo '</td>';

			echo '</tr>';
		}
	$counter--;
	}
}

function print_space($count)
{
	$html = '';
	for ($i = 1; $i <= $count; $i++) {
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	return $html;
}

$gross_total = 0;
$positive_gross_pl = 0;
$net_expense_total = 0;
$net_income_total = 0;
$positive_net_pl = 0;

?>

				
<div id="section-to-print">
	<div class="subtitle text-center">
		<?php echo $subtitle ?>
	</div>
	<table style="width: 100%;">
		<tr>
			<!-- Gross Expenses -->
			<td class="" style="width: 50%;">
				<table class="stripped" style="width: 100%;">
					<tr>
						<th><?php echo lang('profit_loss_ge_dr'); ?></th>
						<th class="text-right"><?php echo ('Amount'); ?><?php echo ' (' . $this->mAccountSettings->currency_symbol . ')'; ?></th>
					</tr>
					<?php echo account_st_short($pandl['gross_expenses'], $c = -1, $this, 'D'); ?>
				</table>
			</td>

			<!-- Gross Incomes -->
			<td class="table-top">
				<table class="stripped" style="width: 100%;">
					<tr>
						<th><?php echo lang('profit_loss_gi_cr'); ?></th>
						<th class="text-right"><?php echo ('Amount'); ?><?php echo ' (' . $this->mAccountSettings->currency_symbol . ')'; ?></th>
					</tr>
					<?php echo account_st_short($pandl['gross_incomes'], $c = -1, $this, 'C'); ?>
				</table>
			</td>
		</tr>

		<tr>
			<td class="" style="width: 50%;">
				<!-- <span class="report-tb-pad"></span> -->
				<table class="stripped report-tb-pad">
					<?php
					/* Gross Expense Total */
					$gross_total = $pandl['gross_expense_total'];
					if ($this->functionscore->calculate($pandl['gross_expense_total'], 0, '>=')) {
						echo '<tr class="bold-text">';
						echo '<td class="width-70">' . lang('profit_loss_tge') . '</td>';
						echo '<td class="text-right width-30">' . $this->functionscore->toCurrency('D', $pandl['gross_expense_total']) . '</td>';
						echo '</tr>';
					} else {
						echo '<tr class="dc-error bold-text">';
						echo '<td class="width-70">' . lang('profit_loss_tge') . '</td>';
						echo '<td class="text-right show-tooltip width-30" data-toggle="tooltip" data-original-title="Expecting Dr Balance">' . $this->functionscore->toCurrency('D', $pandl['gross_expense_total']) . '</td>';
						echo '</tr>';
					}
					?>
					<tr class="bold-text">
						<?php
						/* Gross Profit C/D */
						if ($this->functionscore->calculate($pandl['gross_pl'], 0, '>=')) {
							echo '<td class="width-70">' . lang('profit_loss_gp') . '</td>';
							echo '<td class="text-right width-30">' . $this->functionscore->toCurrency('', $pandl['gross_pl']) . '</td>';
							$gross_total = $this->functionscore->calculate($gross_total, $pandl['gross_pl'], '+');
						} else {
							echo '<td class="width-70">&nbsp</td>';
							echo '<td class="width-30">&nbsp</td>';
						}
						?>
					</tr>
					<tr class="bold-text bg-filled">
						<td class="width-70"><?php echo lang('profit_loss_t'); ?></td>
						<td class="text-right  width-30"><?php echo $this->functionscore->toCurrency('D', $gross_total); ?></td>
					</tr>
				</table>
			</td>

			<td class="">
				<!-- <span class="report-tb-pad"></span> -->
				<table class="stripped report-tb-pad">
					<?php
					/* Gross Income Total */
					$gross_total = $pandl['gross_income_total'];
					if ($this->functionscore->calculate($pandl['gross_income_total'], 0, '>=')) {
						echo '<tr class="bold-text">';
						echo '<td class="width-70">' . lang('profit_loss_tgi') . '</td>';
						echo '<td class="text-right width-30">' . $this->functionscore->toCurrency('C', $pandl['gross_income_total']) . '</td>';
						echo '</tr>';
					} else {
						echo '<tr class="dc-error bold-text">';
						echo '<td class="width-70">' . lang('profit_loss_tgi') . '</td>';
						echo '<td class="text-right show-tooltip width-30" data-toggle="tooltip" data-original-title="Expecting Cr Balance">' . $this->functionscore->toCurrency('C', $pandl['gross_income_total']) . '</td>';
						echo '</tr>';
					}
					?>
					<tr class="bold-text">
						<?php
						/* Gross Loss C/D */
						if ($this->functionscore->calculate($pandl['gross_pl'], 0, '>=')) {
							echo '<td class="width-70">&nbsp</td>';
							echo '<td class="width-30">&nbsp</td>';
						} else {
							echo '<td class="width-70">' . lang('profit_loss_glcd') . '</td>';
							$positive_gross_pl = $this->functionscore->calculate($pandl['gross_pl'], 0, 'n');
							echo '<td class="text-rightwidth-30">' . $this->functionscore->toCurrency('', $positive_gross_pl) . '</td>';
							$gross_total = $this->functionscore->calculate($gross_total, $positive_gross_pl, '+');
						}
						?>
					</tr>
					<tr class="bold-text bg-filled">
						<td class="width-70"><?php echo lang('profit_loss_t'); ?></td>
						<td class="text-right width-30"><?php echo $this->functionscore->toCurrency('C', $gross_total); ?></td>
					</tr>
				</table>
			</td>
		</tr>

		<!-- Net Profit and Loss -->
		<tr>
			<td class="table-top" style="width: 50%;">
				<!-- <span class="report-tb-pad"></span> -->
				<table class="stripped report-tb-pad">
					<tr>
						<th class="width-70"><?php echo lang('profit_loss_ne'); ?></th>
						<th class="text-right width-30"><?php echo lang('amount'); ?><?php echo ' (' . $this->mAccountSettings->currency_symbol . ')'; ?></th>
					</tr>
					<?php echo account_st_short($pandl['net_expenses'], $c = -1, $this, 'D'); ?>
				</table>
			</td>

			<td class="table-top">
				<!-- <span class="report-tb-pad"></span> -->
				<table class="stripped report-tb-pad">
					<tr>
						<th class="width-70"><?php echo lang('profit_loss_ni'); ?></th>
						<th class="text-right width-30"><?php echo lang('amount'); ?><?php echo ' (' . $this->mAccountSettings->currency_symbol . ')'; ?></th>
					</tr>
					<?php echo account_st_short($pandl['net_incomes'], $c = -1, $this, 'C'); ?>
				</table>
			</td>
		</tr>

		<tr>
			<td class="" style="width: 50%;">
				<!-- <span class="report-tb-pad"></span> -->
				<table class="stripped">
					<?php
					/* Net Expense Total */
					$net_expense_total = $pandl['net_expense_total'];
					if ($this->functionscore->calculate($pandl['net_expense_total'], 0, '>=')) {
						echo '<tr class="bold-text">';
						echo '<td class="width-70">' . lang('profit_loss_te') . '</td>';
						echo '<td class="text-right width-30">' . $this->functionscore->toCurrency('D', $pandl['net_expense_total']) . '</td>';
						echo '</tr>';
					} else {
						echo '<tr class="dc-error bold-text">';
						echo '<td class="width-70">' . lang('profit_loss_te') . '</td>';
						echo '<td class="text-right show-tooltip width-30" data-toggle="tooltip" data-original-title="Expecting Dr Balance">' . $this->functionscore->toCurrency('D', $pandl['net_expense_total']) . '</td>';
						echo '</tr>';
					}
					?>
					<tr class="bold-text">
						<?php
						/* Gross Loss B/D */
						if ($this->functionscore->calculate($pandl['gross_pl'], 0, '>=')) {
							echo '<td class="width-70">&nbsp</td>';
							echo '<td class="width-30">&nbsp</td>';
						} else {
							echo '<td class="width-70">' . lang('profit_loss_glbd') . '</td>';
							$positive_gross_pl = $this->functionscore->calculate($pandl['gross_pl'], 0, 'n');
							echo '<td class="text-right width-30">' . $this->functionscore->toCurrency('', $positive_gross_pl) . '</td>';
							$net_expense_total = $this->functionscore->calculate($net_expense_total, $positive_gross_pl, '+');
						}
						?>
					</tr>
					<tr class="bold-text ok-text">
						<?php
						/* Net Profit */
						if ($this->functionscore->calculate($pandl['net_pl'], 0, '>=')) {
							echo '<td class="dc-ok width-70">' . lang('profit_loss_np') . '</td>';
							echo '<td class="text-right dc-ok width-30">' . $this->functionscore->toCurrency('', $pandl['net_pl']) . '</td>';
							$net_expense_total = $this->functionscore->calculate($net_expense_total, $pandl['net_pl'], '+');
						} else {
							echo '<td class="width-70">&nbsp</td>';
							echo '<td class="width-30">&nbsp</td>';
						}
						?>
					</tr>
					<tr class="bold-text bg-filled">
						<td class="width-70"><?php echo lang('profit_loss_t'); ?></td>
						<td class="text-right width-30"><?php echo $this->functionscore->toCurrency('D', $net_expense_total); ?></td>
					</tr>
				</table>
			</td>

			<td class="">
				<!-- <span class="report-tb-pad"></span> -->
				<table class="stripped">
					<?php
					/* Net Income Total */
					$net_income_total = $pandl['net_income_total'];
					if ($this->functionscore->calculate($pandl['net_income_total'], 0, '>=')) {
						echo '<tr class="bold-text">';
						echo '<td class="width-70">' . lang('profit_loss_ti') . '</td>';
						echo '<td class="text-right width-30">' . $this->functionscore->toCurrency('C', $pandl['net_income_total']) . '</td>';
						echo '</tr>';
					} else {
						echo '<tr class="dc-error bold-text">';
						echo '<td class="width-70">' . lang('profit_loss_ti') . '</td>';
						echo '<td class="text-right show-tooltip width-30" data-toggle="tooltip" data-original-title="Expecting Cr Balance">' . $this->functionscore->toCurrency('C', $pandl['net_income_total']) . '</td>';
						echo '</tr>';
					}
					?>
					<tr class="bold-text">
						<?php
						/* Gross Profit B/D */
						if ($this->functionscore->calculate($pandl['gross_pl'], 0, '>=')) {
							$net_income_total = $this->functionscore->calculate($net_income_total, $pandl['gross_pl'], '+');
							echo '<td class="width-70">' . lang('profit_loss_gpbd') . '</td>';
							echo '<td class="text-right width-30">' .  $this->functionscore->toCurrency('', $pandl['gross_pl']) . '</td>';
						} else {
							echo '<td class="width-70">&nbsp</td>';
							echo '<td class="width-30">&nbsp</td>';
						}
						?>
					</tr>
					<tr class="bold-text ok-text">
						<?php
						/* Net Loss */
						if ($this->functionscore->calculate($pandl['net_pl'], 0, '>=')) {
							echo '<td class="width-70">&nbsp</td>';
							echo '<td class="width-30">&nbsp</td>';
						} else {
							echo '<td class="dc-ok width-70">' . lang('profit_loss_nl') . '</td>';
							$positive_net_pl = $this->functionscore->calculate($pandl['net_pl'], 0, 'n');
							echo '<td class="text-right dc-ok" width-30>' . $this->functionscore->toCurrency('', $positive_net_pl) . '</td>';
							$net_income_total = $this->functionscore->calculate($net_income_total, $positive_net_pl, '+');
						}
						?>
					</tr>
					<tr class="bold-text bg-filled">
						<td class="width-70"><?php echo lang('profit_loss_t'); ?></td>
						<td class="text-right width-30"><?php echo $this->functionscore->toCurrency('C', $net_income_total); ?></td>
					</tr>
				</table>
			</td>
		</tr> 
	</table>
</div>
           
