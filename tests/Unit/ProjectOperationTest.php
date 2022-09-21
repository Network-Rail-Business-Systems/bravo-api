<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Unit;

use NetworkRailBusinessSystems\BravoApi\Enums\OperationCode;
use NetworkRailBusinessSystems\BravoApi\RequestObjects\Category;
use NetworkRailBusinessSystems\BravoApi\RequestObjects\Project;
use NetworkRailBusinessSystems\BravoApi\RequestObjects\ProjectOperation;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;

class ProjectOperationTest extends TestCase
{
    /** @test */
    public function build_project_operation()
    {
        $projectOperation = new ProjectOperation();

        $projectOperation->operationCode = OperationCode::from('CREATE');
        $projectOperation->project = new Project();
        $projectOperation->project->tender->code = null;
        $projectOperation->project->tender->tenderCode = 'tender_999999';
        $projectOperation->project->tender->title = 'My Project Title';

        $this->assertEquals('CREATE', $projectOperation->operationCode);
        $this->assertNull($projectOperation->project->tender->code);
        $this->assertEquals('tender_999999', $projectOperation->project->tender->tenderCode);
        $this->assertEquals('My Project Title', $projectOperation->project->tender->title);
    }

    /** @test */
    public function build_project_with_category()
    {
        $projectOperation = new ProjectOperation();

        $projectOperation->operationCode = OperationCode::from('CREATE');
        $projectOperation->project = new Project();
        $projectOperation->project->tender->tenderCode = 'tender_999999';
        $projectOperation->project->tender->title = 'My Project Title';

        $category = new Category();
        $category->categoryName = 'Test Category';
        $category->categoryCode = '01.02.03.04';

        $projectOperation->project->categoryList->category[] = $category;

        $projectOperationArray = $projectOperation->toArray();

        $this->assertEquals(
            'Test Category',
            $projectOperationArray['project']['categoryList']['category'][0]['categoryName'],
        );
        $this->assertEquals(
            '01.02.03.04',
            $projectOperationArray['project']['categoryList']['category'][0]['categoryCode'],
        );
    }
}
