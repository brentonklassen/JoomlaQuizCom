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
        $user = JFactory::getUser();

        // Get a db connection.
        $db = JFactory::getDbo();
         
        // Create a new query object.
        $query = $db->getQuery(true);
         
        // Prepare select query
        $query->select('*');
        $query->from($db->quoteName('#__quiz'));
        $query->where($db->quoteName('user_id') . ' = '. $user->id);
         
        // Reset the query using our newly populated query object.
        $db->setQuery($query);
         
        // Load the results as a list of stdClass objects (see later for more options on retrieving data).
        return $db->loadObjectList();
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

    function getResults()
    {
        $user = JFactory::getUser();
        $selectQuery = "select user_id, (q1+q2+q3+q4+q5+q6+q7) as score from (
            select q.user_id,
            case when (select question1 from u6ktq_quiz where user_id=q.user_id)=(select question1 from u6ktq_quiz where user_id=".$user->id.") then 1 else 0 end as q1,
            case when (select question2 from u6ktq_quiz where user_id=q.user_id)=(select question2 from u6ktq_quiz where user_id=".$user->id.") then 1 else 0 end as q2,
            case when (select question3 from u6ktq_quiz where user_id=q.user_id)=(select question3 from u6ktq_quiz where user_id=".$user->id.") then 1 else 0 end as q3,
            case when (select question4 from u6ktq_quiz where user_id=q.user_id)=(select question4 from u6ktq_quiz where user_id=".$user->id.") then 1 else 0 end as q4,
            case when (select question5 from u6ktq_quiz where user_id=q.user_id)=(select question5 from u6ktq_quiz where user_id=".$user->id.") then 1 else 0 end as q5,
            case when (select question6 from u6ktq_quiz where user_id=q.user_id)=(select question6 from u6ktq_quiz where user_id=".$user->id.") then 1 else 0 end as q6,
            case when (select question7 from u6ktq_quiz where user_id=q.user_id)=(select question7 from u6ktq_quiz where user_id=".$user->id.") then 1 else 0 end as q7

            from u6ktq_quiz as q
            where q.user_id != ".$user->id." limit 3
        ) as scores order by score desc";

        $db = JFactory::getDbo();
        $db->setQuery($selectQuery);
        return $db->loadObjectList();
    }
}
