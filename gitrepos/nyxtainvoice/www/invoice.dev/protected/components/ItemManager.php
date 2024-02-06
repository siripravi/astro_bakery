<?php

class ItemManager extends TabularInputManager
{

    protected $class = 'statementItems';

    public function getItems()
    {
        if (is_array($this->_items))
            return ($this->_items);
        else
            return array(
                'n0' => new statementItems(),
            );
    }


    public function deleteOldItems($model, $itemsPk)
    {
        $criteria = new CDbCriteria;
        $criteria->addNotInCondition('id', $itemsPk);
        $criteria->addCondition("st_id= {$model->primaryKey}");

        Student::model()->deleteAll($criteria);
    }


    public static function load($model)
    {
        $return = new ItemManager;
        foreach ($model->items as $item)
            $return->_items[$item->primaryKey] = $item;
        return $return;
    }


    public function setUnsafeAttribute($item, $model)
    {
        $item->st_id = $model->primaryKey;

    }


}