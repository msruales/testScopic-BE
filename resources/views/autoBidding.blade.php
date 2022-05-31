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
        <h5 class="card-title">Auto Bidding: {{ $type_message === 'percentage' ? "About to finish" : "Finished" }}</h5>
        <p class="card-text">{{ $type_message === "percentage" ? "the car offer has consumed percent of the last amount added" : "The amount for the auto offers has ended" }}</p>
    </div>
</div>


</body>

</html>
