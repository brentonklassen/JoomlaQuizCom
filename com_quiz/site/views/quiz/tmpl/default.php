<?php
/**
* @package Joomla.Administrator
* @subpackage com_quiz
*/
 
// No direct access to this file
defined('_JEXEC') or die;

$user = JFactory::getUser();
// Check if user is logged in
if (!$user->id): ?>

<h1>You must be logged in to take the quiz</h1>

<?php elseif ($this->quizTaken): ?>

<h1>You already took this quiz.</h1>

<?php elseif ($this->formCompleted): ?>
<h1>Here are your results!</h1>

<?php else: ?>

<h1>Welcome to the friend finder quiz, <?php echo $user->name; ?></h1>

<form action="<?php echo JRoute::_('index.php?option=com_quiz&view=quiz'); ?>" method="post">
	<fieldset>

		<legend>Friend finder quiz</legend>

		<label>What is your favorite type of ministry?</label>
		<label class="radio">
			<input name='ministry' type="radio" value='pastoral' /> Pastoral
		</label>
		<label class="radio">
			<input name='ministry' type="radio" value='childrens' /> Children's ministry
		</label>
		<label class="radio">
			<input name='ministry' type="radio" value='missions' /> Mission work
		</label>
		<label class="radio">
			<input name='ministry' type="radio" value='none' /> None
		</label>

		<br />

		<label>What Scripture passage do you want read at your wedding?</label>
		<label class="radio">
			<input name='weddingpassage' type="radio" value='corinthians' /> 1 Corinthians 13
		</label>
		<label class="radio">
			<input name='weddingpassage' type="radio" value='ecclesiastes' /> Ecclesiastes 4
		</label>
		<label class="radio">
			<input name='weddingpassage' type="radio" value='songofsolomon' /> Songs of Solomon
		</label>
		<label class="radio">
			<input name='weddingpassage' type="radio" value='none' /> None
		</label>

		<br />
		
		<button type="submit" class="btn">See your results!</button>

	</fieldset>
</form>

<?php endif; ?>