<!--https://codepen.io/apertureless/pen/zEvvWM-->

<template>
    <v-app>
        <v-sheet>
            <v-btn @click="fetch_data">
                Get data
            </v-btn>
            <BarChart
                    :data_prod="data_prod"
                    :data_load="data_load"
                    :labels="labels"
            />
        </v-sheet>
    </v-app>


</template>

<script>
  import BarChart from '~/components/bar-chart'

  export default {
    name: "forecast",

    components: {
      BarChart,
    },

    data() {
      return {
        data_prod: [],
        data_load: [],
        today: 16,
        labels: [],
        prod: {
          "2019-06-15 04:32:00": 0,
          "2019-06-15 04:54:00": 2,
          "2019-06-15 05:15:00": 12,
          "2019-06-15 06:00:00": 29,
          "2019-06-15 07:00:00": 76,
          "2019-06-15 08:00:00": 184,
          "2019-06-15 09:00:00": 416,
          "2019-06-15 10:00:00": 604,
          "2019-06-15 11:00:00": 763,
          "2019-06-15 12:00:00": 865,
          "2019-06-15 13:00:00": 910,
          "2019-06-15 14:00:00": 880,
          "2019-06-15 15:00:00": 777,
          "2019-06-15 16:00:00": 628,
          "2019-06-15 17:00:00": 448,
          "2019-06-15 18:00:00": 263,
          "2019-06-15 19:00:00": 105,
          "2019-06-15 20:00:00": 30,
          "2019-06-15 21:03:00": 4,
          "2019-06-15 22:06:00": 0,
          "2019-06-16 04:32:00": 0,
          "2019-06-16 04:46:00": 1,
          "2019-06-16 05:00:00": 7,
          "2019-06-16 06:00:00": 28,
          "2019-06-16 07:00:00": 90,
          "2019-06-16 08:00:00": 250,
          "2019-06-16 09:00:00": 435,
          "2019-06-16 10:00:00": 631,
          "2019-06-16 11:00:00": 794,
          "2019-06-16 12:00:00": 897,
          "2019-06-16 13:00:00": 949,
          "2019-06-16 14:00:00": 919,
          "2019-06-16 15:00:00": 808,
          "2019-06-16 16:00:00": 661,
          "2019-06-16 17:00:00": 471,
          "2019-06-16 18:00:00": 274,
          "2019-06-16 19:00:00": 110,
          "2019-06-16 20:00:00": 32,
          "2019-06-16 21:00:00": 9,
          "2019-06-16 21:33:00": 1,
          "2019-06-16 22:06:00": 0
        }
      }
    },
    methods: {
      fetch_data: function () {
        this.data_prod = [];
        this.data_load = [];
        this.labels = [];
        for (let i = 1; i <= 24; i++) {
          let str = "";
          if (i > 9) {
            str = i.toString()
          } else {
            str = "0" + i.toString();
          }
          let key = "2019-06-15 " + str + ":00:00";
          if (this.prod.hasOwnProperty(key)) {
            this.data_prod.push(this.prod[key]);
            this.data_load.push(this.prod[key]);
            this.labels.push("2019-06-15 " + str);
          } else {
            this.data_prod.push(0);
            this.data_load.push(0);
            this.labels.push("2019-06-15 " + str);
          }
        }
        ;


        // alert('test');
        // this.data_prod = [40, 39, 10, 40, 39, 80, 40];
        // this.data_load = [1, 40, 39, 10, 40, 39, 80];
        // this.labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
      }
    }
  }
</script>

<style scoped>

</style>