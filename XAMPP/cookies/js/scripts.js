$("#btn1").click(function (e) { 
	$("#link_css").attr("href", "css/tema1.css");
	Cookies.set('tema', 'tema1.css', {
		expires: 30,
		path: '/kevin/cookies'
	}); //En vez de poner en segundos, con esta librería se puede poner el tiempo de expiración en días
});

$("#btn2").click(function (e) {
	$("#link_css").attr("href", "css/tema2.css");
	Cookies.set('tema', 'tema2.css', {
		expires: 30,
		path: '/kevin/cookies'
	});
});

$("#btn3").click(function (e) {
	$("#link_css").attr("href", "css/tema3.css");
	Cookies.set('tema', 'tema3.css', {
		expires: 30,
		path: '/kevin/cookies'
	});
});

$("#btn4").click(function (e) {
	$("#link_css").attr("href", "css/tema4.css");
	Cookies.set('tema', 'tema4.css', {
		expires: 30,
		path: '/kevin/cookies'
	});
});