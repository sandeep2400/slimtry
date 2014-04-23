<?php
/**
 * Monga is a swift MongoDB Abstraction for PHP 5.3+
 *
 * @package    Monga
 * @version    1.0
 * @author     Frank de Jonge
 * @license    MIT License
 * @copyright  2011 - 2012 Frank de Jonge
 * @link       http://github.com/FrenkyNet/Monga
 */

namespace Monga\Query;

class Group extends Computer
{
	/**
	 * Set the group field
	 *
	 * @param   mixed   group field or hash
	 * @return  object  $this
	 */
	public function by($index)
	{
		$this->fields['_id'] = $this->prepareField($index);

		return $this;
	}

	/**
	 * Return the group contents.
	 *
	 * @return  array  group statement
	 */
	public function getGroup()
	{
		return $this->fields;
	}
}