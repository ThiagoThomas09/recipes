<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Register extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Este nome de usuário já existe.'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function registerNewUser()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save()) {
            // Registra o login inicial na tabela de login
            $login = new Login();
            $login->user_id = $user->id;
            $login->login_time = date('Y-m-d H:i:s');
            $login->save();

            return true;
        }

        return false;
    }
}
