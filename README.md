# CMP_SC 4830 Exploration 1
### Dale Brauer (dmbyrd)

Exploration Topic: Weather Underground API

## Supporting Technologies
- [IIS](https://www.iis.net/)
- [PHP 7](http://php.net/manual/en/)
- [Twitter Bootstrap](http://getbootstrap.com/)
- [Web Platform Installer](https://www.microsoft.com/web/downloads/platform.aspx)
- [jQuery](http://api.jquery.com/)
- [Free GeoIP Lookup](https://freegeoip.net/)

## Live Code

[Exploration 1](https://aws.td9175.com/exp1/ "Exploration 1")

## Documentation

-  jQuery getJSON: [http://api.jquery.com/jQuery.getJSON/](http://api.jquery.com/jQuery.getJSON/)
-  Free GeoIP: [http://freegeoip.net/](http://freegeoip.net/)
-  Weather Underground API: [https://www.wunderground.com/weather/api/d/docs](https://www.wunderground.com/weather/api/d/docs)
-  Bootstrap column grid: [http://getbootstrap.com/css/#grid](http://getbootstrap.com/css/#grid)

## Summary

The demo primarily uses jQuery to parse JSON data from two  APIs, one for Weather Underground and the other for GeoIP lookup.  PHP is used to grab the IP address of the remote user and place it in the GeoIP lookup request.  Using data returned from the GeoIP lookup, the city (`ip.city`) and state (`ip.state`) are sent to Weather Underground.  This returns a JSON object, parsed by jQuery, and then weather data elements (`data.current_observation.icon_url, data.current_observation.temp_f, data.current_observation.temp_c, data.current_observation.weather, data.current_observation.relative_humidity, and data.current_observation.forecast_url`) are pulled from this and displayed on the page.

## Troubles

I had a speed bump installing PHP on IIS: I couldn't get PHP Manager installed since I forgot to install the .NET 2.0 prerequisite first (protip: don't forget to do this.)  Once .NET 2.0 was installed, PHP was cooperating happily.

Secondly, the GeoIP lookup service I used isn't the greatest - it has a bit of trouble with cellular networks (at least for me, testing with Verizon) that tunnel IPv6 back to IPv4.  PHP detects that I am connecting with an IPv4 address (my connection is actually IPv6), and there is no geolocation data associated with the v4 address, according to freegeoip.net.  A full MaxMind database has location data (better than nothing), but it's pretty far off for that IP.  In the future, I'd probably just download the free version of the MaxMind GeoIP2 database instead of using a web service.