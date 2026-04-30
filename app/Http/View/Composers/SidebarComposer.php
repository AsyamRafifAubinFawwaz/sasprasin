<?php

namespace App\Http\View\Composers;

use App\Constants\DatabaseConst;
use App\Constants\ProgressConst;
use App\Constants\UserConst;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $pendingAspirationsCount = 0;
        $pendingToolsmanAspirationsCount = 0;

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->access_type == UserConst::ADMIN) {
                $pendingAspirationsCount = $this->getAdminPendingCount();
            } elseif ($user->access_type == UserConst::TOOLSMAN) {
                $pendingToolsmanAspirationsCount = $this->getToolsmanPendingCount($user->id);
            }
        }

        $view->with([
            'pendingAspirationsCount' => $pendingAspirationsCount,
            'pendingToolsmanAspirationsCount' => $pendingToolsmanAspirationsCount,
        ]);
    }

    /**
     * Get pending aspirations count for Admin.
     */
    private function getAdminPendingCount(): int
    {
        return DB::table(DatabaseConst::COMPLAINT)
            ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
            ->whereNull('complaints.deleted_at')
            ->where(function ($query) {
                $query->where('aspirations.status', ProgressConst::PENDING)
                    ->orWhereNull('aspirations.status');
            })
            ->count();
    }

    /**
     * Get pending aspirations count for Toolsman.
     */
    private function getToolsmanPendingCount(int $userId): int
    {
        $toolsmanId = DB::table(DatabaseConst::TOOLSMAN)
            ->where('user_id', $userId)
            ->value('id');

        if (! $toolsmanId) {
            return 0;
        }

        return DB::table(DatabaseConst::COMPLAINT_ASSIGNMENT)
            ->leftJoin(DatabaseConst::ASPIRATION, 'complaint_assignments.complaint_id', '=', 'aspirations.complaint_id')
            ->where('complaint_assignments.assigned_to', $toolsmanId)
            ->where(function ($query) {
                $query->where('aspirations.status', ProgressConst::PENDING)
                    ->orWhere('aspirations.status', ProgressConst::IN_PROGRESS)
                    ->orWhereNull('aspirations.status');
            })
            ->count();
    }
}
