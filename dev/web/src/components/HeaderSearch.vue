<template>
  <header class="main-header">
    <div class="container">
      <div class="search-component">
        <div class="search-component__brand">
          <img
            src="http://www.logospng.com/images/149/tools-for-information-literacy-welcome-to-inls161-149487.png"
            alt="GitHub"
          >
        </div>
        <div class="search-box">
          <input v-model="keyword" type="text" class="search-box__input">
          <button
            @click="getList()"
            :disabled="keyword.length < 3"
            class="button button-primary search-box__button"
          >Buscar</button>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: "HeaderSearch",
  data() {
    return {
      keyword: "",
      results: {}
    };
  },
  methods: {
    getText() {
      return this.keyword;
    },
    getList() {
      const url = `https://api.github.com/search/repositories?p=1&q=${
        this.keyword
      }`;
      fetch(url)
        .then(data => data.json())
        .then(response => {
          this.results.keyword = this.keyword;
          this.results.total_count = response.total_count;
          this.results.items = response.items;
          console.log(this.results);
          this.savedSearch(this.keyword);
          this.$emit("results", this.results);
        });
    },
    savedSearch(query) {
      fetch('http://localhost/github-search/api/v1/log.php', {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json"
        },
        method: "POST",
        body: JSON.stringify({ keyword: query })
      }).then(res =>
        res.json().then(response => {
          console.log(response);
        })
      );
    }
  }
};
</script>