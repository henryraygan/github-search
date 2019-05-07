Vue.component('modal', {
	template: '#modal-template'
});

var app = new Vue({
	el: '#search',
	data: {
		button_text: 'Buscar',
		query: '',
		results_size: 0,
		results: [],
		isSearch: false,
		showModal: false
	},
	methods: {
		search() {
			this.isSearch = true;
			this.results = [];
			this.results_size = 0;
			fetch(`https://api.github.com/search/repositories?q=${this.query}`)
				.then((data) => data.json())
				.then((response) => {
					fetch('/github-search/api/log.php', {
						headers: {
							Accept: 'application/json',
							'Content-Type': 'application/json'
						},
						method: 'POST',
						body: JSON.stringify({ keyword: this.query })
					}).then((res) =>
						res.json().then((response) => {
							console.log(response);
						})
					);

					this.isSearch = false;
					this.results = response.items;
					this.results_size = response.total_count;
				});
		},
		kFormatter(num) {
			return Math.abs(num) > 999
				? Math.sign(num) * (Math.abs(num) / 1000).toFixed(1) + 'k'
				: Math.sign(num) * Math.abs(num);
		},
		openModal(text) {
			this.showModal = true;
			this.title = text;
		},
		closeModal() {
			this.showModal = false;
		}
	}
});
