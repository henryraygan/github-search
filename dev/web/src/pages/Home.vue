<template>
  <div>
    <header-search @results="showResults($event)"></header-search>
    <list-repositories
      v-if="results.length > 0"
      @item="showItem($event)"
      :keyword="keyword"
      :repos="results"
      :total="total_count"
    ></list-repositories>
    <dialog-info v-if="showModal" @close="showModal = false">
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
              <td class="author-info">{{modal_info.full_name}}</td>
            </tr>
            <tr>
              <td class="author-key">Created</td>
              <td class="author-info">{{ formatDate(modal_info.created_at) }}</td>
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
            <tr>
              <td class="author-key">Commits</td>
              <td class="author-info"></td>
            </tr>
          </table>
          <p v-if="recents_commits===null">Commits is empty</p>
          <div v-else class="panel-commits">
            <ul class="list-commits">
              <li v-for="(item, key) in recents_commits" :key="key">
                <span class="list-commits-message">
                  <a :href="item.html_url" target="_blank">{{ item.commit.message }}</a>
                </span>
                <br>
                <span
                  class="list-commits-author"
                >{{ item.commit.author.name}} commited {{ formatDate(item.commit.author.date) }}</span>
                <span class="committed"></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </dialog-info>
  </div>
</template>

<script>
import HeaderSearch from "../components/HeaderSearch";
import ListRepositories from "../components/ListRepositories";

import DialogInfo from "../components/DialogInfo";

export default {
  name: "Home",
  components: {
    HeaderSearch,
    ListRepositories,
    DialogInfo
  },
  data() {
    return {
      keyword: "",
      results: [],
      total_count: 0,
      modal_info: {},
      showModal: false,
      recents_commits: null
    };
  },
  methods: {
    showResults(results) {
      this.results = results.items;
      this.keyword = results.keyword;
      this.total_count = results.total_count;
    },
    formatDate(dated) {
      let date = new Date(dated);
      var year = date.getFullYear(),
        month = date.getMonth() + 1, // months are zero indexed
        day = date.getDate(),
        hour = date.getHours(),
        minute = date.getMinutes(),
        second = date.getSeconds(),
        hourFormatted = hour % 12 || 12, // hour returned in 24 hour format
        minuteFormatted = minute < 10 ? "0" + minute : minute,
        morning = hour < 12 ? "am" : "pm";

      return (
        month +
        "/" +
        day +
        "/" +
        year +
        " " +
        hourFormatted +
        ":" +
        minuteFormatted +
        morning
      );
    },
    dateFormatter(str) {
      if (!str) {
        return "(n/a)";
      }
      str = new Date(str);
      return (
        str.getFullYear() +
        "-" +
        (str.getMonth() < 9 ? "0" : "") +
        (str.getMonth() + 1) +
        "-" +
        (str.getDate() < 10 ? "0" : "") +
        str.getDate()
      );
    },
    getListCommits(owner, repo) {
      const URL = `https://api.github.com/repos/${owner}/${repo}/commits?author=${owner}`;
      const URL2 = `https://api.github.com/repos/${owner}/${repo}/commits`;
      fetch(URL2)
        .then(data => data.json())
        .then(response => {
          if (!response.message) {
            this.recents_commits = response;
          }
        });
    },
    showItem(item) {
      this.getListCommits(item.owner.login, item.name);
      this.showModal = true;
      this.modal_info = item;
    }
  }
};
</script>