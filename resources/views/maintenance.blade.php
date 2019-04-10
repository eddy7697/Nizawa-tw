<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maintenance</title>
    <link href="/css/frontend.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/js/plugins/AOS/aos.css">
</head>
<body>
    <div id="mainten-info">
        <div class="site-logo">
            <img src="/img/logo_grey.png" alt="" srcset="">
        </div>
        <br>
        <h2 style="letter-spacing: 5px;">全新網站上線倒數，造成不便敬請見諒</h2>
        <div class="point-wave">
            <img src="/img/mainten-counting.svg" alt="">
        </div>
        <br>
        <div class="datetime-countdown">
            <table>
                <thead>
                    <tr>
                        <th id="cd"></th>
                        <th id="ch"></th>
                        <th id="cm"></th>
                        <th id="cs"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Day</td>
                        <td>Hrs</td>
                        <td>Min</td>
                        <td>Sec</td>
                    </tr>
                </tbody>                
            </table>
        </div>
        <br>
        <h4 style="margin-bottom: 16px;">需要幫忙嗎？</h4>
        <h4><a>請致電：03-9590903</a><br><br><a>或來信：044555@gmail.com</a></h4>
    </div>


    <script src="/js/frontend.js"></script>

    <script src="/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="/js/plugins/AOS/aos.js" charset="utf-8"></script>

    <script type="text/javascript">
        AOS.init();
    </script>

    <script>
    // Set the date we're counting down to
    var countDownDate = new Date("Sep 20, 2018 00:00:00").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();           
        
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Output the result in an element with id="demo"
        document.getElementById("cd").innerHTML = days;
        document.getElementById("ch").innerHTML = hours;
        document.getElementById("cm").innerHTML = minutes;
        document.getElementById("cs").innerHTML = seconds;
        
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
    </script>
    @if(config('app.env') == 'local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endif
</body>
</html>