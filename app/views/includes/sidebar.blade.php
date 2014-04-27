<nav id="sidebar-nav">
	<?php $userid = Session::get('userid');
	$user = User::find($userid);
	?>
	<h3>{{ $user->name }}</h3>
</nav>
