
	@include('partials._head')
	
		@include('partials._javascript')
	<body >

		@include('partials._nav')

		<div class="container">
			@include('partials._messages')
	
			@yield('content')

			@include('partials._footer')
			
		</div>
		<!-- end of .container -->




<!--Scripts-->
		@include('partials._scripts')


		

	</body>

	</html>