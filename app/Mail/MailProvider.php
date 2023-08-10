<?php

namespace App\Mail;

use Illuminate\Support\Facades\Password;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;

class MailProvider{
    private $_password;
    private $_configuration;
    private $_transictionalEmailsApi;
    private $_sendSmtpEmail;

    public function __construct(
        Password $password, 
        Configuration $configuration, 
        TransactionalEmailsApi $transictionalEmailsApi,
        SendSmtpEmail $sendSmtpEmail)
    {
        $this->_password = $password;
        $this->_configuration = $configuration;
        $this->_transictionalEmailsApi = $transictionalEmailsApi;
        $this->_sendSmtpEmail = $sendSmtpEmail;
    }

    public function recoverPassword($user){
        $token = $this->_password::createToken($user);
        $resetLink = route('password.reset', [
            'token' => $token,
            'email' => $user['email']
        ]);
        $sendinblueApiKey = env('SENDINBLUE_API_KEY');
        $configuration = $this->_configuration->getDefaultConfiguration()->setApiKey('api-key', $sendinblueApiKey);
        $apiInstance = new $this->_transictionalEmailsApi(new \GuzzleHttp\Client(), $configuration);
        $sendSmtpEmail = new $this->_sendSmtpEmail([
            'sender' => ['name' => 'MyFitness', 'email' => 'myfitness.assistance@gmail.com'],
            'to' => [['email' => $user['email']]],
            'params' => [
                'resetLink' => $resetLink,
            ],
            'subject' => 'Recuperação de senha.',
            'templateId' => 1,
        ]);
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    }

}