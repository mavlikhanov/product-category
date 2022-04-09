<?php
declare(strict_types=1);

namespace App\Service\Authorization;

use App\Api\Data\UserInterface;
use App\Http\Resources\Authorization\AuthorizationResource;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OathTokenGenerator
{
    private $request;
    private $oathClient;
    private $httpClient;

    public function __construct(
        Request $request,
        \App\Api\Data\OathClientInterface $oathClient
    ) {
        $this->request = $request;
        $this->oathClient = $oathClient;
    }

    public function tokensGenerate(AuthorizationResource $user)
    {
        $passportClient = $this->oathClient->getClient();
        $options = [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => $passportClient->id,
                'client_secret' => $passportClient->secret,
                'username'      => $user->email,
                'password'      => $this->getRequestedPassword(),
                'scope'         => '*',
            ],
        ];
        $response = $this->getResponse($options);
        return json_decode((string) $response->getBody(), true);
    }

    public function regenerateRefreshToken(): array
    {
        $passportClient = $this->oathClient->getClient();
        $options = [
            'form_params' => [
                'grant_type'    => 'refresh_token',
                'refresh_token' => $this->getRequestedRefreshToken(),
                'client_id'     => $passportClient->id,
                'client_secret' => $passportClient->secret,
                'scope'         => '*',
            ],
        ];
        $response = $this->getResponse($options);
        return json_decode((string) $response->getBody(), true);
    }

    private function getResponse(array $options, string $method = 'POST'): \Psr\Http\Message\ResponseInterface
    {
        return $this->getHttpClient()->request($method,  config('app.url') . '/oauth/token',$options);
    }

    private function getHttpClient(): Client
    {
        if (!$this->httpClient) {
            $this->httpClient = new Client();
        }
        return $this->httpClient;
    }

    private function getRequestedPassword(): string
    {
        if (!$this->request->password) {
            throw new \Exception(__(UserInterface::PASSWORD_NOT_PASSED_MESSAGE));
        }
        return $this->request->password;
    }

    private function getRequestedRefreshToken(): string
    {
        if (!$this->request->headers->get('refresh_token')) {
            throw new \Exception(__(UserInterface::REFRESH_TOKEN_NOT_PASSED_MESSAGE));
        }
        return $this->request->headers->get('refresh_token');
    }
}
