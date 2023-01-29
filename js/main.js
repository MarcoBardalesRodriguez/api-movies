document.addEventListener('DOMContentLoaded', () => {
	console.log('init js');

	const btn = document.getElementById("button");
	let endpoint = document.getElementById("endpoint");

	if (btn) {
		btn.addEventListener('click', fetchData(endpoint.value));
		btn.addEventListener('click', () => {fetchData(endpoint.value)});
		console.log('created button successfully');
	}
	if (endpoint) {
		endpoint.addEventListener('keypress', () => {pressEnter(event)})
	}


	function fetchData(endpoint) {
		let api = `http://localhost/api-movies/api/v1/${endpoint}`;
		console.log(api);

		fetch(api, {
			method: "GET",
			headers: {
				"Content-Type": "application/json",
			},
		})
			.then(response => response.json())
			.then(data => {
				console.log(data);
				showResponse(data);
				hljs.highlightAll();
			})
			.catch((error) => console.error(error));
	}


	function showResponse(data) {
		while (container_response.childElementCount != 1) {
			container_response.removeChild(container_response.lastChild);
		}
		let node = template.content.cloneNode(true);
		if (node) {
			console.log('node created successfully');
		}
		let code = node.querySelector('code');
		const jsonString = JSON.stringify(data, null, 2);
		code.innerHTML = jsonString;
		container_response.appendChild(node);
	}
	//let jsonString = JSON.stringify(data, function (key, value) {
	//	if (typeof value === "object" && value !== null) {
	//		return JSON.stringify(value, this, 2);
	//	}
	//	return value;
	//});
	function pressEnter(e) {
		if (e.keyCode === 13) {
			button.click();
		}
	}


});
