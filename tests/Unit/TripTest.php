<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Trip;
use App\Models\Typeoftrip;
use Tests\MyTestCase;

class TripTest extends MyTestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    protected $trip;

    public function setUp():void
    {
        parent::setUp();
        $this->trip = $this->generateTrip();
    }

    public function test_create_trip()
    {
        $data = $this->arrangeTestData();
        $response = $this->post('/api/trip/create', $data['body'], $data['header']);
        $response->assertStatus(200);
    }

    public function test_update_trip()
    {
        $data = $this->trip;
        $update = $this->arrangeTestData(true);
        $update['id'] = $data['body']->id;
        $update['user_id'] = $data['body']->user_id;

        $response = $this->put('/api/trip/update', $update, $data['header']);
        $response->assertStatus(200);
    }

    public function test_delete_trip()
    {
        $data = $this->trip;
        $id = $data['body']->id;
        $response = $this->delete("/api/trip/delete/$id", [],$data['header']);
        $response->assertStatus(200);
    }

    protected function arrangeTestData($generator = null)
    {
        $random_number = random_int(1,5);
        $user = User::find($random_number);
        $type = Typeoftrip::find($random_number);
        $token = $user->createToken('rest-api-trip')->plainTextToken;

        $user_id = $user->id;
        $type_id = $type->id;
        $title = $this->faker->title();
        $origin = $this->faker->city();
        $destination = $this->faker->city();
        $start = $this->faker->dateTimeBetween('next Monday', 'next Monday +7 days');
        $end = $this->faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s'). "+$random_number days");

        $body["user_id"] = $user_id;
        $body["title"] = $title;
        $body["origin"] = $origin;
        $body["destination"] = $destination;
        $body["start"] = $start->format('Y-m-d H:i:s');
        $body["end"] = $end->format('Y-m-d H:i:s');
        $body["description"] = "";
        $body["type_id"] = $type_id;

        if($generator) return $body;

        $header = [
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ];

        $data = [
            'body' => $body,
            'header' => $header
        ];
        return $data;
    }

    protected function generateTrip()
    {
        $body = $this->arrangeTestData(true);
        $body = Trip::create($body);
        $user = User::find($body->user_id);
        $token = $user->createToken('rest-api-trip')->plainTextToken;
        $header = [
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ];

        $data = [
            'body' => $body,
            'header' => $header
        ];
        return $data;
    }
}
