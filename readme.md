# Bravo API

A Laravel package to send and retrieve data from Bravo using the Bravo rest API.

## Contents

* [About](#about)
* [Config](#config)
* [Proxy](#proxy)
* [Create Project](#create-project)
  * [User Object](#user-object)
  * [Category List](#category-list)
  * [Workflow Type](#workflow-type)
  * [Lot Type](#lot-type)
* [Update Project](#update-project)
* [Search Projects](#search-projects)
* [Get Project](#get-project)
* [Tests](#tests)
* [Development](#development)

## About

* The Laravel Http Client is used to make requests to the Bravo API
* The package has a set of typed objects that are used to construct the request objects in the correct format.
* The responses are passed through DataTransferObjects to cast the response from a json response into typed objects

## Config

You can publish the configuration if required:

`php artisan vendor:publish --provider="NetworkRailBusinessSystems\BravoApi\BravoApiServiceProvider"`

You will need to set the following in your .env file as a minimum:

```dotenv
BRAVO_API_USERNAME=
BRAVO_API_PASSWORD=
BRAVO_API_BASE_URL=
```

The base url is in the following format `https://<WEBSERVICES-URL>/esop/jint/api/public/`. For example `https://customername.com/esop/jint/api/public/`. The api package is designed to work with v1 of the Bravo API.

If you want to alter the default token cache time (10 minutes by default), then, for example, set the following to 20 minutes: 

```dotenv
BRAVO_API_TOKEN_CACHE=20
```

| Key                     | Type    | Default |
| ----------------------- | ------- | ------- |
| BRAVO_API_USERNAME      | string  | null    |
| BRAVO_API_PASSWORD      | string  | null    |
| BRAVO_API_GRANT_TYPE    | string  | client_credentials |
| BRAVO_API_BASE_URL      | string  | null    |
| BRAVO_API_TOKEN_CACHE   | integer | 10      |
| BRAVO_API_PROXY_ADDRESS | string  | null    |
| BRAVO_API_TIMEOUT       | integer | 10      |

## Proxy:
The HTTP Client requires a proxy to be able to connect with Bravo's API when the application is deployed on the servers.

This is already configured for you however, you must ensure that the `APP_ENV` property in the `.env` file is to either **staging** or **production** for it to be applied. It will not be applied when set to **local** or **testing**.

## Create Project

```php
use NetworkRailBusinessSystems\BravoApi\BravoApi;
use NetworkRailBusinessSystems\BravoApi\RequestObjects\Project;

$bravoApi = new BravoApi();

$project = new Project();
$project->tender->title = 'My Project Title';

$response = $bravoApi->createProject($project);

echo $response->returnCode; // 0
echo $response->tenderCode; // 'tender_1000111
echo $response->tenderReferenceCode; // 1000111
```

By default, the `projectOperation` is 'CREATE_FROM_TEMPLATE'. This requires that the `$project->tender->sourceTemplateCode` or the `$project->tender->sourceTemplateReferenceCode` is set. The sourceTemplateCode is the `tender_1234` style code and the sourceTemplateReferenceCode is the `project_1234` style code.

```php
$bravoApi = new BravoApi();

$project = new Project();
$project->tender->title = 'My Project Title';
$project->tender->sourceTemplateReferenceCode = 'project_1234';

$response = $bravoApi->createProject(
    project: $project, 
    fromTemplate: true
);
```

To create a new project without creating from a template, set the `fromTemplate` argument in `createProject()` to false;

```php
$bravoApi = new BravoApi();

$project = new Project();
$project->tender->title = 'My Project Title';

$response = $bravoApi->createProject(
    project: $project, 
    fromTemplate: false
);
```

### User Object

The User request object allows the Bravo username to be passed in to the `login` property, or you can use the Bravo `id` and `name` if they are known.

```php
use NetworkRailBusinessSystems\BravoApi\RequestObjects\User;
use \NetworkRailBusinessSystems\BravoApi\RequestObjects\Project;

$user = new User();

// Set the login as the user's email address
$user->login = 'example@email.com';

// Or set the Bravo id and name if known
$user->id = '1234';
$user->name = 'Joe Bloggs';

$project = new Project();
$project->tender->projectOwner = $user;
```

### Category List

The category list allows you to set the category code and the category name when creating the Project. The category code needs to match the category code exactly in Bravo.

```php
use \NetworkRailBusinessSystems\BravoApi\RequestObjects\Category;
use \NetworkRailBusinessSystems\BravoApi\RequestObjects\Project;

$category = new Category();
$category->categoryName = 'A Test Category';
$category->categoryCode = '01.01.01.99';

$project = new Project();
$project->categoryList->category[] = $category;
```

### Workflow Type

The workflow type is an instance of a Spatie Enum and has set values of `LOCKED`, `UNLOCKED` or `NONE`. 

A tender has a default workflow type of `NONE`.

### Lot Type

The lot type is an instance of a Spatie Enum and has set values of `SINGLELOTS` or `MULTILOTS`.

A tender has a default workflow type of `SINGLELOTS`.

## Update Project

To update a project, the `tenderCode` or `tenderReferenceCode` is required, otherwise a BravoApiException is thrown.

```php
use NetworkRailBusinessSystems\BravoApi\BravoApi;
use NetworkRailBusinessSystems\BravoApi\RequestObjects\Project;

$bravoApi = new BravoApi();

$project = new Project();

$project->tender->title = 'My Project Title';

$response = $bravoApi->updateProject($project);

echo $response->returnCode; // 0
echo $response->tenderCode; // 'tender_1000111
echo $response->tenderReferenceCode; // 1000111
```

## Search Projects

Pass in the search term, based on the FIQL query string. Use the [FIQL Query](https://github.com/Network-Rail-Business-Systems/fiql-query) package for a more human-readable way to construct the filter. 

The response will contain a project list, which contains a collection of projects.

```php
use NetworkRailBusinessSystems\BravoApi\BravoApi;

$bravoApi = new BravoApi();
$response = $bravoApi->searchProjects('title==test');

echo $response->projectList->project->first()->tender->title; // Test
```

You can also pass in additional filters (deFilt and comp), as well as the startAt.

## Get Project

Pass in the id for the project you wish to get.

```php
use NetworkRailBusinessSystems\BravoApi\BravoApi;

$bravoApi = new BravoApi();
$response = $bravoApi->getProject('tender_10001');

echo $response->projectList->project->first()->tender->title; // Test
```

## Tests

Run `composer install` to install dependencies and then `vendor/bin/phpunit` to run the tests.

## Development

Run `npm install` to install husky for the post commit git hooks. 

The package uses prettier to format the php code layout on git commit.

The package has Larastan installed for static analysis, which has also been added as a lint-staged task. To run it manually, run `./vendor/bin/phpstan analyse`
