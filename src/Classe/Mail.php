<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail {

  public function sendToUser($to_email, $to_name, $to_phone, $template_id, $subject, $message){
    $mj = new Client($_ENV['MAILJET_APIKEY'], $_ENV['MAILJET_SECRETKEY'],true,['version' => 'v3.1']);
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "info@parepour.be",
            'Name' => "PAREPOUR"
          ],
          'To' => [
            [
              'Email' => $to_email,
              'Name' => $to_name,
            ]
          ],
          'TemplateID' => $template_id,
          'TemplateLanguage' => true,
          'Subject' => $subject,
          'Variables' => [
            'message' => $message,
            'fullName' => $to_name,
            'email' => $to_email,
            'phone' => $to_phone
          ]
        ]
      ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success();
  }

  public function sendToPAREPOUR($to_email, $to_name, $to_phone, $template_id, $subject, $message){
    $mj = new Client($_ENV['MAILJET_APIKEY'], $_ENV['MAILJET_SECRETKEY'],true,['version' => 'v3.1']);
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "info@parepour.be",
            'Name' => $to_name
          ],
          'To' => [
            [
              'Email' => "info@parepour.be",
              'Name' => 'PAREPOUR'
            ]
          ],
          'TemplateID' => $template_id,
          'TemplateLanguage' => true,
          'Subject' => $subject,
          'Variables' => [
            'message' => $message,
            'fullName' => $to_name,
            'email' => $to_email,
            'phone' => $to_phone
          ]
        ]
      ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success();
  }
}