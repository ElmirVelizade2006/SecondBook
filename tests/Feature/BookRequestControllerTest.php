<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookRequestControllerTest extends TestCase
{
    public function test_store_creates_book_request(): void
    {
        $response = $this->withSession(['admin_book_requests' => []])
            ->post(route('admin.book.requests.store'), [
                'title' => 'Atomic Habits',
                'requester' => 'Aylin',
                'category' => 'self_development',
                'budget' => '18.50',
                'note' => 'Need this book urgently',
                'status' => 'pending',
            ]);

        $response->assertRedirect(route('admin.book.requests.index'));
        $response->assertSessionHas('success', 'Book request created successfully.');
    }

    public function test_update_changes_existing_request(): void
    {
        $response = $this->withSession([
            'admin_book_requests' => [[
                'id' => 'req_1',
                'title' => 'Old title',
                'requester' => 'Tester',
                'category' => 'fiction',
                'budget' => 10,
                'note' => 'Old note',
                'status' => 'pending',
                'created_at' => '2026-07-28',
                'updated_at' => '2026-07-28',
            ]],
        ])->put(route('admin.book.requests.update', ['request' => 'req_1']), [
            'title' => 'Updated title',
            'requester' => 'Updated user',
            'category' => 'business',
            'budget' => '25.00',
            'note' => 'Updated note',
            'status' => 'approved',
        ]);

        $response->assertRedirect(route('admin.book.requests.index'));
        $response->assertSessionHas('success', 'Book request #req_1 updated successfully.');
    }
}
