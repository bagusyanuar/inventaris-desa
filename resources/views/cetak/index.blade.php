<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap3.min.css" rel="stylesheet">
    <style>
        .report-title {
            font-size: 14px;
            font-weight: bolder;
        }

        .f-bold {
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            height: 2cm;
        }
    </style>
</head>
<body>
<div style="position: relative">
    <img src={{ public_path('assets/icon/logo-sawahan.png') }} height="50" style="position: absolute; top: 0; left: 0">
    <div class="text-center f-bold report-title">SISTEM INFORMASI INVENTARIS DESA SAWAHAN</div>
</div>

<br/>
@yield('content')


</body>
</html>
