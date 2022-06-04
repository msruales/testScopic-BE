<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        .card {
            padding: 2rem;
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-title {
            font-weight: 500;
            line-height: 1.2;
            margin-bottom: .75rem;
            font-size: 1.25rem;
        }

        .card-subtitle {
            color: #6c757d !important;
            margin-bottom: .5rem !important;
            margin-top: -.375rem;
            font-size: 1rem;
        }

        a {
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
        }

    </style>
</head>
<body>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">A new bid was made on the item {{$item->name}}</h5>
        <h6 class="card-subtitle mb-2 text-muted">Value ${{$bid}}</h6>
    </div>
</div>


</body>

</html>
