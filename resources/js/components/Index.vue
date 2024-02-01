<template>
  <div>
    <div
      class="w-full h-auto flex justify-center bg-gradient-to-r from-green-900 to-blue-750 bg-teal-900 rounded-b-lg"
    >
      <h1 class="text-3xl font-bold text-white mt-6 mb-6">Note Taking Arena</h1>
    </div>

    <div v-if="showToast" class="flex justify-center mt-2">
      <Toast
        :success="success"
        :message="toastMessage"
        :bgColor="toastBgColor"
        @close="showToast = false"
      />
    </div>

    <div class="flex flex-col justify-center mt-4">
      <div class="justify-start mb-4 ml-20">
        <button
          @click="isModalVisible = true"
          class="bg-teal-600 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded inline-flex items-center"
        >
          <svg
            class="fill-current text-white w-4 h-4"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512"
          >
            <path
              d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"
            />
          </svg>
          <span> New Note </span>
        </button>
      </div>
      <div class="grid grid-cols-3 gap-4">
        <div class="col-span-1">
          <NotesList
            :notes="notes"
            @note-deleted="handleDeleteSubmission"
            @note-updated-form="handleFormSubmission"
            @note-selected="setSelectedNote"
            @notes-update="notesUpdated"
          />
        </div>
        <div class="col-span-2" style="height: 30em">
          <ViewNote v-if="selectedNote != null" :note="selectedNote" />
          <div v-else class="flex justify-center pt-36 place-content-center">
            <p class="text-teal-800 capitalize font-bold text-2xl">
              Select a Note to be viewed
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- New Note Form -->
    <div v-if="isModalVisible">
      <div class="grid grid-cols-6 gap-4">
        <div class="col-start-2 col-span-4">
          <NoteForm
            @form-submission="handleFormSubmission"
            @notes-update="notesUpdated"
            @close="isModalVisible = false"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NotesList from "./NotesList.vue";
import NoteForm from "./forms/NoteForm.vue";
import ViewNote from "./ViewNote.vue";
import Toast from "./Utilities/Toast.vue";

import axios from "axios";

export default {
  components: {
    NotesList,
    NoteForm,
    ViewNote,
    Toast,
  },
  data() {
    return {
      isModalVisible: false,
      notes: null,
      selectedNote: null,

      showToast: false,
      success: false,
      toastMessage: "",
      toastBgColor: "",
    };
  },
  mounted() {
    this.getNotes();
  },
  computed: {},
  methods: {
    onToggle() {
      this.isOpen = !this.isOpen;
    },
    getNotes() {
      axios.get("/api/notes").then((data) => {
        this.notes = data.data.notes;
      });
    },
    setSelectedNote(note) {
      this.selectedNote = note;
    },
    handleFormSubmission(data, noteStillSelected = true) {
      this.success = data.success;
      this.toastMessage = data.message;
      this.toastBgColor = data.bgColor;
      this.showToast = true;
      if (!noteStillSelected) {
        this.selectedNote = null;
      }

      this.$nextTick(() => {
        setTimeout(() => {
          this.showToast = false;
        }, 5000);
      });
    },

    handleDeleteSubmission(data) {
      this.handleFormSubmission(data, false);
    },
    notesUpdated(noteData) {
      console.log("ads", noteData);
      this.notes = noteData.notes;
      if (noteData.updatedNote != null) {
        this.selectedNote = noteData.updatedNote;
      }
    },
  },
};
</script>

<style scoped>
</style>