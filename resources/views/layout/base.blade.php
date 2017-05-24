<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/app.css') }}"/>
    <script>
        /* I had to add this fix because framework has a bug (?) and JS breaks without this. */

        window.Laravel = <?php echo json_encode( [
			'csrfToken' => csrf_token(),
		] ); ?>
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    @yield('head')
</head>
<body data-spy="scroll" data-target="#navbar-main">
@yield('content')
</body>
</html>

