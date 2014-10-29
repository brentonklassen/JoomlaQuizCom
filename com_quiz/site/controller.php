<?php
/**
* @package Joomla.Administrator
* @subpackage com_quiz
*/
 
// No direct access to this file
defined('_JEXEC') or die;
 
// import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * Quiz Component Controller
 *
 * @since   0.0.1
 */
class QuizController extends JControllerLegacy
{
	function submitQuiz()
	{
		$app = JFactory::getApplication();
		$jinput = JFactory::getApplication()->input;
		$model = $this->getModel();

		for ($i=0; $i<2; $i++) // for each question
		{
			if (!$jinput->get("question$i")) // if it is not answered
			{
				// redirect back to the quiz
				$url = JRoute::_('index.php?option=com_quiz&view=quiz&submitted=1');
				$app->redirect($url);
			}
		}

		$model->submitQuiz();
		$this->emailUpdates();
		$url = JRoute::_('index.php?option=com_quiz&view=quiz');
		//$app->redirect($url);
	}

	function retakeQuiz()
	{
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$model = $this->getModel();

		$model->deleteQuiz($user->id);
		$url = JRoute::_('index.php?option=com_quiz&view=quiz');
		$app->redirect($url);
	}

	function emailUpdates()
	{
		$user = JFactory::getUser();
		$model = $this->getModel();
		$quiztakers = $model->getAllQuiztakers();

		foreach ($quiztakers as $quiztaker)
		{
			if ($user->id == $quiztaker->user_id)
			{
				continue; // skip the current user
			}

			$results = $model->getResults($quiztaker->user_id);

			foreach ($results as $result){
				if ($result->user_id == $user->id)
				{
					// current user made it into the results, so send email
					$thisuser = JFactory::getUser($quiztaker->user_id);
					echo 'Here are the new results for '.$thisuser->name;
					print_r($results);
				}
			}
		}
	}
}
