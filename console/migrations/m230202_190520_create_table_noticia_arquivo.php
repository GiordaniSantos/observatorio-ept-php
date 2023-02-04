<?php

use yii\db\Migration;

/**
 * Class m230202_190520_create_table_noticia_arquivo
 */
class m230202_190520_create_table_noticia_arquivo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->renameColumn( 'noticia', 'news_id', 'id');

         $this->createTable('noticia_arquivo', [
            'id' => $this->primaryKey(),
            'id_noticia' => $this->integer(),
            'id_arquivo' => $this->integer(),
            'tipo' => $this->string(2),
            'capa' => $this->boolean()
        ]);
        
        // creates index for column `id_noticia`
        $this->createIndex(
            'noticia_arquivo_id_noticia_idx',
            'noticia_arquivo',
            'id_noticia'
        );
        
        // add foreign key for table `noticia`
        $this->addForeignKey(
            'noticia_arquivo_id_noticia_fk',
            'noticia_arquivo',
            'id_noticia',
            'noticia',
            'id',
            'CASCADE'
        );
        
        // creates index for column `id_arquivo`
        $this->createIndex(
            'noticia_arquivo_id_arquivo_idx',
            'noticia_arquivo',
            'id_arquivo'
        );
        
        // add foreign key for table `arquivo`
        $this->addForeignKey(
            'noticia_arquivo_id_arquivo_fk',
            'noticia_arquivo',
            'id_arquivo',
            'arquivo',
            'id',
            'CASCADE'
        );
        
        Yii::$app->cache->flush();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `noticia`
        $this->dropForeignKey(
            'noticia_arquivo_id_noticia_fk',
            'noticia_arquivo'
        );
        
        // drops index for column `id_noticia`
        $this->dropIndex(
            'noticia_arquivo_id_noticia_idx',
            'noticia_arquivo'
        );
        
        // drops foreign key for table `arquivo`
        $this->dropForeignKey(
            'noticia_arquivo_id_arquivo_fk',
            'noticia_arquivo'
        );
        
        // drops index for column `id_arquivo`
        $this->dropIndex(
            'noticia_arquivo_id_arquivo_idx',
            'noticia_arquivo'
        );
        
        $this->dropTable('noticia_arquivo');
        
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
        echo "m230202_190520_create_table_noticia_arquivo cannot be reverted.\n";

        return false;
    }
    */
}
