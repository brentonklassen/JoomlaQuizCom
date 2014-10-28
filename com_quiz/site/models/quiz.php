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

        $question1 = $jinput->get('question1');
        $question2 = $jinput->get('question2');

        return $question1 and $question2;
    }
    
    public function submitQuiz()
    {
        // get values to insert into db
        $user = JFactory::getUser();
        $userid = $user->id;
        $jinput = JFactory::getApplication()->input;
        $question1 = $jinput->get('question1');
        $question2 = $jinput->get('question2');
        $question3 = $jinput->get('question3');
        $question4 = $jinput->get('question4');
        $question5 = $jinput->get('question5');
        $question6 = $jinput->get('question6');
        $question7 = $jinput->get('question7');

        // set up db insert query
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $columns = array('user_id','question1','question2','question3',
            'question4','question5','question6','question7');
        $values = array($db->quote($userid),$db->quote($question1),
            $db->quote($question2),$db->quote($question3),$db->quote($question4),
            $db->quote($question5),$db->quote($question6),$db->quote($question7));
        $query
        ->insert($db->quoteName('#__quiz'))
        ->columns($db->quoteName($columns))
        ->values(implode(',', $values));

        // submit the insert query
        $db->setQuery($query);
        $db->query();
    }
}
