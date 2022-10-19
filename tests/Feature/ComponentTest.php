<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Component;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComponentTest extends TestCase
{
    use WithFaker;

    public function setUp() : void{
        parent::setUp();

        $this->withHeaders([
            'Accept' => 'application/json',
        ]);
    }

    /**
     * 1. La chiamata deve ritornare i componenti ordinati in ordine di posizione y
     *
     * @return void
     */
    public function test_order_by_position_y()
    {

        Component::factory(10)->create();

        $response = $this->get('/api/components');

        $response->assertStatus(200);

        $content = json_decode($response->getContent());

        //dd($content);

        $input = collect($content)->map(fn($c) => $c->options->position->y)->toArray();

        $sorted = array_values($input);

        sort($sorted);

        $this->assertTrue($input === $sorted);

    }

    /**
     * 2. Il nome (name) del componente deve essere univoco all'interno del database
     *
     * @return void
     */
    public function test_name_is_unique(){

        Component::factory()->create(['name' => 'first']);

        $response = $this->post('/api/components', [
            'name' => 'first'
        ]);

        $response->assertStatus(422);


        $response = $this->post('/api/components', [
            'parent_id' => 2,
            'name' => 'second'
        ]);

        $response->assertStatus(200);


        $response = $this->post('/api/components', [
            'parent_id' => 2,
            'name' => 'second'
        ]);

        $response->assertStatus(422);
    }

    /**
     * 3. Fare pulizia all'interno del codice
     *
     * @return void
     */
    public function test_clean_the_code(){

        $user = User::factory()->create();

        $response = $this->post('/api/components/clean-me', [
            'user_id' => $user->id,
            'components' =>
                collect([1, 2, 3, 4, 5, 6, 7])->map(function($item){
                    return [
                        'parent_id' => 1,
                        'name' => "Component_{$item}",
                        'description' => $this->faker->sentence(),
                        'options' => [
                            'size' => [
                                'width' => $this->faker->numberBetween(1, 1000),
                                'height' => $this->faker->numberBetween(1, 1000)
                            ],
                            'position' => [
                                'x' => $this->faker->numberBetween(1, 1000),
                                'y' => $item * 10
                            ],
                        ]
                    ];
                })
                ->toArray()
        ]);

        $response->assertStatus(200);

        $this->assertTrue(Component::count() == 7);

    }
}
