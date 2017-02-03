<?php
/**
 * Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="paging btn-group">
	<?php
	echo $this->Paginator->prev('◄ ' . __d('users', 'previous'), array('class' => 'btn btn-default'), null, array('class' => 'btn btn-default disabled'));

    echo $this->Paginator->numbers(array('class' => 'btn btn-default', 'separator' => null, 'modulus' => 4 ));

	echo $this->Paginator->next(__d('users', 'next') . ' ►', array('class' => 'btn btn-default'), null, array('class' => 'btn btn-default disabled'));
	?>
</div>
