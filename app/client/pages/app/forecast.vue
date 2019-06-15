<template>

    <BarChart :data="[40, 39, 10, 40, 39, 80, 40]"
              :labels="['January', 'February', 'March', 'April', 'May', 'June', 'July']"
    />
</template>

<script>
  import BarChart from '~/components/bar-chart'

  export default {
    name: "forecast",

    components: {
      BarChart,
    },
    data() {
      return {}
    }
    ,
  }
</script>

<style scoped>

</style>