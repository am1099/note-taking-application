<template>
  <div class="w-full h-auto flex justify-center min-w-full min-h-full">
    <div class="w-full bg-gray-100 border border-gray-200 rounded-lg shadow">
      <div
        class="flex items-center justify-between mb-4 p-2 w-full h-auto bg-gray-400 rounded-b-lg"
      >
        <h4 class="text-xl font-bold leading-none text-white pl-2 pt-1">
          {{ note.title }}
        </h4>
        <div class="text-sm font-bold text-gray-600 pt-1">
          Note created at:
          <span
            class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded"
            >{{ noteDateCreated }}
          </span>
        </div>
      </div>
      <div class="flow-root p-8">
        <p class="text-md font-bold text-black">
          {{ note.content }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["note"],
  components: {},
  data() {
    return {};
  },
  mounted() {},
  computed: {
    noteDateCreated() {
      const dateObject = new Date(this.note.created_at);

      const day = dateObject.getDate().toString().padStart(2, "0");
      const month = (dateObject.getMonth() + 1).toString().padStart(2, "0");
      const year = dateObject.getFullYear();
      const hours = dateObject.getHours().toString().padStart(2, "0");
      const minutes = dateObject.getMinutes().toString().padStart(2, "0");

      return `${day}/${month}/${year} ${hours}:${minutes}`;
    },
  },
  methods: {},
};
</script>

<style scoped>
</style>