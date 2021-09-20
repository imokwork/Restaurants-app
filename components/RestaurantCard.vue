<template>
  <div>
    <b-card
      :title="name"
      :img-src="photo"
      img-left
      img-width="30%"
      shadow
      h5
      class="mb-3 shadow border-0 overflow-hidden"
    >
      <b-card-text>
        <b-form-rating
          :value="rating"
          readonly
          show-value
          precision="1"
          inline
          class="border-0 p-0 m-0"
          variant="warning"
        />
        <br>
        {{ information }}
      </b-card-text>
    </b-card>
  </div>
</template>
<script>
export default {
  props: {
    name: {
      type: String,
      default: ''
    },
    photo: {
      type: String,
      default: ''
    },
    information: {
      type: String,
      default: ''
    },
    rating: {
      type: String,
      default: ''
    }
  }
}
</script>
<style scoped>
  .card:hover {
    background-color:white;
    opacity: 0.9;
  }
  .card {
    cursor: pointer;
  }
  .card img {
    object-fit: cover;
  }
</style>
