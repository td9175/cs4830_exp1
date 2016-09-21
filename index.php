<!DOCTYPE html>
<?php header("Access-Control-Allow-Origin: *"); ?>
<html>
    <head>
        <title>Exploration 1 - GeoIP Weather</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/custom.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="jumbotron">
                <script src="js/ajax.js"></script>
                <script>
                    $(document).ready(function(){
                        var ip = 
                        $.getJSON("https://freegeoip.net/json/<?php print($_SERVER[REMOTE_ADDR]); ?>",
                        function(ip) {
                            console.log(ip); 
                            var url = "https://api.wunderground.com/api/b77d430320227013/conditions/q/";
                            console.log(url);
                            var state = ip.region_code + "/";
                            console.log(state);
                            var city = ip.city;
                            console.log(city);
                            var ext = ".json";
                            console.log(ext);
                            var final = url.concat(state,city,ext);
                            console.log(final);

                            var data = $.getJSON(final,
                            function(data) {
                                console.log(data);
                                console.log("Weather data placed in jqxhr object"); })
                                .done(function(data) {
                                    $('#current').html('<h3>' + ip.city + ', ' + ip.region_code + '</h3>' + '<img class="img-rounded tdweathericon" alt="weather-icon" src="' + data.current_observation.icon_url + '">' +
                                        'Current Temperature: ' + data.current_observation.temp_f + ' &deg;F / ' + data.current_observation.temp_c + ' &deg;C<br>' +
                                        'Current Conditions: ' + data.current_observation.weather + '<br>' +
                                        'Relative Humidity: ' + data.current_observation.relative_humidity + '<br>' +
                                        '<a href="' + data.current_observation.forecast_url + '?apiref=9e31f4229a11b45b' + '">Forecast</a>');
                                })
                                .fail(function() {
                                    $('#current').html('We couldn\'t grab the weather data for this location - the GeoIP lookup returned an invalid city or state. Sorry about that.');
                                });
                        });
                    });
                </script>
                <h2 style="text-align: center;">GeoIP Weather</h2>
                <div class="container-fluid" id="weatherstage">
                    <row>
                        <div class="col-md-8 col-md-offset-2 tdbordered tdcenter" id="como">
                            Your IP address is: <?php print($_SERVER[REMOTE_ADDR]); ?> <br />
                            <div class="tdcenter" id="current"></div>
                        </div>
                    </row>
                    <row>
                        <div class="col-md-12 tdcenter tdmargins" id="wundlogo">
                            <img class="img-responsive tdcenterauto" src="images/wunderground/logo.png" alt="Weather Underground">
                            <p class="text-muted" id="nobottommargin">Weather data provided through the Weather Underground API.<br>
                                <a href="https://www.wunderground.com/?apiref=9e31f4229a11b45b">Visit Weather Underground</a>
                            </p>
                        </div>
                    </row>
                </div>
            </div>
        </div>
    </body>

    <footer class="footer">
        <div class="container-fluid">
            <p class="text-muted tdcenter tdmargins">Copyright &copy; 2016, Dale Brauer.</p>
        </div>
    </footer>
</html>