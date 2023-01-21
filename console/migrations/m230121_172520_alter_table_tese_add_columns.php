<?php

use yii\db\Migration;

/**
 * Class m230121_172520_alter_table_tese_add_columns
 */
class m230121_172520_alter_table_tese_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'tese', 'data_publicacao', $this->dateTime());
        $this->addColumn('tese', 'resumo', $this->string(512));
        $this->addColumn( 'tese', 'destaque', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn( 'tese', 'data_publicacao');
        $this->dropColumn( 'tese', 'resumo');
        $this->dropColumn( 'tese', 'destaque');

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
        echo "m230121_172520_alter_table_tese_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
