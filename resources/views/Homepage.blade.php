@extends('layouts.homepage')

@section('head')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/articles.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="js/app.js"></script>
    <title>紙扇論壇</title>
@endsection

@section('articles')
    @extends('layouts.articles')
@endsection

@section('navbar')
    @extends('layouts.navbar')
@endsection
