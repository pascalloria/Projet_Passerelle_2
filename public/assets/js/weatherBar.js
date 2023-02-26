const weather = document.querySelector("#weather");
let city;
const today = new Date();
const time = today.getHours();
const month = today.getMonth()+1;

function takeWeather(city) {
    const url =
      "https://api.openweathermap.org/data/2.5/weather?q=" + city + " &appid=253664b278f0a6f775da23d9d38db076&units=metric";
      fetchIsGood(url);
      
}

if('geolocation' in navigator) {
    navigator.geolocation.watchPosition((position) => {
        const url = 'https://api.openweathermap.org/data/2.5/weather?lon='+ position.coords.longitude+ '&lat=' + position.coords.latitude +  '&appid=253664b278f0a6f775da23d9d38db076&units=metric';
        fetchIsGood(url);
    }, options);

    var options = {
    enableHighAccuracy: true
    }
}
else {
    city = 'marseille';
    takeWeather(city);
}
function fetchIsGood(url) {
     // creer requete
  fetch(url)
  .then((response) => response.json())
  .then((response) => {
    const temp = response.main.temp;
    const humidity = response.main.humidity;
    const sky = response.weather[0].description;

    weather.innerHTML = response.name + " : " + temp.toFixed(1) + " °C ";

    if (sky.includes("clear")) {
      // heure d'hiver 
      if (month < 4 || month >= 11 ) {

          if(time >= 7 && time <= 18) {
              weather.innerHTML += ' <i class="fa-solid fa-sun"></i>';
          } else {
              weather.innerHTML += ' <i class="fa-solid fa-moon"></i>';
          }
         
      } else { // heure d'été
          if(time >= 7 && time <= 21) {
              weather.innerHTML += ' <i class="fa-solid fa-sun"></i>';
          } else {
              weather.innerHTML += ' <i class="fa-solid fa-moon"></i>';
          }
         
      }
    }
    else if (humidity > 75) {
      weather.innerHTML += ' <i class="fa-solid fa-cloud-rain"></i>';
    }
    else if (sky.includes("mist")) {
      weather.innerHTML += ' <i class="fa-solid fa-smog"></i>';
    }
    else if (sky.includes("cloud")) {
      weather.innerHTML += ' <i class="fa-solid fa-cloud"></i>';
    }
  });
}



