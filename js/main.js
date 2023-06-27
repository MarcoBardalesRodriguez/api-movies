document.addEventListener('DOMContentLoaded', () => {
	console.log('init js');

	const btn = document.getElementById("button");
	let endpoint = document.getElementById("endpoint");
	const hints = document.getElementsByClassName("hint");

	//comprueba que existan los elementosHTML y asigna eventos
	if (btn) {
		//pase directo ejecuta tras la carga del DOM
		btn.addEventListener('click', fetchData(endpoint.value));
		//pase por referencia ejecuta tras evento click
		btn.addEventListener('click', () => {fetchData(endpoint.value)});
		//console.log('created button successfully');
	}
	if (endpoint) {
		//pase por referencia ejecuta tras evento keypress
		endpoint.addEventListener('keypress', (event) => {pressEnter(event)})
	}
	if (hints) {
		for (let hint of hints) {
			hint.addEventListener('click', (event) => {replaceContent(event);})
		}
	}


	//funcion que hace un fetch a un endpoint 
	//llama a la funcion showResponse pasando la data en formato json
	function fetchData(endpoint) {
		// use  diferent api url if us on localhost or on production
		let host = window.location.hostname === "localhost" ?
			"http://localhost" :
			"https://apimovies.apps.marcobardalesrodriguez.site";
		let api = `${host}/api/v1/${endpoint}`;
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
				//libreria highlight para resaltado de sintaxis
				hljs.highlightAll();
			})
			.catch((error) => console.error(error));
	}


	//funcion que muestra data usando un template html
	//recive data en formato json y lo formatea
	//comprueba si existe data previa y la reemplaza si es necesario
	function showResponse(data) {
		//comprueba y elimina si existe mas de un elemento hijo 
		while (container_response.childElementCount != 1) {
			container_response.removeChild(container_response.lastChild);
		}
		let node = template.content.cloneNode(true);
		if (node) {
			console.log('node created successfully');
		}
		let code = node.querySelector('code');
		const jsonString = JSON.stringify(data, null, 2);
		//let jsonString = JSON.stringify(data, function (key, value) {
		//	if (typeof value === "object" && value !== null) {
		//		return JSON.stringify(value, this, 2);
		//	}
		//	return value;
		//});
		code.innerHTML = jsonString;
		container_response.appendChild(node);
	}


	//funcion que ejecuta un evento click en #button
	//cuando se pulsa enter desde un elementoHTML
	function pressEnter(e) {
		if (e.keyCode === 13) {
			button.click();
		}
	}


	//funcion que remplaza el value de #endpoint
	//con el contenido del elemento que llama la funcion
	function replaceContent(event) {
		console.log(endpoint.value);
		endpoint.value = '';
		endpoint.value = event.target.innerHTML;
	}


});
