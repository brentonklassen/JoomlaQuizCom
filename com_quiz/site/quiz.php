<?php
/**
* @package Joomla.Administrator
* @subpackage com_quiz
*/
 
// No direct access to this file
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$user = JFactory::getUser();
if (!$user->id)
{
	$url = JURI::base().'index.php/login';
	$app->redirect($url);
	return;
}
 
// Get an instance of the controller prefixed by Quiz
$controller = JControllerLegacy::getInstance('Quiz');
 
// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();
