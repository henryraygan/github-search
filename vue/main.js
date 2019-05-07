var app = new Vue({
	el: '#search',
	data: {
		button_text: 'Buscar',
		query: ''
	},
	methods: {
		search() {
			fetch('http://localhost/SimpleDemoPHP/api')
				.then(function(response) {
					return response.json();
				})
				.then(function(myJson) {
					console.log(myJson);
				});
		}
	}
});
