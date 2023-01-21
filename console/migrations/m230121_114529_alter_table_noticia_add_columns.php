<?php

use yii\db\Migration;

/**
 * Class m230121_114529_alter_table_noticia_add_columns
 */
class m230121_114529_alter_table_noticia_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('noticia', 'resumo', $this->string(512));
        $this->addColumn( 'noticia', 'destaque', $this->boolean());
        $this->addColumn( 'noticia', 'principal', $this->boolean());
        $this->addColumn( 'noticia', 'data_publicacao', $this->dateTime());
        $this->dropColumn( 'noticia', 'date');

        Yii::$app->cache->flush();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn( 'noticia', 'resumo');
        $this->dropColumn( 'noticia', 'principal');
        $this->dropColumn( 'noticia', 'destaque');
        $this->dropColumn( 'noticia', 'data_publicacao');

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
        echo "m230121_114529_alter_table_noticia_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
