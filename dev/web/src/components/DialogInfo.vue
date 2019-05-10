<template>
  <div @click="close">
    <div slot="body">
      <div class="repo-modal-header">
        <h2 class="repo-modal-title">{{ modal_info.name }}</h2>
        <p class="repo-modal-fullname">{{ modal_info.description }}</p>
      </div>
      <div class="author">
        <table>
          <tr>
            <td class="author-key">Author</td>
            <td class="author-info">
              <img
                class="author-img"
                :src="modal_info.owner.avatar_url"
                :alt="modal_info.owner.login"
              >
              {{modal_info.owner.login}}
            </td>
          </tr>
          <tr>
            <td class="author-key">Full name</td>
            <td class="author-info">text</td>
          </tr>
          <tr>
            <td class="author-key">Created</td>
            <td class="author-info">text</td>
          </tr>
          <tr>
            <td class="author-key">License</td>
            <td class="author-info">
              <span v-if="modal_info.license !== null">{{ modal_info.license.name }}</span>
              <span v-else>There is no information about the license</span>
            </td>
          </tr>
          <tr>
            <td class="author-key">Clone</td>
            <td class="author-info">
              <span>git clone {{ modal_info.clone_url }}</span>
            </td>
          </tr>
        </table>
        <div class="panel-commits">
          <ul class="list-commits">
            <li>
              commit message
              <br>
              <span class="committed"></span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
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
  beforeCreated() {
    this.modal_info = this.info;
  },
  methods: {
    close() {
      this.$emit("close");
    }
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
};
</script>