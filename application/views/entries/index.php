<script type="text/javascript">
	$(document).ready(function () {

		/* Datatables */
	    table = $('.stripped').DataTable({ 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        'displayLength': site.msettings.row_count,
	        "order": [[0, "asc"]], //Initial no order.
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?= base_url('entries/getEntries') ?>",
	            "type": "POST"
	        },
	        "columns": [
	        	{
	        		data: 'date'
	        	},
		        {
		        	data: 'number'
		        },
		        {
		        	data: 'id',
		        	"orderable": false
		        },
		        {
		        	data: 'entryTypeName'
		        },
		        {
		        	data: 'tag_id'
		        },
		        {
		        	data: 'dr_total'
		        },
	        	{
	        		data: 'cr_total'
	        	},
	        	{
	        		data: 'Actions',
	        		"orderable": false
	        	},
	        ]
	    });
    });
</script>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary card-outline">
				<div class="card-header with-border">
					<h1 class="card-title"><?= lang('entries_views_index_title'); ?></h1>
					<div class="btn-group float-right">
	                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown"><i class="fas fa-plus-square"></i> <?= lang('entries_views_index_add_entry_btn'); ?></button>
	                    <div class="dropdown-menu" role="menu">
	                    	<?php
	                    		if ($this->softDeleteSupported('entrytypes')) {
	                    			$this->DB1->where('deleted_at', null);
	                    		}
	                    		foreach($this->DB1->get('entrytypes')->result_array() as $entrytype):
	                    	?>
								<a class="dropdown-item" href="<?= base_url(); ?>entries/add/<?=$entrytype['label']?>"><?= $entrytype['name']; ?></a>
							<?php endforeach; ?>
	                    </div>
	                </div>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<table class="stripped" id="entries_table">
						<thead>
							<tr>
								<th><?= lang('entries_views_index_th_date'); ?></th>
								<th><?= lang('entries_views_index_th_number'); ?></th>
								<th><?= lang('entries_views_index_th_ledger'); ?></th>
								<th><?= lang('entries_views_index_th_type'); ?></th>
								<th><?= lang('entries_views_index_th_tag'); ?></th>
								<th><?= lang('entries_views_index_th_debit_amount'); ?></th>
								<th><?= lang('entries_views_index_th_credit_amount'); ?></th>
								<th><?= lang('entries_views_index_th_actions'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								// foreach ($entries as $entry) {
								// 	$this->DB1->where('id', $entry['entrytype_id']);
								// 	$q = $this->DB1->get('entrytypes')->row();
								// 	$entryTypeName = $q->name;
								// 	$entryTypeLabel = $q->label;
							?>
							<!-- <tr>
								<td><?=  $this->functionscore->dateFromSql($entry['date']) ?></td>
								<td><?= ($this->functionscore->toEntryNumber($entry['number'], $entry['entrytype_id'])) ?></td>
								<td><?= ($this->functionscore->entryLedgers($entry['id'])) ?></td>
								<td><?= ($entryTypeName) ?></td>
								<td><?= $this->functionscore->showTag($entry['tag_id']) ?></td>
								<td><?= $this->functionscore->toCurrency('D', $entry['dr_total']) ?></td>
								<td><?= $this->functionscore->toCurrency('C', $entry['cr_total']) ?></td>
								<td>
									<a href="<?= base_url();?>entries/view/<?= ($entryTypeLabel); ?>/<?= $entry['id']; ?>" style="padding-right: 5px;" title="<?= lang('entries_views_index_th_actions_view_btn'); ?>"><i class="fas fa-eye"></i></a>
									<a href="<?= base_url();?>entries/edit/<?= ($entryTypeLabel); ?>/<?= $entry['id']; ?>" style="padding-right: 1px;" title="<?= lang('entries_views_index_th_actions_edit_btn'); ?>"><i class="fas fa-edit"></i></a>
									<a href="<?= base_url();?>entries/delete/<?= ($entryTypeLabel); ?>/<?= $entry['id']; ?>" title="<?= lang('entries_views_index_th_actions_delete_btn'); ?>"><i class="fas fa-trash"></i></a>
								</td>
							</tr> -->
							<?php // } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>