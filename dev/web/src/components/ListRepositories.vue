<template>
  <div class="container">
    <section class="list-repositories">
      <h3 v-if="repos" class="list-repositories__stats">{{ formatNumber(total) }} repository results</h3>
      <div v-if="repos" class="repos">
        <div v-for="(item, key) in repos" :key="key" class="repo">
          <div class="repo__header">
            <p class="repo__title">{{item.full_name}}</p>
            <p class="repo__stars">
              <i class="fas fa-star"></i>
              {{kFormatter(item.stargazers_count)}}
            </p>
          </div>
          <p class="repo__description">{{item.description}}</p>
        </div>
      </div>
    </section>

    <button v-if="total > 30" @click="loadMore" class="button button-more">More</button>
  </div>
</template>

<script>
import Loading from "./Loading.vue";
import DialogInfo from "./DialogInfo.vue";

export default {
  name: "ListRepositories",
  components: {
    Loading,
    DialogInfo
  },
  props: {
    keyword: String,
    repos: Array,
    total: Number,
    loading: Boolean
  },
  data() {
    return {
      actual_page: 1
    };
  },
  methods: {
    kFormatter(num) {
      return Math.abs(num) > 999
        ? Math.sign(num) * (Math.abs(num) / 1000).toFixed(1) + "k"
        : Math.sign(num) * Math.abs(num);
    },
    formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    },
    loadMore() {
      this.actual_page++;
      const url = `https://api.github.com/search/repositories?q=${
        this.keyword
      }&page=${this.actual_page}`;
      fetch(url)
        .then(data => data.json())
        .then(response => {
          this.repos.push(...response.items);
        });
    }
  }
};
</script>