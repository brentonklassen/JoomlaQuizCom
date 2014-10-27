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
<?php else: ?>

<h1><?php echo $this->msg; ?></h1>

<?php endif; ?>