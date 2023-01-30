<?php

use yii\db\Migration;

/**
 * Class m230128_135902_create_table_arquivo
 */
class m230128_135902_create_table_arquivo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('arquivo', [
            'id' => $this->primaryKey(),
            'arquivo' => $this->string(100)->notNull(),
            'tipo_mime' => $this->string(100),
            'tamanho' => $this->decimal(10),
            'nome_original' => $this->string(100),
            'legenda' => $this->string(255),
            'posicao' => $this->integer(),
            'data_publicacao' => $this->date(),
            'tipo' => $this->string(2),
            'ativo' => $this->boolean()->defaultValue(true),
            'data_criacao' => $this->dateTime(),
            'data_modificacao' => $this->dateTime()
        ]);

        Yii::$app->cache->flush();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('arquivo');

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
        echo "m230128_135902_create_table_arquivo cannot be reverted.\n";

        return false;
    }
    */
}
