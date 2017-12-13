<?php

namespace app\module\admin\models;

/**
 * This is the ActiveQuery class for [[Analyzes]].
 *
 * @see Analyzes
 */
class AnalyzesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Analyzes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Analyzes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
