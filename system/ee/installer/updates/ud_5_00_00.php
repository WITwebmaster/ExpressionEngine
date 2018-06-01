<?php
/**
 * ExpressionEngine (https://expressionengine.com)
 *
 * @link      https://expressionengine.com/
 * @copyright Copyright (c) 2003-2017, EllisLab, Inc. (https://ellislab.com)
 * @license   https://expressionengine.com/license
 */

namespace EllisLab\ExpressionEngine\Updater\Version_5_0_0;

/**
 * Update
 */
class Updater {

	var $version_suffix = '';

	/**
	 * Do Update
	 *
	 * @return TRUE
	 */
	public function do_update()
	{
		$steps = new \ProgressIterator(
			[
				'addQueueTable',
			]
		);

		foreach ($steps as $k => $v)
		{
			$this->$v();
		}

		return TRUE;
	}

	private function addQueueTable()
	{
		ee()->dbforge->add_field(
			[
				'queue_id'   => [
					'type'           => 'int',
					'constraint'     => 10,
					'unsigned'       => TRUE,
					'null'           => FALSE,
					'auto_increment' => TRUE
				],
				'identifier' => [
					'type'       => 'varchar',
					'constraint' => 200,
					'null'       => FALSE
				],
				'step'       => [
					'type'           => 'int',
					'constraint'     => 10,
					'unsigned'       => TRUE,
					'null'           => FALSE,
					'default'        => 1
				],
				'total'      => [
					'type'           => 'int',
					'constraint'     => 10,
					'unsigned'       => TRUE,
					'null'           => FALSE,
					'default'        => 1
				],
				'data'       => [
					'type'       => 'mediumtext',
					'null'       => TRUE,
				],
			]
		);
		ee()->dbforge->add_key('queue_id', TRUE);
		ee()->dbforge->add_key('identifier');
		ee()->smartforge->create_table('queue');
	}
}

// EOF