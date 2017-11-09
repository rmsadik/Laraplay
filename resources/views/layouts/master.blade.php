<!doctype html>
<html>
<head>
   <h1> Mail Chimp API - @yield('title') </h1>
</head>
<body>
	<div>
		@include('layouts.menu')
	</div>
    <div class="container">

        <div id="main" class="row">

                @yield('content')

        </div>

    </div>
</body>
</html>