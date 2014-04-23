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

class Find extends Where
{
	/**
	 *  @var  array  $orderBy  collection ordering
	 */
	protected $orderBy = array();

	/**
	 *  @var  int  $skip  query offset
	 */
	protected $skip;

	/**
	 *  @var  int  $limit  query limit
	 */
	protected $limit;

	/**
	 * @var  bool  $findOne  whether to find one, or more
	 */
	protected $findOne = false;

	/**
	 * @var  array  $fields  fields include exclude array
	 */
	protected $fields = array();

	/**
	 * Set the result limit
	 *
	 * @param   integer  $amount  limit
	 * @return  object   $this
	 */
	public function limit($amount)
	{
		$this->limit = $amount;

		return $this;
	}

	/**
	 * Set the amount to skip in the result.
	 *
	 * @param   integer  $amount  skip
	 * @return  object   $this
	 */
	public function skip($amount)
	{
		$this->skip = $amount;

		return $this;
	}

	/**
	 *  Orders a collection
	 *
	 *  @param  string $field       field to order by
	 *  @param  string $direction  asc/desc/1/-1
	 *  @return object             current instance
	 */
	public function orderBy($field, $direction = 1)
	{
		if (is_string($direction))
		{
			$direction = $direction === 'asc' ? 1 : -1;
		}

		$this->orderBy[$field] = $direction;

		return $this;
	}

	/**
	 *  Specifies fields to select
	 *
	 *  @param  string $field field to select
	 *
	 *  @return object        current instance
	 */
	public function select($field)
	{
		$fields = func_get_args();

		foreach ((array) $fields as $field)
		{
			$this->fields[$field] = 1;
		}
	}

	/**
	 *  Specifies fields to exclude
	 *
	 *  @param  string $field fields to exclude
	 *
	 *  @return object        current instance
	 */
	public function exclude($field)
	{
		$fields = func_get_args();

		foreach ($fields as $field)
		{
			$this->fields[$field] = -1;
		}
	}

	/**
	 * Influence the select/exclude array in MongoDB fashion.
	 *
	 * @param    array  $fields  associative array to include/exclude fields.
	 */
	public function fields(array $fields)
	{
		foreach ($fields as $field => &$value)
		{
			$value = $value ? 1 : -1;
		}

		$this->fields = array_merge($this->fields, $fields);

		return $this;
	}

	/**
	 *  Retrieve the select statement.
	 *
	 *  @return array|null array of fields to select or exclude
	 */
	public function getFields()
	{
		return empty($this->fields) ? array() : $this->fields;
	}

	/**
	 * Set the find type, one or many
	 *
	 * @param   bool   $one  true for one, false for many
	 * @return  object       current instance
	 */
	public function one($one = true)
	{
		$this->findOne = (bool) $one;

		return $this;
	}

	/**
	 * Set the find type, one or many
	 *
	 * @param   bool   $multiple  false for one, true for many
	 * @return  object            current instance
	 */
	public function multiple($multiple = true)
	{
		$this->findOne = ! $multiple;

		return $this;
	}

	/**
	 *  Get the post-find actions.
	 *
	 *  @return  array  post-find actions
	 */
	public function getPostFindActions()
	{
		$actions = array();

		empty($this->orderBy) or $actions[] = array('sort', $this->orderBy);
		$this->skip === null or $actions[] = array('skip', $this->skip);
		$this->limit === null or $actions[] = array('limit', $this->limit);

		return $actions;
	}

	/**
	 * Returns whether to find one, false for multiple
	 *
	 * @return  boolean  whether to find one
	 */
	public function getFindOne()
	{
		return (bool) $this->findOne;
	}
}