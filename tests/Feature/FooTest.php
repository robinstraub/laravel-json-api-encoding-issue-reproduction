<?php

namespace Tests\Feature;

use App\Models\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use LaravelJsonApi\Testing\MakesJsonApiRequests;
use Tests\CreatesApplication;
use Tests\TestCase;

class FooTest extends TestCase
{
    use CreatesApplication, MakesJsonApiRequests, RefreshDatabase;

    public function test_the_foos_resource_structure()
    {
        $foo = Foo::factory()->create();

        $expected = [
            'type' => 'foos',
            'id' => (string) $foo->getRouteKey(),
            'attributes' => [
                'number' => $foo->number,
                'createdAt' => $foo->created_at->jsonSerialize(),
                'updatedAt' => $foo->updated_at->jsonSerialize(),
            ],
            'links' => [
                'self' => URL::to('/api/v1/foos/' . $foo->id),
            ]
        ];

        $response = $this->jsonApi()->expects('foos')->get('/api/v1/foos/' . $foo->id);

        $response->assertFetchedOneExact($expected);
    }
}
