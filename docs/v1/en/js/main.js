window.addEventListener('DOMContentLoaded', event => {

	//alternar la barra lateral
	const sidebarToggle = document.body.querySelector('#sidebarToggle');
	if (sidebarToggle) {
		sidebarToggle.addEventListener('click', (event) => {
			event.preventDefault();
			let sidebar = document.getElementById('sidebar');
			console.log(sidebar.classList[1]);
			sidebar.classList.toggle('toggle-sidebar');
			// localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
		});
	}

	//desplazar 55px mas los <a> para evitar que el nav cubra los titulos
	const links = document.querySelectorAll('a[href^="#"]');
	links.forEach(link => {
		link.addEventListener("click", (event) => {
			event.preventDefault();
			const targetId = link.getAttribute("href");
			const target = document.querySelector(targetId);
			if (target) {
				window.scroll({
					top: target.offsetTop - 55,
					left: 0,
					behavior: "smooth"
				});
			}
		});
	});

});


