<div class="topbar">
  <div class="fill">
    <div class="container">
      <a class="brand" href="#">WiCS | Admin</a>
      <ul class="nav">
      	<li<?=($active=='admin'?' class="active"':'');?>><?=HTML::link_to_adminindex('Home');?></li>
        <li<?=($active=='users'?' class="active"':'');?>><?=HTML::link_to_adminusers('Users');?></li>
        <li<?=($active=='roles'?' class="active"':'');?>><?=HTML::link_to_adminroles('Roles');?></li>
        <li<?=($active=='posts'?' class="active"':'');?>><?=HTML::link_to_adminposts('Posts');?></li>
        <li<?=($active=='events'?' class="active"':'');?>><?=HTML::link_to_adminevents('Events');?></li>
      </ul>
    </div>
  </div>
</div>
