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

		for ($i=0; $i<10; $i++) // for each question
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
		$othersWhoGotMe = $model->getOthersWhoGotMe($user->id);
		foreach ($othersWhoGotMe as $otherUser)
		{
			$emailUpdatesOn = $model->emailUpdatesOn($otherUser->user_id);

			if ($emailUpdatesOn)
			{
				$thisuser = JFactory::getUser($otherUser->user_id);
				$mailer = JFactory::getMailer();
				$mailer->setSender(array('friendfinder@calvary.edu','Calvary Friend Finder'));
				$mailer->addRecipient($thisuser->email);
				$mailer->setSubject($user->name.' made it into your top three!');

				$results = $model->getResults($thisuser->id);
				
				$body   = "Your new top three is as follows:\n";
				foreach ($results as $result)
				{
					$thisuser = JFactory::getUser($result->user_id);
					$body .= "\n".$thisuser->name." with a score of ".$result->score;
				}
				$body .= "\n\nCheck CalvaryFriends.net to see if you have any fantastic friends";
				$body .= " and to see who the friend finder recommended should get to know you.";

				$mailer->setBody($body);
				$send = $mailer->Send();
				if ( $send !== true ) {
				    echo 'Error sending email: ' . $send->__toString();
				}
			}
		}
	}
}
