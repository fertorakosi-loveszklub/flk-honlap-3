<!doctype html>
<html amp lang="en">
<head>
    <meta charset="utf-8">
    <script async custom-element="amp-analytics"
            src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <title>{{ $article->title }} - Fertőrákosi Lövészklub</title>
    <link rel="canonical" href="{{ url('/hirek/' . $article->slug) }}">
    <meta name="viewport"
          content="width=device-width,minimum-scale=1,initial-scale=1">
    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "NewsArticle",
        "headline": "{{ $article->lead }}",
        "datePublished": "{{ $article->published_at->toAtomString() }}",
        "image": [
          "{{ url('/img/fb_share.jpg') }}"
        ]
      }

    </script>
    <style amp-boilerplate>body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both
        }

        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-moz-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-ms-keyframes -amp-start {

        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }

        }
        @-o-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }</style>
    <noscript>
        <style amp-boilerplate>body {
                -webkit-animation: none;
                -moz-animation: none;
                -ms-animation: none;
                animation: none
            }</style>
    </noscript>
    <style amp-custom>
        body {
            background: white;
            padding: 0 15px;
            font-family: sans-serif;
        }

        a.full {
            display: block;
            color: white;
            background: #4564ae;
            padding: 15px 0;
            text-align: center;
            text-decoration: none;
        }

        amp-img {
            background: #888;
        }
    </style>
</head>
<body>
<div style="text-align: center">
    <amp-img src="{{ url('/img/logo_small.png') }}" width="100"
             height="127"></amp-img>
</div>

<h1 style="color: #4564ae;">{{ $article->title }}</h1>

<p style="font-size: .75em">
    {{ $article->published_at->format('Y. m. d.') }}
</p>

<p style="font-weight:bold; margin: 15px 0;">
    {{ $article->lead }}
</p>

{!! $article->content !!}

<a class="full" href="{{ url('/hirek/' . $article->slug) }}">
    Teljes verzió megtekintése
</a>

@if (app()->environment() == 'production')
    <amp-analytics type="googleanalytics" id="analytics1">
        <script type="application/json">
                {
                  "vars": {
                    "account": "UA-85546283-1"
                  },
                  "triggers": {
                    "trackPageview": {
                      "on": "visible",
                      "request": "pageview"
                    }
                  }
                }
        </script>
    </amp-analytics>
@endif
</body>
</html>
