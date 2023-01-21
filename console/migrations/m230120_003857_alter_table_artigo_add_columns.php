<?php

use yii\db\Migration;

/**
 * Class m230120_003857_alter_table_artigo_add_columns
 */
class m230120_003857_alter_table_artigo_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'artigo', 'descricao', $this->text());
        $this->addColumn('artigo', 'resumo', $this->string(512));
        $this->addColumn( 'artigo', 'destaque', $this->boolean());
        $this->addColumn( 'artigo', 'data_publicacao', $this->dateTime());
        $this->dropColumn( 'artigo', 'year');

        Yii::$app->cache->flush();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn( 'artigo', 'descricao');
        $this->dropColumn( 'artigo', 'resumo');
        $this->dropColumn( 'artigo', 'destaque');
        $this->dropColumn( 'artigo', 'data_publicacao');

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
        echo "m230120_003857_alter_table_artigo_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
