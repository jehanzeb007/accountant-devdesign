<div>
  	<h3 class="subtitle text-center"><?= ucfirst($entrytypeLabel) . ' ' . lang('entry_title') . "  #" . $entry['number'] ?></h3>
	<?php
		echo '<p>'.(lang('entries_views_views_label_number')) . ' : ' . ($this->functionscore->toEntryNumber($entry['number'], $entry['entrytype_id']));
		echo '</p>';
		echo '<p>'.(lang('entries_views_views_label_date')) . ' : ' . ($this->functionscore->dateFromSql($entry['date']));
		echo '</p>';

		echo '<table class="stripped">';

		/* Header */
		echo '<tr>';
		if ($this->mSettings->drcr_toby == 'toby') {
			echo '<th>' . lang('entries_views_views_th_to_by') . '</th>';
		} else {
			echo '<th>' . lang('entries_views_views_th_dr_cr') . '</th>';
		}
		echo '<th>' . lang('entries_views_views_th_ledger') . '</th>';
		echo '<th>' . lang('entries_views_views_th_dr_amount') . ' (' . $this->mAccountSettings->currency_symbol . ')' . '</th>';
		echo '<th>' . lang('entries_views_views_th_cr_amount') . ' (' . $this->mAccountSettings->currency_symbol . ')' . '</th>';
		echo '<th>' . lang('entries_views_views_th_narration') . '</th>';
		echo '</tr>';

		/* Intial rows */
		foreach ($curEntryitems as $row => $entryitem) {
			echo '<tr>';

			echo '<td>';
			if ($this->mSettings->drcr_toby == 'toby') {
				if ($entryitem['dc'] == 'D') {
					echo lang('entries_views_views_toby_D');
				} else {
					echo lang('entries_views_views_toby_C');
				}
			} else {
				if ($entryitem['dc'] == 'D') {
					echo lang('entries_views_views_drcr_D');
				} else {
					echo lang('entries_views_views_drcr_C');
				}
			}
			echo '</td>';

			echo '<td>';
			echo ($entryitem['ledger_name']);
			echo '</td>';

			echo '<td>';
			if ($entryitem['dc'] == 'D') {
				echo $entryitem['dr_amount'];
			} else {
				echo '';
			}
			echo '</td>';

			echo '<td>';
			if ($entryitem['dc'] == 'C') {
				echo $entryitem['cr_amount'];
			} else {
				echo '';
			}
			echo '</td>';
			echo '<td>';
			echo $entryitem['narration'];
			echo '</td>';
			echo '</tr>';
		}

		/* Total */
		echo '<tr class="bold-text">' . '<td></td>' . '<td>' . lang('entries_views_views_td_total') . '</td>' . '<td id="dr-total">' . $this->functionscore->toCurrency('D', $entry['dr_total']) . '</td>' . '<td id="cr-total">' . $this->functionscore->toCurrency('C', $entry['cr_total']) . '</td>' . '<td></td>' . '</tr>';

		/* Difference */
		if ($this->functionscore->calculate($entry['dr_total'], $entry['cr_total'], '==')) {
			/* Do nothing */
		} else {
			if ($this->functionscore->calculate($entry['dr_total'], $entry['cr_total'], '>')) {
				echo '<tr class="error-text">' . '<td></td>' . '<td>' . lang('entries_views_views_td_diff') . '</td>' . '<td id="dr-diff">' . $this->functionscore->toCurrency('D', $this->functionscore->calculate($entry['dr_total'], $entry['cr_total'], '-')) . '</td>' . '<td></td>' . '</tr>';
			} else {
				echo '<tr class="error-text">' . '<td></td>' . '<td>' . lang('entries_views_views_td_diff') . '</td>' . '<td></td>' . '<td id="cr-diff">' . $this->functionscore->toCurrency('C', $this->functionscore->calculate($entry['cr_total'], $entry['dr_total'], '-')) . '</td>' . '</tr>';

			}
		}
		echo '</table>';
		if (!empty($entry['tag_id'])) {
			echo '<br />';
			echo lang('entries_views_views_td_tag') . ' : ' . $this->functionscore->showTag($entry['tag_id']);

			echo '<br /><br />';
		}
		?>
</div>