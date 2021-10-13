<?php

namespace App\Observers;

use App\ScopeOfWork;
use App\Notifications\NewEstimate;
use App\UniversalSearch;

class ScopeOfWorkObserver
{

    public function creating(ScopeOfWork $scopeOfWork)
    {
        if (request()->type && (request()->type == "save" || request()->type == "draft")) {
            $scopeOfWork->send_status = 0;
        }

        if (request()->type == "draft") {
            $scopeOfWork->status = 'draft';
        }
    }

    public function created(ScopeOfWork $scopeOfWork)
    {
        if (!isRunningInConsoleOrSeeding()) {
            if ($scopeOfWork->client) {
                if (request()->type != "save" && request()->type != "draft") {
//                    $scopeOfWork->client->notify(new NewEstimate($scopeOfWork));
                }
            }
        }
    }

    public function saving(ScopeOfWork $scopeOfWork)
    {
        // Cannot put in creating, because saving is fired before creating. And we need company id for check bellow
        if (company()) {
            $scopeOfWork->company_id = company()->id;
        }
    }

    public function deleting(ScopeOfWork $scopeOfWork)
    {
        $universalSearches = UniversalSearch::where('searchable_id', $scopeOfWork->id)->where('module_type', 'estimate')->get();
        if ($universalSearches) {
            foreach ($universalSearches as $universalSearch) {
                UniversalSearch::destroy($universalSearch->id);
            }
        }
    }
}
