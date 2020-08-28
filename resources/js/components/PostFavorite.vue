<template>
  <div>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
    >
      <i class="fas fa-heart mr-1"
      :class="{'red-text':this.isFavoritedBy}"
      />
    </button>
  </div>
</template>

<script>
export default {
    props: {
      initiallsFavoritedBy: {
        type: Boolean,
        default: false,
      },
    },
    data() {
      return {
        isLikedBy: this.initiallsFavoritedBy,
      }
    },
  }
</script>
