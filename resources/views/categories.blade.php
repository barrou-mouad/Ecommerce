<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/monstyle.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@1,300&display=swap" rel="stylesheet">
    <style>
        .cat {
        text-align: center;
        padding: 10px;
        font-family: 'Karla', sans-serif;
        font-size: 20px;
        font-weight: 200;
        /*  transition: background-color 1s; */
        }

        .cat:hover {
            background-color: aqua;
            border-radius: 30px;
            padding: 10px;
            cursor: pointer;
            font-family: 'Karla', sans-serif;
        }
        .selected{
            background-color: orangered;
            border-radius: 30px;
            padding: 10px;
            cursor: pointer;
            font-family: 'Karla', sans-serif;
        }
        .selected:hover{
            background-color: orangered !important;
            border-radius: 30px !important;
            padding: 10px;
            cursor: pointer;
            font-family: 'Karla', sans-serif;
        }
    </style>
</head>
<body>
    <p></p>
@foreach ($categories as $categorie)
<p class="cat" onclick="getProds('{{ URL::asset('getproduits')}}',{{$categorie->id}})">{{$categorie->title}}</p>
@endforeach
</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</html>
