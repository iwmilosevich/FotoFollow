<nav id="sidebar-nav">
	{{ Form::select('subscribeFeed', $subscribed, Input::old('subscribeFeed')) }}
</nav>
