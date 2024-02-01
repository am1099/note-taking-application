<template>
  <div>
    <div @click="onToggle" class="fixed inset-0 bg-gray-900 opacity-70"></div>
    <div
      class="fixed inset-0 mx-auto my-36 w-full max-w-lg p-3 rounded-xl shadow-lg"
      @click.self="close()"
    >
      <div class="bg-white text-black">
        <div class="text-center p-3 flex-auto justify-center leading-6">
          <h2 class="text-2xl text-teal-800 font-bold py-4">
            {{ noteToUpdate != null ? "Update " : "Create New " }} Note
          </h2>
          <!-- Form -->
          <form
            class="mt-4"
            @submit.prevent="noteToUpdate != null ? updateNote() : saveNote()"
          >
            <div class="mb-4">
              <label
                class="block text-gray-700 text-sm font-bold mb-2"
                for="title"
              >
                Title
              </label>
              <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="title"
                type="text"
                placeholder="Note title ..."
                v-model="note.title"
              />
              <span class="text-red-600" v-if="formErrors?.title">{{
                formErrors.title[0]
              }}</span>
            </div>
            <div class="mb-4">
              <label
                class="block text-gray-700 text-sm font-bold mb-2"
                for="content"
              >
                Content
              </label>
              <textarea
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="content"
                rows="6"
                placeholder="Note content ..."
                v-model="note.content"
              />
              <span class="text-red-600" v-if="formErrors?.content">{{
                formErrors.content[0]
              }}</span>
            </div>

            <div class="p-3 mt-2 text-center space-x-4 md:block">
              <button
                type="submit"
                class="mb-2 md:mb-0 bg-teal-800 px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-white rounded-md hover:shadow-lg hover:bg-teal-500"
              >
                {{ noteToUpdate != null ? "Update" : "Save" }}
              </button>
              <button
                @click="close()"
                type="button"
                class="bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-md hover:shadow-lg hover:bg-gray-100"
              >
                Close
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  props: {
    noteToUpdate: {
      type: Array,
      required: false,
      default: null,
    },
  },
  data() {
    return {
      note: {
        title: this.noteToUpdate != null ? this.noteToUpdate.title : "",
        content: this.noteToUpdate != null ? this.noteToUpdate.content : "",
      },
      formErrors: {},
    };
  },
  computed: {},
  mounted() {},
  methods: {
    close() {
      this.$emit("close");
    },
    saveNote() {
      axios
        .post("/api/notes", this.note)
        .then((data) => {
          console.log(data);
          if (data.data.success) {
            this.$emit("formSubmission", {
              success: data.data.success,
              message: "Note created successfully",
              bgColor: "green",
            });
            this.$emit("notesUpdate", data.data.notes.original.notes);
            this.close();
          } else {
            this.$emit("formSubmission", {
              success: data.data.success,
              message: "Note was not created",
              bgColor: "red",
            });
            this.close();
          }
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.formErrors = error.response.data.errors;
            console.log(this.formErrors);
          }
        });
    },

    updateNote() {
      axios
        .put("/api/notes/" + this.noteToUpdate.id, this.note)
        .then((data) => {
          console.log(data);
          if (data.data.success) {
            this.$emit("formSubmission", {
              success: data.data.success,
              message: "Note updated successfully",
              bgColor: "green",
            });

            this.note.created_at = this.noteToUpdate.created_at;
            this.$emit("notesUpdate", {
              notes: data.data.notes.original.notes,
              updatedNote: this.note,
            });
            this.close();
          } else {
            this.$emit("formSubmission", {
              success: data.data.success,
              message: "Note was not updated",
              bgColor: "red",
            });
            this.close();
          }
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.formErrors = error.response.data.errors;
            console.log(this.formErrors);
          }
        });
    },
  },
};
</script>

<style scoped>
</style>