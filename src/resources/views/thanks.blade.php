<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>
<body>
    <main>
        <div class="thanks">
            <div class="string1">
                <p class="back">Thank you</p>
            </div>
            <div class="string2">
                <p class="front">お問い合わせありがとうございました</p>
            </div>
        </div>
        <form class="return-to-home-form" action="/" method="get">
            <button class="return-to-home-form__button-submit" type="submit">HOME</button>
        </form> 
    </main>
</body>
</html>
