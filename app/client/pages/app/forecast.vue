<!--https://codepen.io/apertureless/pen/zEvvWM-->

<template>
    <v-app>
        <v-sheet>
            <v-btn :disabled="loading" @click="parse_data(hist_prod)">
                Use Cashed Data
            </v-btn>
            <v-btn :disabled="loading" @click="get_prod_forecast()">
                Request new data
            </v-btn>
            <v-btn :disabled="loading" @click="send_message()">
                Request load shift
            </v-btn>
            <v-btn :disabled="loading" @click="get_weather_forecast()">
                Load Weather
            </v-btn>
            <BarChart
                    :data_prod="data_prod"
                    :data_prod_weather="data_prod_weather"
                    :data_load="data_load"
                    :labels="labels"
            />
        </v-sheet>
    </v-app>


</template>

<script>
  import BarChart from '~/components/bar-chart'
  import axios from "axios";

  var api_url_prod_forecast = 'https://api.forecast.solar/estimate/54.9/25.3/37/0/1';
  var api_url_weather_forecast = 'http://localhost:4000/weather';
  //Clouds impact
  // http://proceedings.ases.org/wp-content/uploads/2014/02/2010-112.pdf
  // https://digitalcommons.calpoly.edu/cgi/viewcontent.cgi?article=1448&context=theses


  axios.defaults.headers.post = {
    'Access-Control-Allow-Origin': "*",
    'Access-Control-Allow-Credentials': 'true',
    'Content-Type': 'application/json',
  };
  axios.defaults.method = 'get';
  var api_prod_forecast = axios.create({
    url: api_url_prod_forecast,
  });
  var api_weather_forecast = axios.create({
    url: api_url_weather_forecast,
  });


  export default {
    name: "forecast",

    components: {
      BarChart,
    },

    data() {
      return {
        data_prod_weather: [],
        data_prod: [],
        data_load: [],
        today: 16,
        labels: [],
        prod: {},
        hist_prod: {
          "2019-06-16 04:32:00": 0,
          "2019-06-16 04:46:00": 1,
          "2019-06-16 05:00:00": 7,
          "2019-06-16 06:00:00": 30,
          "2019-06-16 07:00:00": 87,
          "2019-06-16 08:00:00": 228,
          "2019-06-16 09:00:00": 385,
          "2019-06-16 10:00:00": 543,
          "2019-06-16 11:00:00": 666,
          "2019-06-16 12:00:00": 737,
          "2019-06-16 13:00:00": 765,
          "2019-06-16 14:00:00": 730,
          "2019-06-16 15:00:00": 642,
          "2019-06-16 16:00:00": 523,
          "2019-06-16 17:00:00": 378,
          "2019-06-16 18:00:00": 227,
          "2019-06-16 19:00:00": 98,
          "2019-06-16 20:00:00": 34,
          "2019-06-16 21:00:00": 10,
          "2019-06-16 21:33:00": 2,
          "2019-06-16 22:06:00": 0,
          "2019-06-17 04:32:00": 0,
          "2019-06-17 04:46:00": 1,
          "2019-06-17 05:00:00": 8,
          "2019-06-17 06:00:00": 31,
          "2019-06-17 07:00:00": 81,
          "2019-06-17 08:00:00": 199,
          "2019-06-17 09:00:00": 331,
          "2019-06-17 10:00:00": 468,
          "2019-06-17 11:00:00": 577,
          "2019-06-17 12:00:00": 645,
          "2019-06-17 13:00:00": 680,
          "2019-06-17 14:00:00": 655,
          "2019-06-17 15:00:00": 580,
          "2019-06-17 16:00:00": 478,
          "2019-06-17 17:00:00": 350,
          "2019-06-17 18:00:00": 215,
          "2019-06-17 19:00:00": 96,
          "2019-06-17 20:00:00": 34,
          "2019-06-17 21:00:00": 10,
          "2019-06-17 21:34:00": 2,
          "2019-06-17 22:07:00": 0
        },
        loading: false,
        weather_data: {}
      }
    },
    methods: {
      get_weather_forecast: function () {
        this.loading = true;
        api_weather_forecast()
            .then(response => {
              console.log('Fetching');
              this.data_prod_weather = [];
              this.weather_data = {};
              let data = response.data;
              for (let i = 0; i < data.hourly.data.length; i++) {
                var date = new Date(data.hourly.data[i].time * 1000);
                var hours = "0" + date.getHours();
                var day = date.getUTCDate();
                var month = date.getUTCMonth();
                var minutes = "0" + date.getMinutes();
                var seconds = "0" + date.getSeconds();
                var formattedTime = "2019-06-" + day + " " + hours.substr(-2) + ':' + '00:00';
                this.weather_data[formattedTime] = data.hourly.data[i].cloudCover;
              }
              let days = [
                '2019-06-16',
                '2019-06-17'
              ];
              for (let j = 0; j < days.length; j++) {
                let day = days[j];
                for (let i = 1; i <= 24; i++) {
                  let str = "";
                  if (i > 9) {
                    str = i.toString()
                  } else {
                    str = "0" + i.toString();
                  }
                  let key = day + " " + str + ":00:00";
                  console.log(key, this.weather_data[key], this.data_prod[i - 1]);
                  if (this.weather_data.hasOwnProperty(key)) {
                    this.data_prod_weather.push(this.weather_data[key] * this.data_prod[24 * j + i - 1]);
                  } else {
                    this.data_prod_weather.push(this.data_prod[24 * j + i - 1]);
                  }
                }
                ;
              }

              // this.prod = response.data.result.watts;
              this.loading = false;
              console.log(this.weather_data);
              console.log(this.data_prod_weather);

            });
      },
      get_prod_forecast: function () {
        this.loading = true;
        api_prod_forecast(
        )
            .then(response => {
              console.log('Fetching');
              this.parse_data(response.data.result.watts);
              // this.prod = response.data.result.watts;
              this.loading = false;
              console.log(response.data.result.watts);

            });
      },
      parse_data: function (prod_data) {
        this.data_prod = [];
        this.data_load = [];
        this.labels = [];
        let days = [
          '2019-06-16',
          '2019-06-17'
        ];
        for (let j = 0; j < days.length; j++) {
          let day = days[j];
          for (let i = 1; i <= 24; i++) {
            let str = "";
            if (i > 9) {
              str = i.toString()
            } else {
              str = "0" + i.toString();
            }
            let key = day + " " + str + ":00:00";
            if (prod_data.hasOwnProperty(key)) {
              this.data_prod.push(prod_data[key]);
              this.data_load.push(prod_data[key]);
              this.labels.push(day + " " + str);
            } else {
              this.data_prod.push(0);
              this.data_load.push(0);
              this.labels.push(day + " " + str);
            }
          }
          ;
        }


      }
    }
  }
</script>

<style scoped>

</style>