import VueChartJs from 'vue-chartjs'

export default {
  extends: VueChartJs.Line,
  props: ['data', 'options','labels'],
  mounted() {
    this.renderChart({
      labels: this.labels,
      datasets: [
        {
          label: 'Data One',
          backgroundColor: '#f87979',
          data: this.data
        }
      ]
    }, {responsive: true, maintainAspectRatio: false})
  }
}
