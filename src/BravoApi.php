<?php

namespace NetworkRailBusinessSystems\BravoApi;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use NetworkRailBusinessSystems\BravoApi\DataObjects\AuthenticationData;
use NetworkRailBusinessSystems\BravoApi\DataObjects\GetProject;
use NetworkRailBusinessSystems\BravoApi\DataObjects\ProjectImport;
use NetworkRailBusinessSystems\BravoApi\DataObjects\ProjectSearchData;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Workflow;
use NetworkRailBusinessSystems\BravoApi\Exceptions\BravoApiException;
use NetworkRailBusinessSystems\BravoApi\RequestObjects\Project;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class BravoApi
{
    private PendingRequest $http;
    private string $token;
    private string $version = 'v1';

    public function __construct()
    {
        $this->http = Http::withOptions([
            'base_uri' => config('bravo-api.base_url'),
        ])
            ->timeout(config('bravo-api.timeout'))
            ->proxy(config('bravo-api.proxy_address'));

        if (Cache::has('bravo_bearer_token')) {
            $this->token = Cache::get('bravo_bearer_token');
        } else {
            $this->authenticate();
        }
    }

    /**
     * Authenticate with the Bravo API and retrieve the token
     *
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function authenticate(): bool
    {
        $response = Http::withOptions([
            'base_uri' => config('bravo-api.base_url'),
        ])
            ->proxy(config('bravo-api.proxy_address'))
            ->asForm()
            ->post("/{$this->version}/tokens", [
                'client_id' => config('bravo-api.auth.client_id'),
                'client_secret' => config('bravo-api.auth.client_secret'),
                'grant_type' => config('bravo-api.auth.grant_type'),
            ])
            ->throw(function ($response, $e) {
                Log::error($e->getMessage());
            })
            ->json();

        $authentication = new AuthenticationData($response);
        $this->token = $authentication->token;
        Cache::put(
            'bravo_bearer_token',
            $this->token,
            now()->addMinutes(config('bravo-api.token_cache_for')),
        );

        return true;
    }

    /**
     * @throws BravoApiException
     * @throws UnknownProperties
     * @throws RequestException
     */
    public function searchProjects(
        string $filter,
        string $deFlt = '',
        string $comp = '',
        int $startAt = 1,
    ): ProjectSearchData {
        $response = $this->http
            ->withToken($this->token)
            ->get("/ja/{$this->version}/projects/", [
                'flt' => $filter,
                'deFlt' => $deFlt,
                'comp' => $comp,
                'start' => $startAt,
            ])
            ->throw()
            ->json();

        $projectSearchData = new ProjectSearchData($response);

        if ($projectSearchData->returnCode !== 0) {
            throw new BravoApiException($projectSearchData->returnMessage);
        }

        return $projectSearchData;
    }

    /**
     * @throws UnknownProperties
     * @throws RequestException
     */
    public function getProject(string $id): GetProject
    {
        $response = $this->http
            ->withToken($this->token)
            ->get("/ja/{$this->version}/projects/{$id}")
            ->throw()
            ->json();

        return new GetProject($response);
    }

    /**
     * @throws UnknownProperties
     * @throws BravoApiException
     * @throws RequestException
     */
    public function postProject(string $jsonFilePath, ?string $attachmentFilePath = null): ProjectImport
    {
        $jsonStream = fopen($jsonFilePath, 'r');

        $client =  $this->http
            ->withToken($this->token)
            ->attach('data', $jsonStream);

        if (!is_null($attachmentFilePath)) {
            $attachmentStream = fopen($attachmentFilePath, 'r');
            $client->attach(basename($attachmentFilePath), $attachmentStream);
        }

        $reply = $client
            ->post("/ja/{$this->version}/projects/")
            ->throw();

        $handlerStats = $reply->handlerStats();

        $response = $reply->json();
        $response['primary_ip'] = $handlerStats['primary_ip'] ?? 'Not recorded';

        $projectImport = new ProjectImport($response);

        if ($projectImport->returnCode !== 0) {
            Log::error($projectImport->returnMessage);
            throw new BravoApiException($projectImport->returnMessage);
        }

        unlink($jsonFilePath);

        if (!is_null($attachmentFilePath)) {
            unlink($attachmentFilePath);
        }

        return $projectImport;
    }

    public function updateArchiveStatus(Project $project, string $status): void
    {
    }

    /**
     * @throws UnknownProperties
     * @throws RequestException
     */
    public function getWorkflow(string $tenderCode): Workflow
    {
        $reply = $this->http
            ->withToken($this->token)
            ->get("/ja/{$this->version}/workflows/{$tenderCode}")
            ->throw();

        $handlerStats = $reply->handlerStats();

        $response = $reply->json();
        $response['primary_ip'] = $handlerStats['primary_ip'] ?? 'Not recorded';

        return new Workflow($response);
    }
}
