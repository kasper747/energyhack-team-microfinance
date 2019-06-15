import VueChartJs from 'vue-chartjs'

var options = {
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      },
      gridLines: {
        display: true
      }
    }],
    xAxes: [{
      gridLines: {
        display: false
      }
    }]
  },
  legend: {
    display: false
  },
  responsive: true,
  maintainAspectRatio: false
};

export default {
  extends: VueChartJs.Line,
  props: ['data_prod', 'data_load', 'options', 'labels'],
  mounted() {
    this.draw_chart();
  },
  methods: {
    draw_chart: function () {
      this.renderChart({
            labels: this.labels,
            datasets: [
              {
                label: 'Production',
                backgroundColor: 'rgba(231, 0, 255, 0)',
                borderColor: '#fc6f77',
                data: this.data_prod
              },
              {
                label: 'Load',
                backgroundColor: 'rgba(0, 231, 255, 0)',
                borderColor: '#646afc',
                data: this.data_load
              },
            ]
          }, {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              elements: {line: {fill: false}},
              yAxes: [{
                ticks: {
                  beginAtZero: true
                },

                gridLines: {
                  display: true
                }
              }],
              xAxes: [{
                gridLines: {
                  display: false
                }
              }]
            },
          }
      )
    }
  },
  watch: {
    data_prod: function () {
      this.draw_chart();
    }
  }
}
