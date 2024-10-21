// modal.js
Vue.component('modal-error', {
  template: `
    <div v-if="isVisible" class="modal-overlay">
      <div class="modal-content">
        <h3>Error</h3>
        <p>{{ errorMessage }}</p>
        <button @click="closeModal">Cerrar</button>
      </div>
    </div>
  `,
  data() {
    return {
      isVisible: false,
      errorMessage: ''
    };
  },
  methods: {
    openModal(message) {
      this.errorMessage = message;
      this.isVisible = true;
    },
    closeModal() {
      this.isVisible = false;
    }
  }
});
