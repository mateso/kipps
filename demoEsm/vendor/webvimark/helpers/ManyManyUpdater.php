<?php
namespace webvimark\helpers;
use yii\db\Query;

/**
 * Class ManyManyUpdater
 *
 * @package webvimark\helpers
 */
class ManyManyUpdater
{
	/**
	 * update
	 *
	 * @param array $freshData - data from POST
	 * @param string $connecting_table - connecting table
	 * @param string $primaryFieldName
	 * @param string $secondaryFieldName
	 * @param int $id  - primary ID
	 */
	public static function update($freshData, $connecting_table, $primaryFieldName, $secondaryFieldName, $id)
	{
		if (is_array($freshData) AND ! empty($freshData))
		{
			$alreadySelected = (new Query())
				->from($connecting_table)
				->where([
					$primaryFieldName => $id,
				])
				->all();

			$oldData = array();
			foreach ($alreadySelected as $as)
			{
				$oldData[] = $as[$secondaryFieldName];
			}

			$toAdd    = array_diff($freshData, $oldData);
			$toRemove = array_diff($oldData, $freshData);

			if (! empty($toAdd))
				self::updateToAdd($connecting_table, $primaryFieldName, $secondaryFieldName, $toAdd, $id);

			if (! empty($toRemove))
				self::updateToRemove($connecting_table, $primaryFieldName, $secondaryFieldName, $toRemove, $id);

		}
		else // Delete all data ff all fields are unchecked
		{
			(new Query())->createCommand()
				->delete($connecting_table, [
					$primaryFieldName => $id
				])->execute();
		}
	}


	/**
	 * updateToAdd
	 *
	 * @param string $connecting_table
	 * @param string $primaryFieldName
	 * @param string $secondaryFieldName
	 * @param array $toAdd
	 * @param int $id
	 */
	protected static function updateToAdd($connecting_table, $primaryFieldName, $secondaryFieldName, $toAdd, $id)
	{
		$data = [];

		foreach ($toAdd as $secondaryId)
		{
			$data[] = [$id, $secondaryId];
		}

		(new Query())->createCommand()
			->batchInsert($connecting_table, [$primaryFieldName, $secondaryFieldName], $data)
			->execute();
	}

	/**
	 * updateToRemove
	 *
	 * @param string $connecting_table
	 * @param string $primaryFieldName
	 * @param string $secondaryFieldName
	 * @param array $toRemove
	 * @param int $id
	 */
	protected static function updateToRemove($connecting_table, $primaryFieldName, $secondaryFieldName, $toRemove, $id)
	{
		(new Query())->createCommand()
			->delete($connecting_table, [
				$primaryFieldName => $id,
				$secondaryFieldName => $toRemove,
			])->execute();
	}

}