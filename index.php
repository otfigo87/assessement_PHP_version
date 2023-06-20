<?php

$url = "https://api.weather.gov/points/41.25,-77.01";
$res = file_get_contents($url);
$data = json_decode($res);

$forecastUrl = $data->properties->forecast;

var_dump(function_exists('file_get_contents'));

var_dump($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer ></script>
    <title>Weather App</title>
</head>
<body>
    <div class="container">
        <div class="current-info">
            <div class="date-container">
                <div class="time" id="time">
                    12:00 <span id="am-pm">PM</span>
                </div>
                <div class="date" id="date">
                    Monday, 24 May
                </div>
                <div class="others" id="current-weather-items">
                    <div class="weather-item">
                        <p>Humidity</p>
                        <p>85.98%</p>
                    </div>
                    <div class="weather-item">
                        <p>Temperature</p>
                        <p>85</p>
                    </div>
                    <div class="weather-item">
                        <p>Wind Speed</p>
                        <p>8</p>
                    </div>
                    <div class="weather-item">
                        <p>Description Text</p>
                    </div>
                </div>
            </div>

            <div class="place-container">
                <div class="time-zone" id="time-zone">Williamsport</div>
                <div class="state" id="state">PA 17701</div>
            
            </div>
        </div>
    </div>

     <div class="future-forecast">
            <div class="today" id="current-temp">
                <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                <div class="other">
                    <div class="day">Monday</div>
                    <div class="temp">High - 25.8&#176; F</div>
                </div>
                
            </div>

            <div class="weather-forecast" id="weather-forecast">
                <div class="weather-forecast-item">
                    <div class="day">Tue</div>
                    <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                    <div class="temp">25.8&#176; F</div>

                </div>
                <div class="weather-forecast-item">
                    <div class="day">Wed</div>
                    <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                    <div class="temp">25.8&#176; F</div>
                   
                </div>
                <div class="weather-forecast-item">
                    <div class="day">Thur</div>
                    <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                    <div class="temp">25.8&#176; F</div>
                   
                </div>
                <div class="weather-forecast-item">
                    <div class="day">Fri</div>
                    <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                    <div class="temp">25.8&#176; F</div>
                    
                </div>
                <div class="weather-forecast-item">
                    <div class="day">Sat</div>
                    <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                    <div class="temp">25.8&#176; F</div>
                    
                </div>
                <div class="weather-forecast-item">
                    <div class="day">Sun</div>
                    <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                    <div class="temp">25.8&#176; F</div>
                    
                </div>
            </div>

            
        </div>
        <video class="video-bg" autoplay muted loop>
              <source src="assets/bgvideo.mp4" type="video/mp4">
        </video>

</body>
</html>