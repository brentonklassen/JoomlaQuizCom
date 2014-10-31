<?php
/**
* @package Joomla.Administrator
* @subpackage com_quiz
*/
 
// No direct access to this file
defined('_JEXEC') or die;
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
* HTML View class for the HelloWorld Component
*
* @since 0.0.1
*/
class QuizViewQuiz extends JViewLegacy
{
        public function display($tpl = null) 
        {
                // Assign data to the view
                $user = JFactory::getUser();
                $model = $this->getModel();
                $this->quizTaken = $model->quizTaken();
                $this->emailUpdatesOn = $model->emailUpdatesOn($user->id);

                if ($this->quizTaken)
                {
                        $this->topThreeResults = $model->getResults($user->id);
                        $this->othersWhoGotMe = $model->getOthersWhoGotMe($user->id);
                        $this->fantasticFriends = array();
                        $this->quizzesTaken = $model->getQuizzesTaken();

                        foreach ($this->othersWhoGotMe as $otherkey => $otherUser)
                        {
                                foreach ($this->topThreeResults as $topThreeUser)
                                {
                                        // if this other user is also a top three user
                                        if ($otherUser->user_id == $topThreeUser->user_id)
                                        {
                                                // if their score is over 6
                                                // add them to fantasticFriends
                                                if ($topThreeUser->score > 7)
                                                {
                                                        $this->fantasticFriends[] = $topThreeUser;
                                                }
                                        }
                                }
                        }
                }
 
                // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
                        return false;
                }

 
                // Display the view
                parent::display($tpl);
        }
}
