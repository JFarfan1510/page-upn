<?php use function htmlspecialchars as e; ?>

<form id="simulacro" action="#">
	<div class="title">
		<h3><b>SIMULACRO</b></h3>
		<p>Responde las preguntas que ves a continuación.</p>
	</div>
	<div class="progreso">
		<div class="progreso-info">
			<h5 class="progreso-porcentaje">Progreso: <span> 0%</span> de 100 preguntas</h5>
			<div class="progreso-time">Tiempo <span>0h 0m 0s</span> </div>
		</div>
		<div class="progreso-barra"><span></span></div>
	</div>
	<?php foreach($data as $pregunta_id => $pregunta){ ?>

		<div class="pregunta">
			<h5 class="pregunta-texto">
				<?=e($pregunta['text'])?>
			</h5>
			<ul>
				<?php foreach($pregunta['choises'] as $alternativa_id => $alternativa){ ?>
					<li class="alternativa">
						<label>
							<input type="radio" name="pregunta-<?=$pregunta_id?>" value=<?=$alternativa_id?>> <?=e($alternativa['text'])?>
						</label>
					</li>
				<?php } ?>
			</ul>
		</div>
	<?php } ?>

	<div class="notice"></div>
	<div class="btn-grupo">
		<button class="btn-siguiente previous" type="button">Anterior</button>
		<button class="btn-siguiente next" type="sumbit">Siguiente</button>
		<button class="btn-siguiente finish" type="button">Finalizar</button>
	</div>
</form>

