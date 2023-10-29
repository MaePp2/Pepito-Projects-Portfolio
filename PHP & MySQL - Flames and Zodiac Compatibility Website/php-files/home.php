<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compatibility Test | Take the chance!</title>

        <link rel="stylesheet" type="text/css" href="../styles/general.css" />
        <link rel="stylesheet" type="text/css" href="../styles/home.css" />
    </head>
    <body>
        <?php include 'nav.php'?>
        <section>
            <img src="../images/bg.jpg" id="bg" />
            <img src="../images/moon.png" id="moon" />
            <img src="../images/mountain.png" id="mountain" />
            <img src="../images/road.png" id="road" />
            <h2 id="text">Discover Love</h2>
        </section>
        <main>
            <h3>Compatibility Test</h3>
            <div>
                Love and friendship are two of the most precious things in life.
                While they may seem different on the surface, they share a common foundation of trust,
                respect, and mutual support. Whether it's the love you feel for your significant other
                or the deep bond of friendship you share with your closest companions, these relationships
                have the power to enrich our lives and make us better people. Through the ups and downs of
                life, it's the love and support of those closest to us that helps us keep going.
                So cherish your loved ones and hold your friends close, for they are the ones who will be
                with you through thick and thin.
            </div>
            <div>
                But what about those people who you have not made a connection yet but want to? Perhaps
                shy or afraid to approach them but hoping to find that they might be that special
                someone who shares your interests and values? Well...

            </div>
            <div>
                Introducing a website that makes finding your compatibility with others easier than ever before!
                With the ability to add, edit, and delete people, this platform allows you to input important information
                about yourself and others, including their zodiac sign. Using both the popular FLAMES game and astrological
                compatibility, the website provides accurate and reliable results that can help you determine whether you
                and someone else are a good match. Whether you're searching for love, friendship, or just curious about your
                compatibility with someone, this website is a must-try. With its user-friendly interface and advanced algorithms,
                you can trust that you're getting the most accurate results possible. So why wait? Give this website a try today
                and see for yourself how easy it can be to find your perfect match!
            </div>
        </main>
        <script type="text/javascript">
            let bg = document.getElementById("bg");
            let moon = document.getElementById("moon");
            let mountain = document.getElementById("mountain");
            let road = document.getElementById("road");
            let text = document.getElementById("text");

            window.addEventListener('scroll', function(){
                var value = window.scrollY;

                bg.style.top = value * 0.5 + 'px';
                moon.style.left = -value * 0.5 + 'px';
                mountain.style.top = -value * 0.15 + 'px';
                road.style.top = value * 0.15 + 'px';
                text.style.top = value * 1 + 'px';
            })
        </script>
    </body>
</html>