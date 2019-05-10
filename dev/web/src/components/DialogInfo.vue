<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-footer">
            <slot name="footer">
              <button class="modal-default-button" @click="$emit('close')">
                <i class="fas fa-times"></i>
              </button>
            </slot>
          </div>
          <div class="modal-body">
            <slot name="body">default body</slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: "DialogInfo",
  props: {
    info: Object,
    show: Boolean
  },
  data() {
    return {
      modal_info: {}
    };
  },
  methods: {
    close() {
      this.$emit("close");
    },
    getListCommits(owner, repo) {
      const URL = `https://api.github.com/repos/${owner}/${repo}/commits?author=${owner}`;
      fetch(URL)
        .then(data => data.json())
        .then(response => {
          this.recents_commits = response.map(r => r.commit);
          console.log(response);
          console.log(this.recents_commits);
        });
    }
  }
};
</script>