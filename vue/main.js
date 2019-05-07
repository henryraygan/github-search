var app = new Vue({
	el: '#search',
	data: {
		button_text: 'Buscar',
		query: '',
		results_size: 0,
		results: []
	},
	methods: {
		search() {
			fetch(`https://api.github.com/search/repositories?q=${this.query}`)
				.then((data) => data.json())
				.then((response) =>  {
					this.results = response.items;
					console.log(response);
					this.results_size = response.total_count;
					console.log(this.results);
				});
		},
		kFormatter(num) {
			return Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'k' : Math.sign(num)*Math.abs(num)
		}
	}
});
