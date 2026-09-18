<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageReplyMail;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $query = Message::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $messages = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistics
        $totalMessages =
            Message::count();

        $unreadMessages =
            Message::where('status', 'unread')->count();

        $readMessages =
            Message::where('status', 'read')->count();

        $todayMessages =
            Message::whereDate(
                'created_at',
                today()
            )->count();

        return view(
            'admin.messages.index',
            compact(
                'messages',
                'totalMessages',
                'unreadMessages',
                'readMessages',
                'todayMessages'
            )
        );
    }

    public function show(Message $message)
    {
        /*
        |--------------------------------------------------------------------------
        | Opening an unread message marks it as read
        |--------------------------------------------------------------------------
        */

        if ($message->status === 'unread') {
            $message->status = 'read';
            $message->save();
        }

        return view(
            'admin.messages.show',
            compact('message')
        );
    }

    public function markAsUnread(Message $message)
    {
        $message->status = 'unread';
        $message->save();

        return redirect()
            ->route('admin.messages.index')
            ->with(
                'success',
                'Message marked as unread successfully.'
            );
    }

    public function reply(Message $message)
    {
        return view(
            'admin.messages.reply',
            compact('message')
        );
    }

    public function sendReply(Request $request, Message $message)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'reply' => ['required', 'string', 'max:10000'],
        ]);

        Mail::to($message->email)->send(
            new MessageReplyMail(
                $validated['reply'],
                $validated['subject']
            )
        );

        return redirect()
            ->route('admin.messages.show', $message)
            ->with(
                'success',
                'Reply sent successfully.'
            );
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with(
                'success',
                'Message deleted successfully.'
            );
    }
}