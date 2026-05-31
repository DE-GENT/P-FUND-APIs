<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use App\Mail\ChatNotificationMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ChatApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_chat_message_creation_and_visibility()
    {
        Mail::fake();

        // Create Users with different roles
        $creator = User::factory()->create(['role' => 'creator', 'email' => 'creator@example.com']);
        $sponsor = User::factory()->create(['role' => 'sponsor', 'email' => 'sponsor@example.com']);
        $vetter = User::factory()->create(['role' => 'vetter', 'email' => 'vetter@example.com']);
        $admin = User::factory()->create(['role' => 'admin', 'email' => 'admin@example.com']);

        // 1. Creator sends a public message
        $response = $this->actingAs($creator)
            ->postJson('/api/v1/chat', ['message' => 'Hello from Creator']);
        $response->assertStatus(201);

        Mail::assertSent(ChatNotificationMail::class, function (ChatNotificationMail $mail) {
            return $mail->hasTo(env('MAIL_FROM_ADDRESS', 'project.funds01@gmail.com'))
                && str_contains($mail->subjectStr, 'New P-FUNDS Chat Message from Creator');
        });

        // 2. Creator sends a private message to Sponsor
        Mail::fake(); // reset mail fake assertions
        $response = $this->actingAs($creator)
            ->postJson('/api/v1/chat', [
                'message' => 'Private message to Sponsor',
                'recipient_id' => $sponsor->id
            ]);
        $response->assertStatus(201);

        Mail::assertSent(ChatNotificationMail::class, function (ChatNotificationMail $mail) use ($sponsor) {
            return $mail->hasTo($sponsor->email)
                && str_contains($mail->subjectStr, 'New P-FUNDS Chat Message from Creator');
        });

        // 3. Sponsor sends a private message to Creator
        Mail::fake();
        $response = $this->actingAs($sponsor)
            ->postJson('/api/v1/chat', [
                'message' => 'Reply to Creator',
                'recipient_id' => $creator->id
            ]);
        $response->assertStatus(201);

        Mail::assertSent(ChatNotificationMail::class, function (ChatNotificationMail $mail) use ($creator) {
            return $mail->hasTo($creator->email)
                && str_contains($mail->subjectStr, 'New P-FUNDS Chat Message from');
        });

        // 4. Sponsor sends a public message
        Mail::fake();
        $response = $this->actingAs($sponsor)
            ->postJson('/api/v1/chat', ['message' => 'Public sponsor message']);
        $response->assertStatus(201);
        Mail::assertNothingSent(); // non-creator public messages shouldn't send emails

        // 5. Test visibility logic on Index
        // Create an explicit set of messages to test filtering
        Message::truncate(); // clean up messages to be precise

        // Message 1: Creator public
        Message::create(['user_id' => $creator->id, 'message' => 'Creator Public']);
        // Message 2: Sponsor public
        Message::create(['user_id' => $sponsor->id, 'message' => 'Sponsor Public']);
        // Message 3: Vetter public
        Message::create(['user_id' => $vetter->id, 'message' => 'Vetter Public']);
        // Message 4: Private message between Creator and Sponsor
        Message::create(['user_id' => $creator->id, 'recipient_id' => $sponsor->id, 'message' => 'Creator-Sponsor Private']);
        // Message 5: Private message between Vetter and Admin
        Message::create(['user_id' => $vetter->id, 'recipient_id' => $admin->id, 'message' => 'Vetter-Admin Private']);

        // Check Creator Index visibility:
        // Creator should see public messages from Creator and Vetter, but NOT Sponsor
        // Creator should see their private messages (Creator-Sponsor Private)
        // Creator should NOT see other private messages (Vetter-Admin Private)
        $response = $this->actingAs($creator)->getJson('/api/v1/chat');
        $response->assertStatus(200);
        $messages = collect($response->json());
        $this->assertTrue($messages->contains('message', 'Creator Public'));
        $this->assertFalse($messages->contains('message', 'Sponsor Public')); // Sponsor public hidden for Creator
        $this->assertTrue($messages->contains('message', 'Vetter Public'));
        $this->assertTrue($messages->contains('message', 'Creator-Sponsor Private'));
        $this->assertFalse($messages->contains('message', 'Vetter-Admin Private'));

        // Check Sponsor Index visibility:
        // Sponsor should see public messages EXCEPT from Vetters and Creators
        // Sponsor should see their private messages (Creator-Sponsor Private)
        $response = $this->actingAs($sponsor)->getJson('/api/v1/chat');
        $response->assertStatus(200);
        $messages = collect($response->json());
        $this->assertFalse($messages->contains('message', 'Creator Public')); // Creator public hidden for Sponsor
        $this->assertTrue($messages->contains('message', 'Sponsor Public'));
        $this->assertFalse($messages->contains('message', 'Vetter Public')); // Vetter public hidden for Sponsor
        $this->assertTrue($messages->contains('message', 'Creator-Sponsor Private'));
        $this->assertFalse($messages->contains('message', 'Vetter-Admin Private'));

        // Check Vetter Index visibility:
        // Vetter should see public messages EXCEPT from Sponsors
        // Vetter should NOT see Creator-Sponsor Private
        $response = $this->actingAs($vetter)->getJson('/api/v1/chat');
        $response->assertStatus(200);
        $messages = collect($response->json());
        $this->assertTrue($messages->contains('message', 'Creator Public'));
        $this->assertFalse($messages->contains('message', 'Sponsor Public')); // Sponsor public hidden
        $this->assertTrue($messages->contains('message', 'Vetter Public'));
        $this->assertFalse($messages->contains('message', 'Creator-Sponsor Private'));
    }
}
