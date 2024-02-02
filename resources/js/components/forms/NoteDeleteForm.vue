<template>
  <div>
    <div @click="onToggle" class="fixed inset-0 bg-gray-900 opacity-70"></div>
    <div
      class="fixed inset-0 mx-auto my-36 w-full max-w-lg p-3 rounded-xl shadow-lg"
      @click.self="close()"
    >
      <div class="relative bg-white rounded-lg shadow">
        <button
          type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
          data-modal-hide="popup-modal"
        >
          <svg
            class="w-3 h-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 14"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
            />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
          <svg
            class="mx-auto mb-4 text-gray-400 w-12 h-12"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 20 20"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
            />
          </svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500">
            Are you sure you want to delete this note?
          </h3>
          <button
            @click="deleteNote"
            type="button"
            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2"
          >
            Yes, I'm sure
          </button>
          <button
            @click="close"
            type="button"
            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
          >
            No, cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  props: {
    selectedNoteId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {};
  },
  computed: {},
  mounted() {},
  methods: {
    close() {
      this.$emit("close");
    },

    deleteNote() {
      axios
        .delete("/api/notes/" + this.selectedNoteId)
        .then((data) => {
          if (data.data.success) {
            this.$emit("formSubmission", {
              success: data.data.success,
              message: "Note deleted successfully",
              bgColor: "green",
            });
            this.$emit("notesUpdate", data.data.notes.original.notes);
            this.close();
          } else {
            this.$emit("formSubmission", {
              success: data.data.success,
              message: "Note was not deleted",
              bgColor: "red",
            });
            this.close();
          }
        })
        .catch(function (err) {
          console.log(err);
        });
    },
  },
};
</script>

<style scoped>
</style>