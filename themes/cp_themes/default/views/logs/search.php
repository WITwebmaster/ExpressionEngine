<?php extend_template('default-nav') ?>

<div class="tbl-ctrls">
<?=form_open($form_url)?>
	<fieldset class="tbl-search right">
		<input placeholder="<?=lang('type_phrase')?>" type="text" name="search" value="<?=$search_value?>">
		<input class="btn submit" type="submit" value="<?=lang('search_logs_button')?>">
	</fieldset>
	<h1><?php echo isset($cp_heading) ? $cp_heading : $cp_page_title?></h1>
	<?php $this->view('_shared/alerts')?>
	<?php $this->view('_shared/filters'); ?>
	<section class="item-wrap log">
		<?php if (empty($rows)): ?>
			<p class="no-results"><?=lang('no_search_logs_found')?></p>
		<?php else: ?>
			<?php foreach($rows as $row): ?>

			<div class="item">
				<ul class="toolbar">
					<li class="remove"><a href="" class="m-link" rel="modal-confirm-<?=$row['id']?>" title="remove"></a></li>
				</ul>
				<h3><b><?=lang('date_logged')?>:</b> <?=$row['search_date']?>, <b><?=lang('site')?>:</b> <?=$row['site_label']?><br><b><?=lang('username')?>:</b> <?=$row['username']?>, <b><abbr title="<?=lang('internet_protocol')?>"><?=lang('ip')?></abbr>:</b> <?=$row['ip_address']?></h3>
				<div class="message">
					<p><?=lang('searched_for')?> "<b><?=$row['search_terms']?></b>" <?=lang('in')?> <b><?=$row['search_type']?></b></p>
				</div>
			</div>

			<?php endforeach; ?>

			<?php $this->view('_shared/pagination'); ?>

			<fieldset class="tbl-bulk-act">
				<button class="btn remove m-link" rel="modal-confirm-all"><?=lang('clear_search_logs')?></button>
			</fieldset>
		<?php endif; ?>
	</section>
<?=form_close()?>
</div>