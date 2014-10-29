<?php
/**
* @package Joomla.Administrator
* @subpackage com_quiz
*/
 
// No direct access to this file
defined('_JEXEC') or die;

$jinput = JFactory::getApplication()->input;
$user = JFactory::getUser();
$document = JFactory::getDocument();

// Add styles
$style = 'ul.results {'
        . 'font-size: 16px;'
        . '}'; 
$document->addStyleDeclaration($style);

if ($this->quizTaken): ?>

<h1>Here are your results!</h1>

<?php

echo "<h2>Your top three are...</h2>";
echo "<ul class='results'>";

foreach ($this->topThreeResults as $topThreeUser)
{
	$thisUser = JFactory::getUser($topThreeUser->user_id);
	echo "<li>".$thisUser->name." with a score of ".$topThreeUser->score."</li>";
}

echo "</ul>";

if ($this->fantasticFriends)
{
	echo "<h2>Fantastic Friends</h2>";
	echo "<p>These are friends in your top 3 and you are in their top 3 and your score is 7 or higher</p>";
	echo "<ul class='results'>";
	foreach ($this->fantasticFriends as $friend)
	{
		$thisUser = JFactory::getUser($friend->user_id);
		echo "<li>".$thisUser->name."</li>";
	}
	echo "</ul>";
}

if ($this->othersWhoGotMe)
{
	echo "<h2>Others who got me</h2>";
	echo "<p>These are people that have you in their top 3</p>";
	echo "<ul class='results'>";
	foreach ($this->othersWhoGotMe as $other)
	{
		$thisUser = JFactory::getUser($other->user_id);
		echo "<li>".$thisUser->name."</li>";
	}
	echo "</ul>";
}

?>

<br />

<a class='btn' href="<?php echo JRoute::_('index.php?option=com_quiz&view=quiz&task=retakeQuiz'); ?>">Retake quiz</a>
<a class='btn' href="<?php echo JRoute::_('index.php?option=com_quiz&view=quiz&task=toggleEmailUpdates'); ?>">
	<?php echo ($this->emailUpdatesOn) ? 'Turn off emails' : 'Turn on emails'; ?>
</a>

<?php else: 
// quiz has not been taken
?>

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