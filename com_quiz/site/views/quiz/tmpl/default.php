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

<div class="page-header">
	<h2 itemprop="name">Here are your results!</h2>
</div>

<?php

echo "<p>Based on the ".$this->quizzesTaken." quizzes that have been taken, 
the friend finder recommends that you get to know these people.";

echo "<h2>You'd be fantastic friends!</h2>";
echo "<p>You were recommended for each other and the recommendation was over 7.</p>";
echo "<ul class='results'>";

if ($this->fantasticFriends)
{
	foreach ($this->fantasticFriends as $friend)
	{
		$thisUser = JFactory::getUser($friend->user_id);
		echo "<li>".$thisUser->name."</li>";
	}
}
else
{
	echo "<li>No one here yet. Retake the quiz or check back later to find fantastic friends!</li>";
}
echo "</ul>";

echo "<h2>Your top three recommendations are...</h2>";
echo "<ul class='results'>";

foreach ($this->topThreeResults as $topThreeUser)
{
	$thisUser = JFactory::getUser($topThreeUser->user_id);
	echo "<li>".$thisUser->name." with a recommendation of ".$topThreeUser->score."</li>";
}
echo "</ul>";

echo "<h2>These people should get to know you.</h2>";
echo "<p>The friend finder recommended to these people that they should get to know you.</p>";
echo "<ul class='results'>";
if ($this->othersWhoGotMe)
{
	foreach ($this->othersWhoGotMe as $other)
	{
		$thisUser = JFactory::getUser($other->user_id);
		echo "<li>".$thisUser->name."</li>";
	}
}
else
{
	echo "<li>No one here yet. Retake the quiz or check back later to recommend yourself to others!</li>";
}
echo "</ul>";

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

		<label>What is the best time of day?</label>
		<label class="radio">
			<input name='question0' type="radio" value='a' />
			I am a morning person
		</label>
		<label class="radio">
			<input name='question0' type="radio" value='b' />
			Afternoons
		</label>
		<label class="radio">
			<input name='question0' type="radio" value='c' />
			I am a night owl
		</label>
		<label class="radio">
			<input name='question0' type="radio" value='d' />
			Dinner time
		</label>

		<br />

		<label>Who makes the best tech?</label>
		<label class="radio">
			<input name='question1' type="radio" value='a' />
			Apple
		</label>
		<label class="radio">
			<input name='question1' type="radio" value='b' />
			Microsoft
		</label>
		<label class="radio">
			<input name='question1' type="radio" value='c' />
			Google
		</label>
		<label class="radio">
			<input name='question1' type="radio" value='d' />
			I hate computers
		</label>

		<br />

		<label>What is your favorite color?</label>
		<label class="radio">
			<input name='question2' type="radio" value='a' />
			Red
		</label>
		<label class="radio">
			<input name='question2' type="radio" value='b' />
			Yellow
		</label>
		<label class="radio">
			<input name='question2' type="radio" value='c' />
			Blue
		</label>
		<label class="radio">
			<input name='question2' type="radio" value='d' />
			Other
		</label>

		<br />

		<label>What type of food is best?</label>
		<label class="radio">
			<input name='question3' type="radio" value='a' />
			Italian
		</label>
		<label class="radio">
			<input name='question3' type="radio" value='b' />
			Mexican
		</label>
		<label class="radio">
			<input name='question3' type="radio" value='c' />
			Greek
		</label>
		<label class="radio">
			<input name='question3' type="radio" value='d' />
			American
		</label>

		<br />

		<label>Do you prefer DC or Marvel?</label>
		<label class="radio">
			<input name='question4' type="radio" value='a' />
			DC
		</label>
		<label class="radio">
			<input name='question4' type="radio" value='b' />
			Marvel
		</label>
		<label class="radio">
			<input name='question4' type="radio" value='c' />
			Both
		</label>
		<label class="radio">
			<input name='question4' type="radio" value='d' />
			Don't care
		</label>

		<br />

		<label>Which state is the best?</label>
		<label class="radio">
			<input name='question5' type="radio" value='a' />
			Nebraska
		</label>
		<label class="radio">
			<input name='question5' type="radio" value='b' />
			Kansas
		</label>
		<label class="radio">
			<input name='question5' type="radio" value='c' />
			Missouri
		</label>
		<label class="radio">
			<input name='question5' type="radio" value='d' />
			Montana
		</label>

		<br />

		<label>What genre of music?</label>
		<label class="radio">
			<input name='question6' type="radio" value='a' />
			Pop
		</label>
		<label class="radio">
			<input name='question6' type="radio" value='b' />
			Country
		</label>
		<label class="radio">
			<input name='question6' type="radio" value='c' />
			Rap
		</label>
		<label class="radio">
			<input name='question6' type="radio" value='d' />
			Classical
		</label>

		<br />

		<label>What sport is most fun to watch?</label>
		<label class="radio">
			<input name='question7' type="radio" value='a' />
			Basketball
		</label>
		<label class="radio">
			<input name='question7' type="radio" value='b' />
			Baseball
		</label>
		<label class="radio">
			<input name='question7' type="radio" value='c' />
			Football
		</label>
		<label class="radio">
			<input name='question7' type="radio" value='d' />
			Soccer
		</label>

		<br />

		<label>What is the correct term?</label>
		<label class="radio">
			<input name='question8' type="radio" value='a' />
			Soda
		</label>
		<label class="radio">
			<input name='question8' type="radio" value='b' />
			Pop
		</label>
		<label class="radio">
			<input name='question8' type="radio" value='c' />
			Coke
		</label>
		<label class="radio">
			<input name='question8' type="radio" value='d' />
			Soft drink
		</label>

		<br />

		<label>What character quality do you value most?</label>
		<label class="radio">
			<input name='question9' type="radio" value='a' />
			Loyalty
		</label>
		<label class="radio">
			<input name='question9' type="radio" value='b' />
			Honesty
		</label>
		<label class="radio">
			<input name='question9' type="radio" value='c' />
			Trustworthiness
		</label>
		<label class="radio">
			<input name='question9' type="radio" value='d' />
			Patience
		</label>

		<br />

		<label class="checkbox">
			<input name='emails' type="checkbox" value='t' />
			Send me an email when my top 3 changes.
		</label>

		<br />
		
		<button type="submit" class="btn">See your results!</button>

	</fieldset>
</form>

<?php endif; ?>