<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerApplication;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SellerApplicationsController extends Controller
{
    /**
     * Display seller applications.
     */
    public function index(Request $request)
    {
        $query = SellerApplication::with('user');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($query) use ($search) {
                $query->where('store_name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $pendingCount = SellerApplication::where('status', 'pending')->count();
        $approvedCount = SellerApplication::where('status', 'approved')->count();
        $rejectedCount = SellerApplication::where('status', 'rejected')->count();
        $totalCount = SellerApplication::count();

        return view('admin.seller-applications.index', compact(
            'applications',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'totalCount'
        ));
    }

    /**
     * Display a seller application.
     */
    public function show(SellerApplication $application)
    {
        $application->load('user');

        return view('admin.seller-applications.show', compact('application'));
    }

    /**
     * Approve seller application.
     */
    public function approve(SellerApplication $application)
    {
        if (!$application->isPending()) {
            return back()->with(
                'error',
                'This seller application has already been reviewed.'
            );
        }

        $user = $application->user;

        if ($user->isSeller()) {
            return back()->with(
                'error',
                'This user is already a seller.'
            );
        }

        DB::transaction(function () use ($application, $user) {

            $slug = Str::slug($application->store_name);

            $originalSlug = $slug;
            $counter = 1;

            while (Store::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $user->update([
                'role' => 'seller',
            ]);

            Store::create([
                'seller_id' => $user->id,
                'name' => $application->store_name,
                'slug' => $slug,
                'description' => $application->description,
                'phone' => $application->phone,
                'address' => $application->address,
                'status' => 'active',
            ]);

            $application->update([
                'status' => 'approved',
                'reviewed_at' => now(),
                'rejection_reason' => null,
            ]);
        });

        return redirect()
            ->route('admin.seller-applications.index')
            ->with(
                'success',
                'Seller application approved successfully. The user is now a seller and their store has been created.'
            );
    }

    /**
     * Reject seller application.
     */
    public function reject(Request $request, SellerApplication $application)
    {
        if (!$application->isPending()) {
            return back()->with(
                'error',
                'This seller application has already been reviewed.'
            );
        }

        $validated = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $application->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
            'reviewed_at' => now(),
        ]);

        return redirect()
            ->route('admin.seller-applications.index')
            ->with(
                'success',
                'Seller application rejected successfully.'
            );
    }
}