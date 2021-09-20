
<template>
  <div>
    <b-container fluid>
      <b-row>
        <b-col sm="12" md="8" class="pl-0 pr-0">
          <div class="input-search">
            <b-card shadow class="border-0">
              <b-card-body class="p-0">
                <b-input-group class="p-0">
                  <gmap-autocomplete
                    placeholder="Search for restaurants by area."
                    :select-first-on-enter="true"
                    class="form-control m-auto"
                    type="search"
                    :value="search"
                    @place_changed="setPlace"
                  />
                </b-input-group>
              </b-card-body>
            </b-card>
          </div>
          <gmap-map :center="center" :zoom="14" class="map">
            <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false" />

            <div v-if="restaurants.length">
              <gmap-marker
                v-for="(m,i) in restaurants"
                :key="i"
                :position="m.position"
                :clickable="true"
                keep-alive
                @click="toggleInfoWindow(m,i)"
              />
            </div>
          </gmap-map>
        </b-col>
        <b-col v-b-scrollspy:nav-scroller sm="12" md="4" class="left-content">
          <h1>Restaurants</h1>
          <hr>
          <p v-if="$fetchState.pending">
            <b-card v-for="index in 8" :key="index" no-body img-left class="m-3">
              <b-skeleton-img card-img="left" width="225px" />
              <b-card-body>
                <b-skeleton class="m-2" />
                <b-skeleton class="m-2" />
                <b-skeleton class="m-2" />
              </b-card-body>
            </b-card>
          </p>
          <p v-else-if="$fetchState.error">
            An error occurred :(
          </p>
          <div v-else-if="restaurants.length">
            <RestaurantCard
              v-for="(row,i) in restaurants"
              :key="i"
              :name="row.name"
              :photo="row.photo"
              :information="row.information"
              :rating="row.rating"
              keep-alive
              @click.native="toggleInfoWindow(row,i)"
            >
              {{ row.lat }},{{ row.lng }}
            </RestaurantCard>
          </div>
          <div v-else>
            <b-alert show variant="warning">
              Not found data!
            </b-alert>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      search: 'Bang sue',
      urlPath: this.$config.baseURL + '/api/restaurant',
      restaurants: [],
      center: { lat: 13.825633293632361, lng: 100.52532580223661 },
      infoWindowPos: null,
      infoWinOpen: false,
      currentMidx: null,
      infoOptions: {
        content: '',
        pixelOffset: {
          width: 0,
          height: -35
        }
      }
    }
  },
  async fetch () {
    this.restaurants = []

    const data = await fetch(
        `${this.urlPath}?lat=${this.center.lat}&lng=${this.center.lng}`
    ).then(res => res.json())

    this.restaurants = data
  },
  async mounted () {
    await this.$gmapApiPromiseLazy()
  },
  methods: {
    toggleInfoWindow (marker, idx) {
      this.infoWindowPos = marker.position
      this.infoOptions.content = '<center><h5>' + marker.name + '</h5> <img fluid src="' + marker.photo + '" width="150"></center>'
      this.center = marker.position

      // check if its the same marker that was selected if yes toggle
      if (this.currentMidx === idx) {
        this.infoWinOpen = !this.infoWinOpen
      } else {
        this.infoWinOpen = true
        this.currentMidx = idx
      }
    },
    setPlace (place) {
      if (!place) { return }
      this.infoWinOpen = false
      this.search = place.formatted_address
      this.center = {
        lat: place.geometry.location.lat(),
        lng: place.geometry.location.lng()
      }
      this.$fetch()
    }
  }
}
</script>
<style scoped>
  .map {
    height: 100vh;
    width: 100%;
    }
  .left-content {
    height: 100vh;
    overflow-y: scroll;
  }
  .input-search {
    position: absolute;
    z-index: 1000;
    top: 2%;
    left: 20%;
    margin-left: auto;
    margin-right: auto;
    width: 60%;
  }

  @media(max-width:576px){
    .map {
      height: 50vh;
    }
    .input-search {
      width: 90%;
      left: 5%;
      top: 0;
    }
  }
</style>
