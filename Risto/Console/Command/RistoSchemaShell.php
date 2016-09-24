<?php



App::uses('SchemaShell', 'Console/Command');

/**
 * Schema is a command-line database management utility for automating programmer chores.
 *
 * Schema is CakePHP's database management utility. This helps you maintain versions of
 * of your database.
 *
 * @package       Cake.Console.Command
 * @link          http://book.cakephp.org/2.0/en/console-and-shells/schema-management-and-migrations.html
 */
class RistoSchemaShell extends SchemaShell {

	/**
 * Update database with Schema object
 * Should be called via the run method
 *
 * @param CakeSchema &$Schema The schema instance
 * @param string $table The table name.
 * @return void
 */
	protected function _update(&$Schema, $table = null) {
		$db = ConnectionManager::getDataSource($this->Schema->connection);

		$this->out(__d('cake_console', 'Comparing Database to Schema...'));
		$options = array();
		$this->params['force'] = false;
		if (isset($this->params['force'])) {
			$options['models'] = false;
		}
		$Old = $this->Schema->read($options);
		$compare = $this->Schema->compare($Old, $Schema);

		$contents = array();
		if (!empty($compare['media'])) {
			unset($compare['media']);
		}
		if (empty($table)) {
			foreach ($compare as $table => $changes) {
				if (isset($compare[$table]['create'])) {
					$contents[$table] = $db->createSchema($Schema, $table);
				} else {
					$contents[$table] = $db->alterSchema(array($table => $compare[$table]), $table);
				}
			}
		} elseif (isset($compare[$table])) {
			if (isset($compare[$table]['create'])) {
				$contents[$table] = $db->createSchema($Schema, $table);
			} else {
				$contents[$table] = $db->alterSchema(array($table => $compare[$table]), $table);
			}
		}

		if (empty($contents)) {
			$this->out(__d('cake_console', 'Schema is up to date.'));
			return false;
		}

		$this->out("\n" . __d('cake_console', 'The following statements will run.'));
		$this->out(array_map('trim', $contents));
		if (!empty($this->params['yes']) ||
			$this->in(__d('cake_console', 'Are you sure you want to alter the tables?'), array('y', 'n'), 'n') === 'y'
		) {
			$this->out();
			$this->out(__d('cake_console', 'Updating Database...'));
			$this->_run($contents, 'update', $Schema);
		}

		$this->out(__d('cake_console', 'End update.'));
	}
}