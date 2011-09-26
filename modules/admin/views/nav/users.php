<div class="row">
	<div class="span16">
		<ul class="tabs">
		  <li<?=($active=='manage'?' class="active"':'');?>><?=HTML::link_to_adminusers('Manage');?></li>
		  <li<?=($active=='create'?' class="active"':'');?>><?=HTML::link_to_adminuserscreate('Create');?></li>
		</ul>
	</div>
</div>