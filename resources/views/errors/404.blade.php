<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>404 - Page Not Found</title>

    <style>
        body{
            margin: 0;
            padding: 0;
            box-sizing: border-box;


        }
        div{
            width: 100vw;
    height: 100vh;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center
        }
        img{
            position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 2;
        }
        h2{
            z-index: 20;
            color: black;
            position: absolute;
            right: 50%
    width: 100%;
    bottom: 0%
        }
    </style>
</head>

<body>
    <div>

        <img sty src="/images/404pag3.jpg" alt="">

        {{-- <h2>Page Not Found. CLick <a href="">here</a> to go back</h1> --}}
        
    </div>
</body>

</html>
