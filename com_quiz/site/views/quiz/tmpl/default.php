<?php
/**
* @package Joomla.Administrator
* @subpackage com_quiz
*/
 
// No direct access to this file
defined('_JEXEC') or die;

$jinput = JFactory::getApplication()->input;
$user = JFactory::getUser();
// Check if user is logged in
if (!$user->id): ?>

<h1>You must be logged in to take the quiz</h1>

<?php elseif ($this->quizTaken): ?>

<h1>Here are your results!</h1>
<h2>Your top three are...</h2>

<ul>
<?php

foreach ($this->quizResults as $result)
{
	$thisUser = JFactory::getUser($result->user_id);
	echo "<li>".$thisUser->name." with a score of ".$result->score."</li>";
}

?>
</ul>

<br />

<a class='btn' href="<?php echo JRoute::_('index.php?option=com_quiz&view=quiz&task=retakeQuiz'); ?>">Retake quiz</a>

<?php else: ?>

<h1>Welcome to the friend finder quiz, <?php echo $user->name; ?></h1>

<?php 
// if the user already tried to submit,
// tell them to fill out all questions first
if ($jinput->get('submitted'))
{
	echo "<div class='alert alert-error'>You must answer all the quiz questions.</div>";
}
?>

<form action="<?php echo JRoute::_('index.php?option=com_quiz&view=quiz&task=submitQuiz'); ?>" method="post">
	<fieldset>

		<legend>Friend finder quiz</legend>

		<label>What is your favorite type of ministry?</label>
		<label class="radio">
			<input name='question0' type="radio" value='a' />
			Pastoral
		</label>
		<label class="radio">
			<input name='question0' type="radio" value='b' />
			Children's ministry
		</label>
		<label class="radio">
			<input name='question0' type="radio" value='c' />
			Mission work
		</label>
		<label class="radio">
			<input name='question0' type="radio" value='d' />
			None
		</label>

		<br />

		<label>What Scripture passage do you want read at your wedding?</label>
		<label class="radio">
			<input name='question1' type="radio" value='a' />
			1 Corinthians 13
		</label>
		<label class="radio">
			<input name='question1' type="radio" value='b' />
			Ecclesiastes 4
		</label>
		<label class="radio">
			<input name='question1' type="radio" value='c' />
			Songs of Solomon
		</label>
		<label class="radio">
			<input name='question1' type="radio" value='d' />
			None
		</label>

		<br />
		
		<button type="submit" class="btn">See your results!</button>

	</fieldset>
</form>

<?php endif; ?>