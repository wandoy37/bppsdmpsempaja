<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>

<body>
    <form action="{{ route('logout') }}" id="logout-form" method="POST">
        @csrf
    </form>
    <h1>Dashboard Page</h1>
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
</body>

</html>
