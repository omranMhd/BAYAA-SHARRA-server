<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body class="antialiased">
    <div style="background-color: #d1deed; padding:30px;">
        <!-- <img /> -->
        <div style="width: 50%; height: 200px; background-color: #ffffff; margin: auto ;margin-top:200px;padding:30px;">

            <h1 style="background-color: blue; color:aliceblue">BAYAA SHARRA</h1>
            <P>use this code to verify your account:</P>
            <h2 style="color:red">{{$activationCode}}</h2>
        </div>
    </div>
</body>

</html>