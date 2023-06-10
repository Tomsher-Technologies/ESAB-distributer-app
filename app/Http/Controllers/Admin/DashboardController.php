<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\DashboardExport;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Product\DistributorProduct;
use App\Models\Product\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::all()->groupBy('region');
        $distributors = User::whereIs('distributor')->get();
        $no_distributor = $distributors->count();
        $gins = Product::all();

        $products = null;

        if ($request->search) {
            $query = DistributorProduct::latest();

            if (!in_array('all', $request->country)) {
                $cnt = $request->country;
                // $query->whereRelation('product', 'country_code', $request->country);
                $query->whereRelation('product', function ($q) use ($cnt) {
                    return $q->whereIn('country_code', $cnt);
                });
            }

            if (!in_array('all', $request->distributor)) {
                $query->whereIn('user_id', $request->distributor);
            }

            if (!in_array('all', $request->gin)) {
                // $query->whereRelation('product', 'id', $request->gin);
                $sgin = $request->gin;
                $query->whereRelation('product', function ($q) use ($sgin) {
                    return $q->whereIn('id', $sgin);
                });
            }

            if ($request->category !== 'all') {
                $query->whereRelation('product', 'category', $request->category);
            }

            if ($request->overstock !== 'all') {
                $query->where('overstocked', $request->overstock);
            }

            if ($request->from_date !== null) {
                $request->to_date = $request->to_date ?? $request->from_date;
                $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            if ($request->to_date !== null) {
                $request->from_date = $request->from_date ?? $request->to_date;
                $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            $products = $query->get();

            $data['stock_on_hand'] = number_format($products->sum('stock_on_hand'), 0);
            $data['goods_in_transit'] = number_format($products->sum('goods_in_transit'), 0);
            $data['stock_on_order'] = number_format($products->sum('stock_on_order'), 0);
            $data['no_distributor'] = number_format($products->unique('user_id')->count(), 0);
        } else {
            $query = DistributorProduct::select(DB::raw("SUM(stock_on_hand) as stock_on_hand"), DB::raw("SUM(goods_in_transit) as goods_in_transit"), DB::raw("SUM(stock_on_order) as stock_on_order"), DB::raw("COUNT(DISTINCT(`user_id`)) as no_distributor"))->get()->first();

            $data['stock_on_hand'] = number_format($query->stock_on_hand, 0);
            $data['goods_in_transit'] = number_format($query->goods_in_transit, 0);
            $data['stock_on_order'] = number_format($query->stock_on_order, 0);
            $data['no_distributor'] = number_format($query->no_distributor, 0);
        }



        return view('admin.dashboard')
            ->with([
                'distributors' => $distributors,
                'countries' => $countries,
                'gins' => $gins,
                'old_request' => $request,
                'products' => $products,
                'data' => $data,
            ]);
    }

    public function download(Request $request)
    {

        // dd($request);

        $d_country = explode(',', $request->d_country);
        $d_distributor = explode(',', $request->d_distributor);
        $d_gin = explode(',', $request->d_gin);

        $query = DistributorProduct::latest();

        if (!in_array('all', $d_country)) {
            $query->whereRelation('product', function ($q) use ($d_country) {
                return $q->whereIn('country_code', $d_country);
            });
            // $query->whereRelation('product', 'country_code', $request->d_country);
        }

        if (!in_array('all', $d_distributor)) {
            $query->whereIn('user_id', $d_distributor);
        }


        if (!in_array('all', $d_gin)) {
            // $query->whereRelation('product', 'id', $request->d_gin);
            $query->whereRelation('product', function ($q) use ($d_gin) {
                return $q->whereIn('id', $d_gin);
            });
        }

        if ($request->d_category !== 'all') {
            $query->whereRelation('product', 'category', $request->d_category);
        }

        if ($request->d_overstock !== 'all') {
            $query->where('overstocked', $request->d_overstock);
        }

        if ($request->d_from_date !== null) {
            $request->d_to_date = $request->d_to_date ?? $request->d_from_date;
            $query->whereBetween('created_at', [$request->d_from_date, $request->d_to_date]);
        }

        if ($request->d_to_date !== null) {
            $request->d_from_date = $request->d_from_date ?? $request->d_to_date;
            $query->whereBetween('created_at', [$request->d_from_date, $request->d_to_date]);
        }

        $products = $query->with(['distributor', 'product', 'product.country'])->get();

        $file_name = 'search-result-' . Carbon::now()->format('d-m-y') . '.xlsx';

        return Excel::download(new DashboardExport($products), $file_name);
    }

    public function settingsView()
    {
        return view('admin.settings');
    }

    public function settings(Request $request)
    {
        // return view('admin.settings');
    }
}
