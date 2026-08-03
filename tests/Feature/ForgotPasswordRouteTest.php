<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ForgotPasswordRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_forgot_password_route_is_registered(): void
    {
        $response = $this->get(route('frontend.auth.password.request'));

        $response->assertStatus(200);
    }

    public function test_password_request_page_shows_email_form_for_sending_otp(): void
    {
        $response = $this->get(route('frontend.auth.password.request'));

        $response->assertStatus(200);
        $response->assertSee('name="email"');
        $response->assertSee(route('frontend.auth.password.send.otp'));
    }

    public function test_sending_otp_redirects_to_verify_page_without_dropping_csrf_session(): void
    {
        Mail::fake();

        $this->get(route('frontend.auth.password.request'));

        $response = $this->post(route('frontend.auth.password.send.otp'), [
            'email' => 'user@example.com',
        ]);

        $response->assertRedirect(route('frontend.auth.password.verify'));
        $this->assertSessionHas('reset_email', 'user@example.com');
    }
}
