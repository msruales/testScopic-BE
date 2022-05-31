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
        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        th, td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        th, td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #bab7b7;
            border-color: black;
        }

        td {
            border-color: #DDD;
        }

        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
        }

        body {
            box-sizing: border-box;
            height: 80%;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
            width: 70%;
        }

        body {
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
<header>
    <h1>Invoice</h1>
    <address>
        <p>Scopic Test Invoice</p>
    </address>
</header>
<article>
    <address>
        <p>Scopic Test Invoice<br> {{$user->name}}</p>
    </address>
    <table class="meta">
        <tr>
            <th><span>Invoice</span></th>
            <td><span>#{{$item->id}}</span></td>
        </tr>
        <tr>
            <th><span>Date</span></th>
            <td><span>{{now()->format('d-m-y')}}</span></td>
        </tr>
        <tr>
            <th><span>Amount Due</span></th>
            <td><span>$</span><span>{{$bid}}</span></td>
        </tr>
    </table>
    <table class="inventory">
        <thead>
        <tr>
            <th><span>Item</span></th>
            <th><span>Description</span></th>
            <th><span>Price</span></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><span>{{$item->name}}</span></td>
            <td><span>{{$item->description}}</span></td>
            <td><span>$</span><span>{{$bid}}</span></td>
        </tr>

        </tbody>
    </table>
    <table class="balance">
        <tr>
            <th><span>Total</span></th>
            <td><span>$</span><span>{{$bid}}</span></td>
        </tr>
        <tr>
            <th><span>Amount Paid</span></th>
            <td><span>$</span><span>0.00</span></td>
        </tr>
        <tr>
            <th><span>Balance Due</span></th>
            <td><span>$</span><span>{{$bid}}</span></td>
        </tr>
    </table>
</article>
</body>


</html>
