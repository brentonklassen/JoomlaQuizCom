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

        $question0 = $jinput->get('question0');
        $question1 = $jinput->get('question1');

        return $question0 and $question1;
    }
    
    public function submitQuiz()
    {
        // get values to insert into db
        $user = JFactory::getUser();
        $userid = $user->id;
        $jinput = JFactory::getApplication()->input;
        $question0 = $jinput->get('question0');
        $question1 = $jinput->get('question1');
        $question2 = $jinput->get('question2');
        $question3 = $jinput->get('question3');
        $question4 = $jinput->get('question4');
        $question5 = $jinput->get('question5');
        $question6 = $jinput->get('question6');
        $question7 = $jinput->get('question7');
        $question8 = $jinput->get('question8');
        $question9 = $jinput->get('question9');

        // set up db insert query
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $columns = array('user_id','question0','question1','question2','question3',
            'question4','question5','question6','question7','question8','question9');
        $values = array($db->quote($userid),$db->quote($question0),$db->quote($question1),
            $db->quote($question2),$db->quote($question3),$db->quote($question4),$db->quote($question5),
            $db->quote($question6),$db->quote($question7),$db->quote($question8),$db->quote($question9));
        $query
        ->insert($db->quoteName('#__quiz'))
        ->columns($db->quoteName($columns))
        ->values(implode(',', $values));

        // submit the insert query
        $db->setQuery($query);
        $db->query();
    }

    function getResults($userid)
    {
        $selectQuery = "select user_id, (q0+q1+q2+q3+q4+q5+q6+q7+q8+q9) as score from (
            select q.user_id,
            case when (select question0 from #__quiz where user_id=q.user_id)=(select question0 from #__quiz where user_id=".$userid.") then 1 else 0 end as q0,
            case when (select question1 from #__quiz where user_id=q.user_id)=(select question1 from #__quiz where user_id=".$userid.") then 1 else 0 end as q1,
            case when (select question2 from #__quiz where user_id=q.user_id)=(select question2 from #__quiz where user_id=".$userid.") then 1 else 0 end as q2,
            case when (select question3 from #__quiz where user_id=q.user_id)=(select question3 from #__quiz where user_id=".$userid.") then 1 else 0 end as q3,
            case when (select question4 from #__quiz where user_id=q.user_id)=(select question4 from #__quiz where user_id=".$userid.") then 1 else 0 end as q4,
            case when (select question5 from #__quiz where user_id=q.user_id)=(select question5 from #__quiz where user_id=".$userid.") then 1 else 0 end as q5,
            case when (select question6 from #__quiz where user_id=q.user_id)=(select question6 from #__quiz where user_id=".$userid.") then 1 else 0 end as q6,
            case when (select question7 from #__quiz where user_id=q.user_id)=(select question7 from #__quiz where user_id=".$userid.") then 1 else 0 end as q7,
            case when (select question8 from #__quiz where user_id=q.user_id)=(select question8 from #__quiz where user_id=".$userid.") then 1 else 0 end as q8,
            case when (select question9 from #__quiz where user_id=q.user_id)=(select question9 from #__quiz where user_id=".$userid.") then 1 else 0 end as q9

            from #__quiz as q
            where q.user_id != ".$userid." limit 3
        ) as scores order by score desc";

        $db = JFactory::getDbo();
        $db->setQuery($selectQuery);
        return $db->loadObjectList();
    }

    function getAllQuiztakers()
    {
        $selectQuery = "select user_id from #__quiz";
        $db = JFactory::getDbo();
        $db->setQuery($selectQuery);
        return $db->loadObjectList();
    }

    function deleteQuiz($userid)
    {
        $deleteQuery = "delete from #__quiz where user_id=".$userid;
        $db = JFactory::getDbo();
        $db->setQuery($deleteQuery);
        $result = $db->query();
    }
}
