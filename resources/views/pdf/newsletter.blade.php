<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
        <style>
            h2 {
                text-align: center;
            }
        </style>
    </head>

        <body>
            <table style="padding-bottom: 15px">
                <tr>
                    <td width="50%" valign="middle" style="text-align: center">
                        <img src="{{ public_path('images/bvcs-logo-b.png') }}">
                    </td>
                    <td width="50%" valign="middle" style="text-align: center; padding: 20px">
                        <h1>{{ $content->title }}</h1>
                        <p>{{ $content->posted_at->format('F jS, Y') }}</p>
                        <a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
                    </td>
                </tr>
            </table>
            <div>
                @parsedown($content->body)
            </div>
        </body>

    </html>
