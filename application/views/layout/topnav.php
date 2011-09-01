<ul>
	<li<?=($selected=='index'?' class="selected"':'');?>><?=HTML::link_to_index('News');?></li>
	<li<?=($selected=='events'?' class="selected"':'');?>><?=HTML::link_to_events('Events');?></li>
	<li<?=($selected=='about'?' class="selected"':'');?>><?=HTML::link_to_about('About');?></li>
	<li<?=($selected=='photos'?' class="selected"':'');?>><?=HTML::link_to_photos('Photos');?></li>
	<li<?=($selected=='contact'?' class="selected"':'');?>><?=HTML::link_to_contact('Contact');?></li>
</ul>