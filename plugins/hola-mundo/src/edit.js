/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { useBlockProps } from '@wordpress/block-editor';
import React, { useState, useEffect } from 'react';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
/*import "./preguntas.json";*/
/*import apiFetch from "@wordpress/api-fetch";*/

export default function Edit(props) {
    let test_id = props.test;
    let test_contador = 0;
    let test_data = /* fetch(test_id) */[
        {
            'pregunta': '¿Cuál es el factor que favorece la gran variedad ictiológica del mar peruano?',
            'respuestas': [
                'La frialdad de sus aguas',
                'El talud continental estrecho',
                'La poca salinidad del mar',
				'El elevado calor de las nubes',
            ],
            'correct':'El talud continental estrecho'
        },
        {
            'pregunta': 'La Meseta del Collao de gran extensión en el Perú se ubica en el departamento de:',
            'respuestas': [
                'Puno',
                'Apurímac',
                'Junín',
				'Madre de Dios',
            ],
            'correct':'Junín'
        },
        {
            'pregunta': 'El principal producto de extracción del centro minero de Yanacocha es:',
            'respuestas': [
                'Oro',
                'Plomo',
                'Cobre',
				'Hierro',
            ],
            'correct':'Cobre'
        }
    ];
    const [currentQuestion, setCurrentQuestion] = useState(0);
    const handleAnswerButtonClick = () =>{
        const nextQuestion = currentQuestion +1;
        setCurrentQuestion(nextQuestion);
    }
    return (
        
        <div className='app'>
        <>
            <div className='question-section'>
                <div class="title">
                    <h3><b>SIMULACRO</b></h3>
                    <p>Responde las preguntas que ves a continuación.</p>
                </div>
				<div class="progreso">
					<div class="progreso-info">
						<h5 class="progreso-porcentaje">Progreso: <span>{currentQuestion + 1}</span> de 100 preguntas</h5>
						<div class="progreso-time">Tiempo <span>0h 0m 0s</span> </div>
					</div>
					<div class="progreso-barra"><span></span></div>
				</div>
				<div className='pregunta'>
					<div className='pregunta-texto'>{test_data[currentQuestion].pregunta}</div>
					<ul>
						<li className='alternativa'>
							<label>
								{test_data[currentQuestion].respuestas.map((rpta) => (
                    				<div>
										<input type='radio'/> {rpta}
                    				</div>
               				 	))}								
							</label>
						</li>
					</ul>
				</div>
            <div class="btn-grupo">
            <button class="btn-siguiente" type="sumbit" onClick={handleAnswerButtonClick}>Siguiente</button>
        	</div>  
		</div>  
        </>
        </div>
		
	);
}
