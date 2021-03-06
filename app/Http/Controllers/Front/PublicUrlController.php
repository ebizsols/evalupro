<?php

namespace App\Http\Controllers\Front;

use App\AcceptEstimate;
use App\AcceptScope;
use App\Company;
use App\Contract;
use App\ContractSign;
use App\Estimate;
use App\EstimateItem;
use App\Helper\Files;
use App\Helper\Reply;
use App\Http\Controllers\Front\FrontBaseController;
use App\Http\Requests\Admin\Contract\SignRequest;
use App\Http\Requests\EstimateAcceptRequest;
use App\Invoice;
use App\InvoiceItems;
use App\Notifications\ContractSigned;
use App\Notifications\NewInvoice;
use App\Notifications\NewNotice;
use App\Product;
use App\Project;
use App\ProjectMilestone;
use App\ScopeOfWork;
use App\Scopes\CompanyScope;
use App\Setting;
use App\UniversalSearch;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Modules\Valuation\Entities\ValuationBlock;
use Modules\Valuation\Entities\ValuationCity;
use Modules\Valuation\Entities\ValuationGeneralSetting;
use Modules\Valuation\Entities\ValuationGovernorate;
use Modules\Valuation\Entities\ValuationIntendedUser;
use Modules\Valuation\Entities\ValuationProperty;
use Modules\Valuation\Entities\ValuationPropertyClassification;
use Modules\Valuation\Entities\ValuationPropertyMedia;
use Modules\Valuation\Entities\ValuationPropertyType;
use Modules\Valuation\Entities\ValuationPropertyXref;
use Modules\Valuation\Entities\ValuationSowRule;

class PublicUrlController extends FrontBaseController
{
    public function estimateView(Request $request, $id)
    {
        $pageTitle = __('app.menu.estimates');
        $pageIcon = 'icon-people';
        $estimate = Estimate::whereRaw('md5(id) = ?', $id)->firstOrFail();
        $company = Company::find($estimate->company_id);
        App::setLocale(isset($company->locale) ? $company->locale : 'en');

        // public url company session set.
        session(['company' => $company]);
        if ($estimate->discount > 0) {
            if ($estimate->discount_type == 'percent') {
                $discount = (($estimate->discount / 100) * $estimate->sub_total);
            } else {
                $discount = $estimate->discount;
            }
        } else {
            $discount = 0;
        }

        $taxList = array();

        $items = EstimateItem::whereNotNull('taxes')
            ->where('estimate_id', $estimate->id)
            ->get();

        foreach ($items as $item) {
            if ($estimate->discount > 0 && $estimate->discount_type == 'percent') {
                $item->amount = $item->amount - (($estimate->discount / 100) * $item->amount);
            }
            foreach (json_decode($item->taxes) as $tax) {
                $this->tax = EstimateItem::taxbyid($tax)->first();
                if (!isset($taxList[$this->tax->tax_name . ': ' . $this->tax->rate_percent . '%'])) {
                    $taxList[$this->tax->tax_name . ': ' . $this->tax->rate_percent . '%'] = ($this->tax->rate_percent / 100) * $item->amount;
                } else {
                    $taxList[$this->tax->tax_name . ': ' . $this->tax->rate_percent . '%'] = $taxList[$this->tax->tax_name . ': ' . $this->tax->rate_percent . '%'] + (($this->tax->rate_percent / 100) * $item->amount);
                }
            }
        }

        $taxes = $taxList;

        $settings = $company;
        return view('estimate', [
            'estimate' => $estimate,
            'taxes' => $taxes,
            'settings' => $settings,
            'discount' => $discount,
            'setting' => $settings,
            'global' => $this->global,
            'companyName' => $settings->company_name,
            'pageTitle' => $pageTitle,
            'pageIcon' => $pageIcon,
            'company' => $company,
        ]);
    }

    private function scopeOfWorkGetData($estimate)
    {
        $project = Project::find($estimate->project_id);
        $property = ValuationProperty::find($project->property_id);
        $product = Product::find($project->product_id);
        $propertyType = ValuationPropertyType::find($property->type_id);
        $propertyClassification = ValuationPropertyClassification::find($property->classification_id);
        $propertyAddBlock = ValuationBlock::find($property->block_id);
        $propertyAddCity = ValuationCity::find($property->city_id);
        $propertyAddGovern = ValuationGovernorate::find($property->governorate_id);

        foreach ($project->members as $employeesIn) {
            $roles = !empty($employeesIn->user->roles) ? $employeesIn->user->roles : array();
            foreach ($roles as $role) {
                $roleName = $role->name ?? '';
                if ($roleName == 'Valuator') {
                    $isValuator = $employeesIn->user;
                    break;
                }
            }
        }
        $address =' Plot No : ' . ($property->plot_num ?? '') . '<br/> Block No : ' . ($propertyAddBlock->name ?? '') . '<br/> City : ' . ($propertyAddCity->name ?? '') . '<br/> Governate : ' . ($propertyAddGovern->name ?? '');
        $IntendedUser = $project->getMeta('intendedUsers', null, 'array');
        $valuationDate = $project->getMeta('appointment_day', null, 'string');
        $valuationDate = strtotime($valuationDate);
        $valuationDate = date('Y-m-d', $valuationDate);

        $userNames = '';
        if($IntendedUser != null){
            $user = ValuationIntendedUser::whereIn('id', $IntendedUser)->pluck('title');
            $userNames = implode(', ', $user->toArray());
        }
        $conditionRules = array();
        $conditionRules = json_decode($estimate->meta);
        $conditionRulesData = array();
        if ($conditionRules) {

            foreach ($conditionRules as $key => $rule) {
                $array = ValuationSowRule::whereIn('id', $rule)->get();

                $conditionRulesData[$key] = $array;
            }
        }

        //$valuationInfoTitle = ValuationGeneralSetting::where('meta_key', 'valuationInfoTitle')->pluck('meta_value')[0];
        $valuationInfoTitle = ValuationGeneralSetting::where('meta_key', 'valuationInfoTitle')->pluck('meta_value');
        $valuationInfoTitle = $valuationInfoTitle[0] ?? '';
        $serviceInfoTitle = ValuationGeneralSetting::where('meta_key', 'serviceInfoTitle')->pluck('meta_value');
        $serviceInfoTitle = $serviceInfoTitle[0] ?? '';
        $propertyInfoTitle = ValuationGeneralSetting::where('meta_key', 'propertyInfoTitle')->pluck('meta_value');
        $propertyInfoTitle = $propertyInfoTitle[0] ?? '';
        $valuationGeneralSetting = new ValuationGeneralSetting();

        $data = [
            'titles'=>[
                'info' => ($valuationInfoTitle != '') ? $valuationInfoTitle :$valuationGeneralSetting->data['valuationInfoTitle'],
                'property' => ($propertyInfoTitle != '') ? $propertyInfoTitle : $valuationGeneralSetting->data['propertyInfoTitle'],
                'service' => ($serviceInfoTitle != '') ? $serviceInfoTitle : $valuationGeneralSetting->data['serviceInfoTitle'],
            ],
            'info' => [
                'Valuator' => $isValuator->name ?? '',
                'Client' => $project->client->name ?? '',
                'Intended User' => $userNames ?? '',
                'Currency' => $project->currency->currency_name ?? '',
                'Purpose Of Valuation' => $product->subCategory->category_name ?? '',
                'Basis Of Valuation' => $product->category->category_name ?? '',
                'Survey Appointment Date' => $valuationDate ?? '',
            ],
            'property' => [
                'Type' => $propertyType->title ?? '',
                'Classification' => $propertyClassification->title ?? '',
                'Address' => $address,
            ],
            'product' => [
                'Title' => $product->name ?? '',
                'Category' => $product->category->category_name ?? '',
                'Sub Category' => $product->subCategory->category_name ?? '',
                'Price' => $product->price ?? '',
            ],
            'conditionRules' => $conditionRulesData
        ];

        return $data;
    }

    public function scopeOfWorkView(Request $request, $id)
    {
        $pageTitle = __('app.menu.scopeOfWork');
        $pageIcon = 'icon-people';
        $estimate = ScopeOfWork::whereRaw('md5(id) = ?', $id)->firstOrFail();
        $company = Company::find($estimate->company_id);
        App::setLocale(isset($company->locale) ? $company->locale : 'en');
        // public url company session set.
        session(['company' => $company]);

        $data = $this->scopeOfWorkGetData($estimate);

        $settings = $company;

        return view('scopeOfWork', [
            'allData' => $data,
            'estimate' => $estimate,
            'settings' => $settings,
            'setting' => $settings,
            'global' => $this->global,
            'companyName' => $settings->company_name,
            'pageTitle' => $pageTitle,
            'pageIcon' => $pageIcon,
            'company' => $company,
        ]);
    }

    public function decline(Request $request, $id)
    {
        $estimate = Estimate::find($id);
        $estimate->status = 'declined';
        $estimate->save();

        return Reply::dataOnly(['status' => 'success']);
    }

    public function scopeOfWorkDecline(Request $request, $id)
    {
        $estimate = ScopeOfWork::find($id);
        $estimate->status = 'declined';
        $estimate->save();

        return Reply::dataOnly(['status' => 'success']);
    }

    public function acceptModal(Request $request, $id)
    {
        $estimate = Estimate::findOrFail($id);
        $company = Company::find($estimate->company_id);
        App::setLocale(isset($company->locale) ? $company->locale : 'en');
        return view('accept-estimate', ['id' => $id]);
    }

    public function acceptModalScopeOfWork(Request $request, $id)
    {
        $estimate = ScopeOfWork::findOrFail($id);
        $company = Company::find($estimate->company_id);
        App::setLocale(isset($company->locale) ? $company->locale : 'en');
        return view('accept-estimate', ['id' => $id]);
    }

    public function accept(EstimateAcceptRequest $request, $id)
    {
        DB::beginTransaction();

        $estimate = Estimate::whereRaw('md5(id) = ?', $id)->firstOrFail();
        //        dd($estimate);

        if (!$estimate) {
            return Reply::error('you are not authorized to access this.');
        }

        $accept = new AcceptEstimate();
        $accept->full_name = $request->first_name . ' ' . $request->last_name;
        $accept->estimate_id = $estimate->id;
        $accept->email = $request->email;

        $image = $request->signature;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(32) . '.' . 'jpg';

        if (!\File::exists(public_path('user-uploads/' . 'estimate/accept'))) {
            $result = \File::makeDirectory(public_path('user-uploads/estimate/accept'), 0775, true);
        }

        \File::put(public_path() . '/user-uploads/estimate/accept/' . $imageName, base64_decode($image));

        $accept->signature = $imageName;
        $accept->save();

        $estimate->status = 'accepted';
        $estimate->save();

        $invoice = new Invoice();

        $invoice->invoice_number = Invoice::count() + 1;
        $invoice->company_id = $estimate->company_id;
        $invoice->client_id = $estimate->client_id;
        $invoice->issue_date = Carbon::now()->format('Y-m-d');
        $invoice->due_date = Carbon::now()->addDays(7)->format('Y-m-d');
        $invoice->sub_total = round($estimate->sub_total, 2);
        $invoice->discount = round($estimate->discount, 2);
        $invoice->discount_type = $estimate->discount_type;
        $invoice->total = round($estimate->total, 2);
        $invoice->currency_id = $estimate->currency_id;
        $invoice->note = $estimate->note;
        $invoice->status = 'unpaid';
        $invoice->estimate_id = $estimate->id;
        $invoice->save();

        foreach ($estimate->items as $key => $item) :
            if (!is_null($item)) {
                InvoiceItems::create(
                    [
                        'invoice_id' => $invoice->id,
                        'item_name' => $item->item_name,
                        'item_summary' => $item->item_summary ? $item->item_summary : '',
                        'type' => 'item',
                        'quantity' => $item->quantity,
                        'unit_price' => round($item->unit_price, 2),
                        'amount' => round($item->amount, 2),
                        'taxes' => $item->taxes
                    ]
                );
            }
        endforeach;

        //log search
        $this->logSearchEntry($invoice->id, 'Invoice ' . $invoice->invoice_number, 'admin.all-invoices.show', 'invoice');

        DB::commit();
        return Reply::redirect(route('front.invoice', md5($invoice->id)), 'Estimate successfully accepted.');
    }

    public function acceptScopeOfWork(EstimateAcceptRequest $request, $id)
    {
        DB::beginTransaction();

        $estimate = ScopeOfWork::whereRaw('md5(id) = ?', $id)->firstOrFail();
        //        dd($estimate);

        if (!$estimate) {
            return Reply::error('you are not authorized to access this.');
        }
        $project_id = $estimate->project_id;
        $accept = new AcceptScope();
        $accept->full_name = $request->first_name . ' ' . $request->last_name;
        $accept->estimate_id = $estimate->id;
        $accept->email = $request->email;

        $image = $request->signature;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(32) . '.' . 'jpg';

        if (!\File::exists(public_path('user-uploads/' . 'scope/accept'))) {
            $result = \File::makeDirectory(public_path('user-uploads/scope/accept'), 0775, true);
        }

        \File::put(public_path() . '/user-uploads/scope/accept/' . $imageName, base64_decode($image));

        $accept->signature = $imageName;
        $accept->save();

        $estimate->status = 'accepted';
        $estimate->save();

        //log search
        DB::commit();
        return Reply::redirect(route('admin.milestones.show', $project_id), 'Scope successfully accepted.');
    }

    public function logSearchEntry($searchableId, $title, $route, $type)
    {
        $search = new UniversalSearch();
        $search->searchable_id = $searchableId;
        $search->title = $title;
        $search->route_name = $route;
        $search->module_type = $type;
        $search->save();
    }

    /* Contract */
    public function contractView(Request $request, $id)
    {
        $pageTitle = __('app.menu.contracts');
        $pageIcon = 'fa fa-file';
        $contract = Contract::whereRaw('md5(id) = ?', $id)
            ->with('client', 'contract_type', 'signature', 'discussion', 'discussion.user')->withoutGlobalScope(CompanyScope::class)
            ->firstOrFail();
        $company = Company::find($contract->company_id);
        return view('contract', ['contract' => $contract, 'global' => $company, 'pageTitle' => $pageTitle, 'pageIcon' => $pageIcon]);
    }

    public function contractDownload($id)
    {
        $contract = Contract::findOrFail($id);
        $global = cache()->remember(
            'global-setting', 60 * 60 * 24, function () {
            return \App\Setting::with('currency')->first();
        }
        );
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.contracts.contract-pdf', ['contract' => $contract, 'global' => $global]);
        $filename = 'contract-' . $contract->id;

        return $pdf->download($filename . '.pdf');
    }

    public function contractDownloadView($id)
    {
        $contract = Contract::findOrFail($id);
        $pdf = app('dompdf.wrapper');
        $global = cache()->remember(
            'global-setting', 60 * 60 * 24, function () {
            return \App\Setting::with('currency')->first();
        }
        );
        $pdf->loadView('admin.contracts.contract-pdf', ['contract' => $contract, 'global' => $global]);

        $filename = 'contract-' . $this->contract->id;

        return [
            'pdf' => $pdf,
            'fileName' => $filename
        ];
    }

    public function contractSignModal($id)
    {
        $this->contract = Contract::find($id);
        return view('contracts-accept', $this->data);
    }

    public function contractSign(SignRequest $request, $id)
    {
        $this->contract = Contract::whereRaw('md5(id) = ?', $id)->firstOrFail();

        if (!$this->contract) {
            return Reply::error('you are not authorized to access this.');
        }

        $sign = new ContractSign();
        $sign->full_name = $request->first_name . ' ' . $request->last_name;
        $sign->contract_id = $this->contract->id;
        $sign->email = $request->email;

        $image = $request->signature;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(32) . '.' . 'jpg';

        if (!\File::exists(public_path('user-uploads/' . 'contract/sign'))) {
            $result = \File::makeDirectory(public_path('user-uploads/contract/sign'), 0775, true);
        }

        \File::put(public_path() . '/user-uploads/contract/sign/' . $imageName, base64_decode($image));

        $sign->signature = $imageName;
        $sign->save();

        $allAdmins = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at')
            ->where('roles.name', 'admin')
            ->where('users.company_id', $this->contract->company_id)
            ->get();

        Notification::send($allAdmins, new ContractSigned($this->contract, $sign));

        return Reply::redirect(route('front.contract.show', md5($this->contract->id)));
    }

    public function estimateDomPdfObjectForDownload($id)
    {
        $estimate = Estimate::whereRaw('md5(id) = ?', $id)->firstOrFail();
        $company = Company::find($estimate->company_id);

        if ($estimate->discount > 0) {
            if ($estimate->discount_type == 'percent') {
                $discount = (($estimate->discount / 100) * $estimate->sub_total);
            } else {
                $discount = $estimate->discount;
            }
        } else {
            $discount = 0;
        }

        $taxList = array();

        $items = EstimateItem::whereNotNull('taxes')
            ->where('estimate_id', $estimate->id)
            ->get();

        foreach ($items as $item) {
            if ($estimate->discount > 0 && $estimate->discount_type == 'percent') {
                $item->amount = $item->amount - (($estimate->discount / 100) * $item->amount);
            }
            foreach (json_decode($item->taxes) as $tax) {
                $tax = EstimateItem::taxbyid($tax)->first();
                if ($tax) {
                    if (!isset($taxList[$tax->tax_name . ': ' . $tax->rate_percent . '%'])) {
                        $taxList[$tax->tax_name . ': ' . $tax->rate_percent . '%'] = ($tax->rate_percent / 100) * $item->amount;
                    } else {
                        $taxList[$tax->tax_name . ': ' . $tax->rate_percent . '%'] = $taxList[$tax->tax_name . ': ' . $tax->rate_percent . '%'] + (($tax->rate_percent / 100) * $item->amount);
                    }
                }
            }
        }

        $taxes = $taxList;

        //        return $this->invoice->project->client->client[0]->address;
        $settings = $company;

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.estimates.estimate-pdf', [
            'estimate' => $estimate,
            'taxes' => $taxes,
            'settings' => $settings,
            'discount' => $discount,
            'company' => $settings,
            'global' => $settings,
            'companyName' => $settings->company_name
        ]);
        $filename = 'estimate-' . $estimate->id;


        return [
            'pdf' => $pdf,
            'fileName' => $filename
        ];
    }

    public function scopeOfWorkDomPdfObjectForDownload($id)
    {
        $estimate = ScopeOfWork::whereRaw('md5(id) = ?', $id)->firstOrFail();
        $company = Company::find($estimate->company_id);
        $settings = $company;
        $data = $this->scopeOfWorkGetData($estimate);

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.scopeOfWork.scopeOfWork-pdf', [
            'allData' => $data,
            'estimate' => $estimate,
            'settings' => $settings,
            'company' => $settings,
            'global' => $settings,
            'companyName' => $settings->company_name
        ]);
        $filename = 'scope-' . $estimate->id;

        return [
            'pdf' => $pdf,
            'fileName' => $filename
        ];
    }

    public function estimateDownload($id)
    {
        $pdfOption = $this->estimateDomPdfObjectForDownload($id);
        $pdf = $pdfOption['pdf'];
        $filename = $pdfOption['fileName'];

        return $pdf->download($filename . '.pdf');
    }

    public function scopeOfWorkDownload($id)
    {
        $pdfOption = $this->scopeOfWorkDomPdfObjectForDownload($id);
        $pdf = $pdfOption['pdf'];
        $filename = $pdfOption['fileName'];
        return $pdf->download($filename . '.pdf');
    }
}
