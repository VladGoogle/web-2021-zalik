<?php

namespace Tests\Feature;

use App\Models\Person;
use Database\Factories\PersonFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class Task1Test extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    protected $modelFields = [
        "first_name",
        "last_name",
        "middle_name"
    ];

    protected $modelClass = Person::class;
    protected $modelPluralName = "persons";
    protected $modelSingleName = "person";

    private array $data;

    public function setUp(): void
    {
        parent::setUp();

        $this->data = (new PersonFactory())->definition();
    }

    /* Checks model saving */
    public function testStoreOk()
    {
        $routeName = $this->modelPluralName . ".store";
        $redirectRouteName = $this->modelPluralName . ".show";
dd(route($redirectRouteName, [$this->modelSingleName => 1]));
        $response = $this->post(route($routeName), $this->data);
        $response->assertRedirect(route($redirectRouteName, [$this->modelSingleName => 1]));
    }

    /* Checks saving validation */
    public function testStoreError()
    {
        $routeName = $this->modelPluralName . ".store";
        $response = $this->post(route($routeName), []);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors($this->modelFields);
    }

    /* Checks json model updating */
    public function testUpdateOk()
    {
        $model = $this->modelClass::factory()->create();
        $routeName = $this->modelPluralName . ".update";

        $response = $this->putJson(route($routeName, [$this->modelSingleName => $model->id]), $this->data);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data' => $this->modelFields]);
        $response->assertJsonFragment($this->data);

    }
    /* Checks json model updating validation */
    public function testUpdateError()
    {
        $model = $this->modelClass::factory()->create();
        $routeName = $this->modelPluralName . ".update";

        $response = $this->putJson(route($routeName, [$this->modelSingleName => $model->id]), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure(['message', 'errors'=>$this->modelFields]);
    }
}
