<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        table, td, th {
            border: 1px solid;
            padding-left: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        .fondo {
            background-color: #0d6efd;
            color: white;
            line-height:25px;
            padding-left: 3px;
        }
    </style>
</head>
<body>
    @include('creditos.tabla-credito',['credito'=>$credito])
</body>
</html>