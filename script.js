//Get Elements from the DOM
const timeEl = document.getElementById("time"); //Time
const dateEl = document.getElementById("date"); //Date
const currentWeatherItemsEl = document.getElementById("current-weather-items");
const timezone = document.getElementById("time-zone");
const weatherForecastEl = document.getElementById("weather-forecast");
const currentTempEl = document.getElementById("current-temp");
const days = [
  "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
];
const months = [
  "Jan",
  "Feb",
  "Mar",
  "Apr",
  "May",
  "Jun",
  "Jul",
  "Aug",
  "Sep",
  "Oct",
  "Nov",
  "Dec",
];

//Update Day and Time
setInterval(() => {
  //variables inside the callback function to get the updated time values
  const time = new Date();
  const month = time.getMonth();
  const date = time.getDate();
  const day = time.getDay();
  const hour = time.getHours();
  const minutes = time.getMinutes();
  const ampm = hour >= 12 ? "PM" : "AM";

  const currentTime = hour + ":" + (minutes < 10 ? "0" + minutes : minutes);
  //console.log(date);
  // console.log(currentTime);
  timeEl.innerHTML = currentTime + `<span id="am-pm">${ampm}</span>`; //span to get same styles
  dateEl.innerHTML = `${days[day]}, ${date}, ${months[month]}`;
}, 1000);
