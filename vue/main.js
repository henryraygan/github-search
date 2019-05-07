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
		showModal: false,
		modal_info: Object,
		actual_commits: {}
	},
	methods: {
		search() {
			this.resetSearch();
			fetch(`https://api.github.com/search/repositories?q=${this.query}`)
				.then((data) => data.json())
				.then((response) => {
					this.completeSearch(response, true);
				});
		},
		kFormatter(num) {
			return Math.abs(num) > 999
				? Math.sign(num) * (Math.abs(num) / 1000).toFixed(1) + 'k'
				: Math.sign(num) * Math.abs(num);
		},
		dateFormatter(str) {
			if (!str) {
				return '(n/a)';
			}
			str = new Date(str);
			return (
				str.getFullYear() +
				'-' +
				(str.getMonth() < 9 ? '0' : '') +
				(str.getMonth() + 1) +
				'-' +
				(str.getDate() < 10 ? '0' : '') +
				str.getDate()
			);
		},
		openModal(item) {
			console.log(item);
			this.showModal = true;
			this.modal_info = item;
			this.getListCommits(this.modal_info.default_branch);
		},
		closeModal() {
			this.modal_info = {};
			this.showModal = false;
		},
		savedSearch(query) {
			fetch('/github-search/api/log.php', {
				headers: {
					Accept: 'application/json',
					'Content-Type': 'application/json'
				},
				method: 'POST',
				body: JSON.stringify({ keyword: query })
			}).then((res) =>
				res.json().then((response) => {
					// console.log(response);
				})
			);
		},
		getListCommits(default_branch) {
			const url = `https://api.github.com/repos/vuejs/vue/commits/${default_branch}`;
			fetch(url)
				.then((data) => data.json())
				.then((response) => {
					console.log(response);
			});
		},
		resetSearch() {
			this.isSearch = true;
			this.results = [];
			this.results_size = 0;
			this.modal_info = {};
		},
		completeSearch(response, status) {
			this.isSearch = !status;
			this.results = response.items;
			this.results_size = response.total_count;
			this.savedSearch(this.query);
		}
	}
});
