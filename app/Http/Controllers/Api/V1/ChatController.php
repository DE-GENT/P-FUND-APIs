<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Message;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Message::with(['user:id,name,role', 'recipient:id,name,role']);

        if ($user) {
            $userId = $user->id;
            $userRole = strtolower($user->role);
            $isVetter = $userRole === 'vetter' || str_starts_with($userRole, 'vetter_');
            $isSponsor = $userRole === 'sponsor';
            $isCreator = $userRole === 'creator';

            $query->where(function($q) use ($userId, $isSponsor, $isVetter, $isCreator) {
                // Public messages (no recipient)
                $q->where(function($q2) use ($isSponsor, $isVetter, $isCreator) {
                    $q2->whereNull('recipient_id');
                    
                    if ($isSponsor) {
                        $q2->whereHas('user', function ($q3) {
                            $q3->where('role', '!=', 'vetter')
                               ->where('role', 'not like', 'vetter_%')
                               ->where('role', '!=', 'creator');
                        });
                    } elseif ($isVetter) {
                        $q2->whereHas('user', function ($q3) {
                            $q3->where('role', '!=', 'sponsor');
                        });
                    } elseif ($isCreator) {
                        $q2->whereHas('user', function ($q3) {
                            $q3->where('role', '!=', 'sponsor');
                        });
                    }
                })
                // Private messages (either sender or recipient matches current user)
                ->orWhere(function($q2) use ($userId) {
                    $q2->where('user_id', $userId)
                       ->orWhere('recipient_id', $userId);
                });
            });
        }

        $messages = $query->latest()->take(50)->get()->reverse()->values();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'recipient_id' => 'nullable|exists:users,id'
        ]);
        
        $user = $request->user();
        
        $message = Message::create([
            'user_id' => $user->id,
            'message' => $request->message,
            'recipient_id' => $request->recipient_id
        ]);

        // Send email notifications
        try {
            $senderName = $user->name;
            $senderEmail = $user->email;
            $msgText = $request->message;
            $appEmail = env('MAIL_FROM_ADDRESS', 'project.funds01@gmail.com');

            // 1. If the sender is a Creator
            if (strtolower($user->role) === 'creator') {
                if ($message->recipient_id) {
                    $recipient = \App\Models\User::find($message->recipient_id);
                    if ($recipient) {
                        $recipientEmail = $recipient->email;
                        $subject = "New P-FUNDS Chat Message from Creator: {$senderName}";
                        $html = "<p><strong>New Private P-FUNDS Chat Message from Creator:</strong></p>" .
                                "<p><strong>Sender:</strong> " . e($senderName) . " (" . e($senderEmail) . ")</p>" .
                                "<p><strong>Message:</strong></p>" .
                                "<blockquote style='border-left: 3px solid #ccc; padding-left: 10px; margin-left: 0; color: #555;'>" . nl2br(e($msgText)) . "</blockquote>" .
                                "<p>Please log in to the P-FUNDS platform to reply.</p>";
                        
                        \Illuminate\Support\Facades\Mail::to($recipientEmail)->send(
                            new \App\Mail\ChatNotificationMail($subject, $html)
                        );
                    }
                } else {
                    $subject = "New P-FUNDS Chat Message from Creator: {$senderName}";
                    $html = "<p><strong>New P-FUNDS Chat Message from Creator:</strong></p>" .
                            "<p><strong>Sender:</strong> " . e($senderName) . " (" . e($senderEmail) . ")</p>" .
                            "<p><strong>Message:</strong></p>" .
                            "<blockquote style='border-left: 3px solid #ccc; padding-left: 10px; margin-left: 0; color: #555;'>" . nl2br(e($msgText)) . "</blockquote>";

                    \Illuminate\Support\Facades\Mail::to($appEmail)->send(
                        new \App\Mail\ChatNotificationMail($subject, $html)
                    );
                }
            } 
            // 2. If the message is a private message to a Creator (sent by Admin, Vetter, or Sponsor)
            elseif ($message->recipient_id) {
                $recipient = \App\Models\User::find($message->recipient_id);
                if ($recipient && strtolower($recipient->role) === 'creator') {
                    $recipientEmail = $recipient->email;
                    $senderRoleFriendly = $user->friendly_role ?? ucfirst($user->role);
                    $subject = "New P-FUNDS Chat Message from {$senderName}";
                    $html = "<p><strong>New Private P-FUNDS Chat Message from {$senderRoleFriendly}:</strong></p>" .
                            "<p><strong>Sender:</strong> " . e($senderName) . "</p>" .
                            "<p><strong>Message:</strong></p>" .
                            "<blockquote style='border-left: 3px solid #ccc; padding-left: 10px; margin-left: 0; color: #555;'>" . nl2br(e($msgText)) . "</blockquote>" .
                            "<p>Please log in to the P-FUNDS platform to reply.</p>";

                    \Illuminate\Support\Facades\Mail::to($recipientEmail)->send(
                        new \App\Mail\ChatNotificationMail($subject, $html)
                    );
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send chat email: ' . $e->getMessage());
        }

        return response()->json($message->load(['user:id,name,role', 'recipient:id,name,role']), 201);
    }
}
