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
		recents_commits: {},
		actual_page: 1
	},
	methods: {
		search() {
			this.resetSearch();
			const url = `https://api.github.com/search/repositories?q=${this.query}&type=Repositories`;
			fetch(url).then((data) => data.json()).then((response) => {
				this.completeSearch(response, true);
			});
		},
		kFormatter(num) {
			return Math.abs(num) > 999
				? Math.sign(num) * (Math.abs(num) / 1000).toFixed(1) + 'k'
				: Math.sign(num) * Math.abs(num);
		},
		formatNumber(num) {
			return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
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
			this.getListCommits(this.modal_info.owner.login, this.modal_info.name);
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
					console.log(response);
				})
			);
		},
		getListCommits(owner, repo) {
			const URL = `https://api.github.com/repos/${owner}/${repo}/commits?author=${owner}`;
			fetch(URL).then((data) => data.json()).then((response) => {
				
				this.recents_commits = response.map(r => r.commit);
				console.log(response);
				console.log(this.recents_commits);
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
			console.log(response);
			this.savedSearch(this.query);
		},
		loadMore() {
			this.actual_page++;
			const url = `https://api.github.com/search/repositories?q=${this.query}&page=${this.actual_page}`;
			fetch(url).then((data) => data.json()).then((response) => {
				this.results.push(...response.items);
			});
		}	
	}
});
