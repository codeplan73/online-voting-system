<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgb(234, 97, 109);
            padding: 10px 20px;
            color: #fff;
            box-shadow: 7px 7px 10px rgba(255, 255, 255, 0.1);
        }

        nav img {
            height: 50px;
            width: 50px;
        }

        nav h4 {
            font-size: 28px;
            font-weight: 900;
        }

        nav ul {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        nav ul a {
            color: #fff;
            text-decoration: none;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-weight: 800;
        }

        .main-image {
            width: 100vw;
            height: 100vh;
            margin: 0 auto;
        }

        .img-container {
            width: 100%;
            height: 100%;
        }

        footer {
            background: rgb(4, 4, 26);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0px;
        }

        header {
            background: rgb(6, 6, 42);
            text-align: center;
            color: #fff;
            font-weight: 900;
            font-size: 24px;
            padding: 16px 0px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
        }

        @media screen and (max-width:760px) {
            nav h4 {
                display: none;
            }

            .main-image {
                margin-top: 5rem;
                width: 100%;
                height: 100%;
            }
        }
    </style>

</head>

<body>
    <header>
        <h4 class="">Online Voting System</h4>
    </header>
    <nav>
        <img src="/logo/logo.png" class="" alt="">



        <ul class="">
            {{-- <a class="" href="/About">About</a> --}}
            <a class="" href="/login">Voters Section</a>
            <a class="" href="/candidate-login">Candidate Section</a>
        </ul>
    </nav>

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="img-container">
            <img src="/img/voting_system.png" class="main-image" alt="">
        </div>
    </div>

    <footer>
        <p>Online Voting System</p>
    </footer>
</body>

</html>
