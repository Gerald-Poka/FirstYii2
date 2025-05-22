<?php

use yii\db\Migration;

/**
 * Class m230522_091500_create_junction_tables
 */
class m230522_091500_create_junction_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create job_category_assignment table
        $this->createTable('{{%job_category_assignment}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Add foreign keys
        $this->addForeignKey(
            'fk-job-category-assignment-job',
            '{{%job_category_assignment}}',
            'job_id',
            '{{%jobs}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-job-category-assignment-category',
            '{{%job_category_assignment}}',
            'category_id',
            '{{%job_categories}}',
            'id',
            'CASCADE'
        );

        // Create a unique index on job_id and category_id
        $this->createIndex(
            'idx-job-category-unique',
            '{{%job_category_assignment}}',
            ['job_id', 'category_id'],
            true
        );

        // Create job_skill_assignment table
        $this->createTable('{{%job_skill_assignment}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer()->notNull(),
            'skill_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Add foreign keys
        $this->addForeignKey(
            'fk-job-skill-assignment-job',
            '{{%job_skill_assignment}}',
            'job_id',
            '{{%jobs}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-job-skill-assignment-skill',
            '{{%job_skill_assignment}}',
            'skill_id',
            '{{%job_skills}}',
            'id',
            'CASCADE'
        );

        // Create a unique index on job_id and skill_id
        $this->createIndex(
            'idx-job-skill-unique',
            '{{%job_skill_assignment}}',
            ['job_id', 'skill_id'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop job_skill_assignment table
        $this->dropTable('{{%job_skill_assignment}}');
        
        // Drop job_category_assignment table
        $this->dropTable('{{%job_category_assignment}}');

        return true;
    }
}