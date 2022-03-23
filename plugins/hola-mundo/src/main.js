var $$ = function (selector, base) {
	var node_list = (base || document).querySelectorAll(selector);
	return Array.prototype.slice.apply(node_list);
};


var TestVocacional = function (form) {
	this.dom = {};

	this.data_respuestas = {};

	this.pregunta_actual = null;

	this.timer = {
		start : null,
		end   : null,
	};

	this.build(form, this.dom);
	this.setup(this.dom);

	this.mostrarPreguntaInicial();

	this.startTimer();
};


Object.assign(TestVocacional.prototype, {

	build: function (form, dom) {
		dom.form      = form;
		dom.preguntas = $$('.pregunta', form);
		dom.mensaje   = form.querySelector('.notice');

		dom.buttons = {
			previous : form.querySelector('button.previous'),
			next     : form.querySelector('button.next'),
			finish   : form.querySelector('button.finish'),
		};

		dom.progreso = {
			porcentaje : form.querySelector('.progreso-porcentaje span'),
			barra      : form.querySelector('.progreso-barra span'),
			time       : form.querySelector('.progreso-time span'),
		};
	},


	setup: function (dom) {
		dom.form.addEventListener('submit', this.onSubmit.bind(this));
		dom.buttons.previous.addEventListener('click', this.mostrarPreguntaAnterior.bind(this));
		dom.buttons.finish.addEventListener('click', this.finalizarTest.bind(this));

		dom.preguntas.forEach(function (pregunta, pregunta_indice) {
			$$('input', pregunta).forEach(function (input, alternativa_indice) {
				input.addEventListener('click', this.cuandoSeleccioneAlternativa.bind(this, pregunta_indice, alternativa_indice));
			}, this);
		}, this);
	},


	// -------------------------------------------------------------------------


	startTimer: function () {
		this.timer.start  = new Date();
		this.timer.ticker = window.setInterval(this.tickTimer.bind(this), 1000);
	},


	finishTimer: function () {
		window.clearInterval(this.timer.ticker);
		this.updateTimer();
	},


	getPassedTime: function () {
		var delta_time_ms = this.timer.end - this.timer.start;
		var delta_time_s = delta_time_ms / 1000;

		return this.formatTime(delta_time_s);
	},

	updateTimer: function () {
		this.dom.progreso.time.innerHTML = this.getPassedTime();
	},


	formatTime: function (sec_num) {
		var hours   = Math.floor(sec_num / 3600);
		var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
		var seconds = parseInt(sec_num - (hours * 3600) - (minutes * 60));

		if (hours   < 10) {hours   = '0' + hours;}
		if (minutes < 10) {minutes = '0' + minutes;}
		if (seconds < 10) {seconds = '0' + seconds;}

		return hours + 'h ' + minutes + 'm ' + seconds + 's';
	},


	tickTimer: function () {
		this.timer.end = new Date();
		this.updateTimer();
	},



	// -------------------------------------------------------------------------


	onSubmit: function (event) {
		event.preventDefault();

		this.mostrarPreguntaSiguiente();
	},


	cuandoSeleccioneAlternativa: function (pregunta_indice, alternativa_indice) {
		this.recolectarDataRespuestas(pregunta_indice, alternativa_indice);
		this.validarPreguntaAlternativaSeleccionada(pregunta_indice);
	},


	recolectarDataRespuestas: function (pregunta_indice, alternativa_indice) {
		this.data_respuestas[pregunta_indice] = alternativa_indice;
	},


	validarPreguntaMarcoAlternativa: function (pregunta_indice) {
		var pregunta     = this.dom.preguntas[pregunta_indice];
		var alternativas = $$('input', pregunta);
		var marcadas     = alternativas.filter(function (input) { return input.checked; });

		var es_valido = marcadas.length === 1;

		return es_valido;
	},


	validarPreguntaAlternativaSeleccionada: function (pregunta_indice) {
		var tiene_alternativa_seleccionada = this.validarPreguntaMarcoAlternativa(pregunta_indice);
		var mensaje = '';

		if (!tiene_alternativa_seleccionada) {
			mensaje = 'Selecciona una respuesta';
		}

		this.actualizarMensaje(mensaje, 'error');
	},


	mostrarPreguntaInicial: function () {
		this.mostrarPregunta(0);
	},


	mostrarPreguntaSiguiente: function () {
		var se_marco_pregunta_actual = true; // this.validarPreguntaMarcoAlternativa(this.pregunta_actual);

		if (se_marco_pregunta_actual) {
			this.mostrarPregunta(this.pregunta_actual + 1);
		} else {
			this.validarPreguntaAlternativaSeleccionada(this.pregunta_actual)
		}
	},


	actualizarMensaje: function (mensaje, type) {
		var el = this.dom.mensaje;

		el.classList.remove('error');
		el.classList.remove('success');
		el.classList.add(type);
		el.innerHTML = mensaje;
	},


	mostrarPreguntaAnterior: function () {
		this.actualizarMensaje('', 'error');
		this.mostrarPregunta(this.pregunta_actual - 1);
	},


	mostrarPregunta: function (pregunta_indice) {
		this.pregunta_actual = pregunta_indice;

		this.dom.preguntas.forEach(function (pregunta, i) {
			pregunta.style.display = i === pregunta_indice ? 'block' : 'none';
		}, this);

		this.actualizarProgreso();
		this.actualizarBotones();
	},


	calcularProgreso: function () {
		var porcentaje = ((this.pregunta_actual + 1) / this.dom.preguntas.length) * 100;
		return porcentaje;
	},


	actualizarProgreso: function () {
		var porcentaje = this.calcularProgreso();

		this.dom.progreso.porcentaje.innerHTML = parseInt(porcentaje) + '%';
		this.dom.progreso.barra.style.width    = parseInt(porcentaje) + '%';
	},


	actualizarBotones: function () {
		var buttons = this.dom.buttons;

		var es_primera_pregunta = this.pregunta_actual === 0;
		var es_ultima_pregunta  = this.pregunta_actual === this.dom.preguntas.length - 1;

		var esconder_boton_previous = es_primera_pregunta;
		var esconder_boton_next     = es_ultima_pregunta;
		var esconder_boton_finish   = !es_ultima_pregunta;

		buttons.previous.classList[esconder_boton_previous ? 'add' : 'remove']('is-hidden');
		buttons.next.classList[esconder_boton_next ? 'add' : 'remove']('is-hidden');
		buttons.finish.classList[esconder_boton_finish ? 'add' : 'remove']('is-hidden');
	},


	mostrarMensajeFinalizado: function () {
		this.dom.form.innerHTML = '' +
			'<h1 class="notice success">Mensaje enviado! Gracias!</h1>' +
			'<p>Tiempo transcurrido: ' + this.getPassedTime() + '</p>';
	},


	enviarDatosBackend: function () {
		var respuestas = this.data_respuestas;
		var usuario    = this.obtenerDatosPersona();

		var datos = {
			usuario    : usuario,
			respuestas : respuestas,
		};

		console.log(datos);

		// var xmlht = new XMLHttpRequest();
		// xmlht.send(datos);
	},


	obtenerDatosPersona: function () {
		// var datos = JSON.parse(localStorage.get('datos-usuario'));
		var datos = {
			nombre  : 'Julio',
			email   : 'jJulio@local.com',
			colegio : 'Julio Cesar Tello',
		};

		return datos;
	},


	finalizarTest: function () {
		this.mostrarMensajeFinalizado();
		this.enviarDatosBackend();
		this.finishTimer();
	}

});



window.addEventListener('DOMContentLoaded',function(){
	window.test_vocacional = new TestVocacional(document.querySelector('#simulacro'));
});


/* function hola(){
		const question = document.querySelector('#pregunta')
		const choices = Array.from(document.querySelectorAll('.resp'))
		const progressBarfull = Array.from(document.querySelector('.bar'))
		console.log('hola',question)
		console.log('hola',choices)
		console.log('hola',progressBarfull)

		let currentQuestion = {}
		let questionCounter = 0
		let avaibleQuestions = []
}
 */
