<template>
  <div
    id="toast-default"
    :class="`flex items-center w-full max-w-xs p-4 text-${bgColor}-600 rounded-lg shadow dark:text-${bgColor}-200 dark:bg-${bgColor}-900`"
    role="alert"
  >
    <div
      :class="`inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-${bgColor}-500 rounded-lg dark:bg-${bgColor}-800 dark:text-${bgColor}-200`"
    >
      <svg
        v-if="success"
        class="w-4 h-4 fill-green-800"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 448 512"
      >
        <path
          d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"
        />
      </svg>

      <svg
        v-else
        class="w-3 h-3 fill-red-800"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 384 512"
      >
        <path
          d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"
        />
      </svg>
    </div>
    <div class="ms-3 text-sm font-normal">{{ message }}</div>
    <button
      type="button"
      :class="`ms-auto -mx-1.5 -my-1.5 bg-white text-${bgColor}-400 hover:text-${bgColor}-900 rounded-lg focus:ring-2 focus:ring-${bgColor}-300 p-1.5 hover:bg-${bgColor}-400 inline-flex items-center justify-center h-8 w-8 dark:text-${bgColor}-500 dark:hover:text-white dark:bg-${bgColor}-800 dark:hover:bg-${bgColor}-700`"
      data-dismiss-target="#toast-default"
      aria-label="Close"
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
    </button>
  </div>
</template>

<script>
export default {
  components: {},
  props: ["success", "message", "bgColor"],
  data() {
    return {};
  },
  mounted() {},
  computed: {},
  methods: {},
};
</script>