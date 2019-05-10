<template>
  <div>
    <header-search @results="showResults($event)">
    </header-search>
    <list-repositories v-if="results.length > 0"
        :keyword="keyword" 
        :repos="results" 
        :total="total_count">
    </list-repositories>
  </div>
</template>

<script>
import HeaderSearch from "../components/HeaderSearch";
import ListRepositories from "../components/ListRepositories";
export default {
  name: "Home",
  components: {
    HeaderSearch,
    ListRepositories
  },
  data() {
    return {
      keyword: '',
      results: [],
      total_count: 0
    };
  },
  methods: {
    showResults(results) {
      this.results = results.items;
      this.keyword = results.keyword;
      this.total_count = results.total_count;
    }
  }
};
</script>