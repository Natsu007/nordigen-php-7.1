<?php

namespace Nordigen\NordigenPHP\API;

use Nordigen\NordigenPHP\API\RequestHandler;

class Institution
{

    /**
     * @var \Nordigen\NordigenPHP\API\RequestHandler
     */
    private $requestHandler;

    public function __construct(RequestHandler $requestHandler) {
        $this->requestHandler = $requestHandler;
    }

    /**
     * Get list of all institutions.
     * 
     * @return array
     */
    public function getInstitutions(): array
    {
        $response = $this->requestHandler->get('institutions/');
        $json = json_decode($response->getBody()->getContents(), true);
        return $json;
    }

    /**
     * Retrieve a list of Institutions by country.
     * @param string $countryCode ISO 3166 two-character country code
     *
     * @return array
     */
    public function getInstitutionsByCountry($countryCode): array
    {
        $response = $this->requestHandler->get('institutions/', [
            'query' => [
                'country' => $countryCode
            ]
        ]);
        $json = json_decode($response->getBody()->getContents(), true);
        return $json;
    }

    /**
     * Retrieve information about a single Institution
     * @param string $institutionId
     * 
     * @return array
     */
    public function getInstitution($institutionId): array
    {
        $response = $this->requestHandler->get("institutions/{$institutionId}/");
        $json = json_decode($response->getBody()->getContents(), true);
        return $json;
    }

}
