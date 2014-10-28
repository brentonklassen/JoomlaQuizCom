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
    
    public function quizTaken()
    {

        // todo query db and check if $user->email has taken the quiz

        return False;
    }

    public function formCompleted()
    {
        $jinput = JFactory::getApplication()->input;

        $ministry = $jinput->get('ministry');
        $weddingpassage = $jinput->get('weddingpassage');

        return $ministry and $weddingpassage;
    }
    
    public function submitQuiz()
    {
        $jinput = JFactory::getApplication()->input;
    }
}
