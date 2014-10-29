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
		$jinput = $app->input;
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
		//$this->emailUpdates();
		$url = JRoute::_('index.php?option=com_quiz&view=quiz');
		$app->redirect($url);
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

	function toggleEmailUpdates()
	{
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$model = $this->getModel();
		$model->toggleEmailUpdates($user->id);
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
					$mailer = JFactory::getMailer();
					$mailer->setSender(array('friendfinder@calvary.edu','Calvary Friend Finder'));
					$mailer->addRecipient($thisuser->email);
					$mailer->setSubject($user->name.' made it into your top three!');
					
					$body   = "Your new top three is as follows:\n";
					foreach ($results as $result)
					{
						$thisuser = JFactory::getUser($result->user_id);
						$body .= "\n".$thisuser->name." with a score of ".$result->score;
					}

					$mailer->setBody($body);
					$send = $mailer->Send();
					if ( $send !== true ) {
					    echo 'Error sending email: ' . $send->__toString();
					}
				}
			}
		}
	}
}
