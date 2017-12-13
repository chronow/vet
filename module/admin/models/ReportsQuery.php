<?php

namespace app\module\admin\models;

/**
 * This is the ActiveQuery class for [[Reports]].
 *
 * @see Reports
 */
class ReportsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Reports[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Reports|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
