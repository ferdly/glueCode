<?php

function renderHelloWorldArray($options = array())
 {
 	$hello_world['interjection'] = 'hello';
 	$hello_world['subject'] = 'world';
 	$hello_world['punctuation'] = '!';

	$sentence = ''; 
	$sentence .= ucfirst($hello_world['interjection']); 
	$sentence .= ' '; 
	$sentence .= ucfirst($hello_world['subject']); //it's as much a title as a sentence, what the heck capitalize 'world' 
 	$sentence .= $hello_world['punctuation'];

 	$buffer = '';
 	$buffer .= $sentence;
 	#function bufferPrintR($variable, $variable_name = '', $header_string = '', $options = array()) {
 	#function bufferPrintR(
 	#				$variable IS what you would pass to print_r() regularly, 
 	#				$variable_name = 'usually $variable (above) in single quotes' // -- although you can break this convention if you like 
 	#				$header_string = 'some additonal string that helps explain why you are print_r()-ing this $variable', 
 	#				$options = array() IS just a generalize parameter so that this function is extensible via this
 	$buffer .= bufferPrintR($hello_world, '$hello_world', 'Here is the classic demo as an array');

 	return $buffer;
 }


























function bufferPrintR($variable, $variable_name = '', $header_string = '', $options = array()) {
	$buffer = '';
	$buffer .= empty($header_string)?'':'<h3>' . $header_string . '</h3>';
	$buffer .= empty($variable_name)?'':'<br><em>' . $variable_name . '</em></br>';
	$buffer .= '<pre>';
	$buffer .= print_r($variable, true);
	$buffer .= '</pre>';

	return $buffer;
}
function renderDocumentation($options = array()) {
	$declaration = '<h6>Function:&nbsp;' . __FUNCTION__ . '<br>Line:&nbsp;' . (__LINE__ - 1) . '<br>File:&nbsp;' . basename(__FILE__) . '</h6>';
	
	$buffer = '';
	$buffer .= '<h2>Documentation Template</h2>';
	$buffer .= $declaration;
	
	$buffer .= '<ul>';
	$buffer .= "
	<li>But will any whaleman believe these stories? No</li>
	<li> The whale of to-day is as big as his ancestors in Pliny's time</li>
	<li> And if ever I go where Pliny is, I, a whaleman (more than he was), will make bold to tell him so</li>";
	$buffer .= '</ul>';

	return $buffer;
}

function renderTodo($options = array()) {
	$declaration = '<h6>Function:&nbsp;' . __FUNCTION__ . '<br>Line:&nbsp;' . (__LINE__ - 1) . '<br>File:&nbsp;' . basename(__FILE__) . '</h6>';

	$buffer = '';
	$buffer .= '<h2>Quick-n-Dirty To-Do List Template</h2>';
	$buffer .= $declaration;
	
	$buffer .= '<ol>';
	$buffer .= "
	<li>\"Be so good, both of you, as to follow me\"</li>
	<li> Mr Fogg betrayed no surprise whatever</li>
	<li> The policeman was a representative of the law, and law is sacred to an Englishman</li>
	<li> Passepartout tried to reason about the matter, but the policeman tapped him with his stick, and Mr</li>
	<li> Fogg made him a signal to obey</li>
	<li> \"May this young lady go with us?\" asked he</li>
	<li> \"She may,\" replied the policeman</li>
	<li> Mr Fogg, Aouda, and Passepartout were conducted to a palkigahri, a sort of four-wheeled carriage, drawn by two horses, in which they took their places and were driven away</li>";
	$buffer .= '</ol>';

	return $buffer;
}