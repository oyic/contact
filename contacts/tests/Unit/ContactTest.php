<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contact;

class ContactTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testContactCollection()
    {
        $contact = Contact::all();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $contact);
        $this->assertIsIterable($contact);
    }

    public function testContactClass()
    {
        $contact = Contact::where('id', '=', 2)->first();
        $this->assertInstanceOf(\App\Contact::class, $contact);
        $this->assertIsObject($contact);
    }

    public function testContactUpdate()
    {
        $contact = Contact::where('id', '=', 2)->first();
        $contact->firstname = 'test';
        $saved = $contact->save();
        $this->assertTrue($saved);
    }
}
