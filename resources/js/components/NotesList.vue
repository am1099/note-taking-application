<template>
  <div>
    <div
      class="max-w-sm mx-auto flex p-6 bg-white rounded-lg shadow-xl hover:bg-grey-900 mb-2"
      v-for="note in notes"
      :key="note.id"
    >
      <div
        class="grid grid-rows-2 grid-flow-col gap-4 ml-1 pt-1"
        @click="noteSelected(note)"
      >
        <div class="row-span-1">
          <h4
            class="text-xl text-gray-900 leading-tight group-hover:text-white"
          >
            {{ note.title }}
          </h4>
        </div>
        <div class="row-span-1">
          <p class="text-sm text-gray-600 group-hover:text-white">
            Date & Time: {{ note.created_at }}
          </p>
        </div>
        <div class="row-span-2">
          <div class="flex flex-col">
            <button
              @click="updateNote()"
              class="bg-teal-400 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded inline-flex items-center mb-1"
            >
              <svg
                class="fill-current text-white w-4 h-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
              >
                <path
                  d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"
                />
              </svg>
            </button>
            <button
              @click="deleteNote(note.id)"
              class="bg-red-400 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center"
            >
              <svg
                class="fill-current text-white w-4 h-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
              >
                <path
                  d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  props: ["notes"],

  data() {
    return {};
  },
  mounted() {},
  computed: {},
  methods: {
    updateNote() {},
    deleteNote(id) {},
    noteSelected(note) {
      this.$emit("noteSelected", note);
    },
  },
};
</script>

<style scoped>
</style>