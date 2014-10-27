<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
/**
 * Quiz Model
 */
class QuizModelQuiz extends JModelItem
{
    protected $msg;

    public function getMsg()
    {
        $user = JFactory::getUser();
        return 'Hello there ' . $user->name;
    }

    public function quizTaken()
    {

        // todo query db and check if $user->email has taken the quiz

        return True;
    }
}
