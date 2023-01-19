<?php

use yii\db\Migration;

/**
 * Class m230118_234859_create_table_evento
 */
class m230118_234859_create_table_evento extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('evento', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string(256),
            'resumo' => $this->string(512),
            'local' => $this->string(1024),
            'descricao' => $this->text(),
            'data_inicio' => $this->dateTime(),
            'data_fim' => $this->dateTime(),
            'destaque' => $this->boolean()->defaultValue(false),
            'data_criacao' => $this->dateTime(),
            'data_modificacao' => $this->dateTime(),
        ]);

        Yii::$app->cache->flush();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('evento');

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
        echo "m230118_234859_create_table_evento cannot be reverted.\n";

        return false;
    }
    */
}
