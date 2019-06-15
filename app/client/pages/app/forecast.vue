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
        labels: [],
      }
    },
    methods: {
      fetch_data: function () {
        // alert('test');
        this.data_prod = [40, 39, 10, 40, 39, 80, 40];
        this.data_load = [1, 40, 39, 10, 40, 39, 80];
        this.labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
      }
    }
  }
</script>

<style scoped>

</style>