<?php

// Function to get data from the API
function fetch_data($url)
{
//Identify the client to the server.
//adding headers to the request to avoid the HTTP request failed 403 error
    $opts = array('http' => array('header' => "User-Agent:MyAgent/1.0\r\n"));//custom options for the HTTP
    $context = stream_context_create($opts);//encapsulate options to send.
    $json_res = file_get_contents($url, false, $context); // json format
    //handle error
    if (!$json_res) {
        throw new Exception("Error retrieving data from the API");
    }

    return json_decode($json_res); //PHP array
}

// Function to create HTML cards structure
function createCard($data)
{
    return '
    <div class="weather-forecast-item">
        <div class="day">' . $data->name . '</div>
        <img src="' . $data->icon . '" alt="weather icon" class="w-icon">
        <div class="temp">' . $data->temperature . '&#176; F</div>
    </div>
    ';
}

// End-point provided
$api_url = "https://api.weather.gov/points/41.25,-77.01";

//try-catch blocks around the API requests to handle errors/exceptions
try {
    //First fetch
    $data = fetch_data($api_url);
    //! variables from the provided endpoint fetch
    $forecast_url = $data->properties->forecast; //forecast URL
    $location = $data->properties->relativeLocation->properties->city; //City
    $state = $data->properties->relativeLocation->properties->state; //PA
    // var_dump($forecast_url);

    // Second fetch
    $forecast_data = fetch_data($forecast_url);
    // var_dump($forecast_data);
    //!variable from second endpoints fetch
    $forecast = $forecast_data->properties->periods[0]; //current details
    $temperature = $forecast->temperature; //current temperature
    $description = $forecast->shortForecast; //current short desc
    $humidity = $forecast->relativeHumidity->value; //current humidity
    $wind_speed = $forecast->windSpeed; //current wind speed
    $icon = $forecast->icon; //current icon
    // var_dump($temperature, $humidity, $wind_speed, $description);
    // var_dump($icon);

    //! 7 Days weather
    $periods = $forecast_data->properties->periods; // (Days & Nights)
    $next_days = array_slice(array_filter($periods, function ($period, $index) {
        return $index !== 0 && $index !== 1;
    }, ARRAY_FILTER_USE_BOTH), 0, 8);
    // var_dump($next_days);

    $weatherForecastEl = '';//Where cards get appended => createCard()

    foreach ($next_days as $i => $day) {
       
        if ($i == 0) {
            $tomorrow = '
            <img src="' . $day->icon . '" alt="weather icon" class="w-icon">
            <div class="other">
              <div class="day">Tomorrow</div>
              <div class="temp">Highest: <span id="tomorrow-temp">' . $day->temperature . '&#8457;</span></div>
              <div class="temp" id="desc">' . $day->shortForecast . '</div>
            </div>
        ';
        } else {
            $weatherForecastEl .= createCard($day);
        }
    }
} catch (Exception $error) {
    echo 'An error occurred: ' . $error->getMessage();
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
    <title>Weather App</title>
</head>

<body>
    <div class="container">
        <div class="current-info">
            <div class="date-container">
                <div class="time" id="time">
                    <span id="am-pm"></span>
                </div>
                <div class="date" id="date">
                </div>
                <div class="others" id="current-weather-items">
                    <div class="weather-item">
                        <p>Humidity</p>
                        <p><?php echo $humidity; ?>%</p>
                    </div>
                    <div class="weather-item">
                        <p>Temperature</p>
                        <p id="current-temp"><?php echo $temperature; ?>&#8457;</p>
                    </div>
                    <div class="weather-item">
                        <p>Wind Speed</p>
                        <p><?php echo $wind_speed; ?></p>
                    </div>
                    <div class="weather-item">
                        <p id="description"><?php echo $description ?></p>
                    </div>
                </div>
            </div>

            <div class="place-container">
                <div class="time-zone" id="time-zone"><?php echo $location; ?></div>
                <div class="state" id="state"><?php echo $state; ?> 17701</div>

            </div>
        </div>
    </div>

    <div class="future-forecast">
        <div class="tomorrow" id="">

            <?php echo $tomorrow ?>
            <!-- <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                <div class="other">
                    <div class="day">Monday</div>
                    <div class="temp">High - 25.8&#176; F</div>
                </div> -->

        </div>

        <div class="weather-forecast" id="weather-forecast">

            <?php echo $weatherForecastEl ?>
            <!-- <div class="weather-forecast-item">
                    <div class="day">Tue</div>
                    <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                    <div class="temp">25.8&#176; F</div>
                    
                </div> -->
        </div>


    </div>
    <video class="video-bg" autoplay muted loop>
        <source src="assets/bgvideo.mp4" type="video/mp4">
    </video>

</body>

</html>