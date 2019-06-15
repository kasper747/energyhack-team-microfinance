<template>
    <!--v-for="(val,key) in props.item"-->
    <v-sheet>
        Solar Panels
        <v-data-table
                title="Solar Panels"
                :headers="headers"
                :items="assets"
                class="elevation-1"
        >
            <template v-slot:items="props">
                <td v-for="(val,key) in props.item">
                    {{ props.item[key] }}
                </td>

            </template>
        </v-data-table>
        <v-btn @click="commit_data()">
            Add new asset
        </v-btn>
        <v-layout wrap>

            <v-flex xs12 sm12 md4 v-for="(val,key) in pv_params" :key="key">
                <v-text-field
                        v-model="pv_params[key]"
                        :label="key"
                        required
                ></v-text-field>
            </v-flex>
        </v-layout>

    </v-sheet>

</template>

<script>
  export default {
    name: "assets",
    data() {
      return {
        headers: [],
        assets: [
          {
            m2: 5,
            eff: 0.10,
            elevation: "100m"
          },
          {
            m2: 3,
            eff: 0.15,
            elevation: "150m"
          }
        ],
        pv_params: {
          m2: 5,
          eff: 0.10,
          elevation: "100m"
        },
      }
    },
    methods: {
      commit_data: function () {
        let a = this.pv_params;
        this.assets.push(JSON.parse(JSON.stringify(a)));
        console.log(this.pv_params);
      }
    },
    mounted: function () {
      for (let key in this.pv_params) {

        this.headers.push({text: key, value: key})
      }
    }
  }
</script>

<style scoped>

</style>