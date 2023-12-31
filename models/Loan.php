<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loan".
 *
 * @property int $id
 * @property int|null $book_id
 * @property int|null $borrower_id
 * @property string|null $borrowed_on
 * @property string|null $to_be_returned_on
 *
 * @property Book $book
 * @property Member $borrower
 */
class Loan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'borrower_id'], 'integer'],
            [['borrowed_on', 'to_be_returned_on'], 'safe'],
            [['borrower_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::class, 'targetAttribute' => ['borrower_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'borrower_id' => 'Borrower ID',
            'borrowed_on' => 'Borrowed On',
            'to_be_returned_on' => 'To Be Returned On',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[Borrower]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrower()
    {
        return $this->hasOne(Member::class, ['id' => 'borrower_id']);
    }
}
