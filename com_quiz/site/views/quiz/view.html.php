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
        /**
         * Display the Quiz view
         *
         * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
         *
         * @return  void
         */

        /**
         * I'm going to reference my model here and make calls to it.
         * I hope this is the way I'm supposed to do it.
        */


        public function display($tpl = null) 
        {
                // Assign data to the view
                $user = JFactory::getUser();
                $model = $this->getModel();
                $this->quizTaken = $model->quizTaken();
                $this->formCompleted = $model->formCompleted();

                if($this->formCompleted){
                        $model->submitQuiz();
                }

                if($this->formCompleted || $this->quizTaken)
                {
                        $this->quizResults = $model->getResults($user->id);
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
