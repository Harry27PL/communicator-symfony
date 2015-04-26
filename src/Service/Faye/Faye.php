<?php

namespace Service\Faye;

use Entity\User;
use Repository\UserRepository;

class Faye
{
    /** @var UserRepository */
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function send(User $user, $type, $data = [])
    {
        $dataStr = json_encode([
            'id' => $user->getId(),
            'data' => [
                'type' => $type,
                'data' => $data
            ]
        ]);

        $curl = curl_init('http://localhost:8001/');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $dataStr);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dataStr))
        );
        curl_exec($curl);
    }

    public function sendToAll($type, $data = [])
    {
        foreach ($this->userRepo->getAll() as $user) {
            $this->send($user, $type, $data);
        }
    }

}
