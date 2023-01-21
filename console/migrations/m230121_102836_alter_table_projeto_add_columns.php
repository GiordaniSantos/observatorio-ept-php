<?php

use yii\db\Migration;

/**
 * Class m230121_102836_alter_table_projeto_add_columns
 */
class m230121_102836_alter_table_projeto_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'projeto', 'destaque', $this->boolean());
        $this->addColumn( 'projeto', 'data_publicacao', $this->dateTime());

        Yii::$app->cache->flush();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn( 'projeto', 'destaque');
        $this->dropColumn( 'projeto', 'data_publicacao');

        Yii::$app->cache->flush();
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230121_102836_alter_table_projeto_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
