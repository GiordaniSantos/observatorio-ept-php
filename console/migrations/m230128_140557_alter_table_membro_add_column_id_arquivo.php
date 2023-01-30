<?php

use yii\db\Migration;

/**
 * Class m230128_140557_alter_table_membro_add_column_id_arquivo
 */
class m230128_140557_alter_table_membro_add_column_id_arquivo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn( 'membro', 'member_id', 'id');
        $this->addColumn( 'membro', 'id_arquivo', $this->integer());

         // creates index for column `id_arquivo`
         $this->createIndex(
            'membro_id_arquivo_idx',
            'membro',
            'id_arquivo'
        );
    
        // add foreign key for table `arquivo`
        $this->addForeignKey(
            'membro_id_arquivo_fk',
            'membro',
            'id_arquivo',
            'arquivo',
            'id',
            'SET NULL',
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
        $this->dropColumn( 'membro', 'id_arquivo');

         // drops foreign key for table `membro`
         $this->dropForeignKey(
            'membro_id_arquivo_fk',
            'membro'
        );
    
        // drops index for column `id_arquivo`
        $this->dropIndex(
            'membro_id_arquivo_idx',
            'membro'
        );

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
        echo "m230128_140557_alter_table_membro_add_column_id_arquivo cannot be reverted.\n";

        return false;
    }
    */
}
