<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Client;
use App\Models\Design;
use App\Models\Legality;
use App\Models\Statistic;
use App\Models\Professional;
use Exception;
use Nette\Utils\Json;
use App\Models\Service;
use App\Models\MasterHead;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class PublicController extends Controller
{
    public function index()
    {
        return view('pages.fe.index');
    }

    public function portfolio()
    {
        return view('pages.fe.portofolio.index');
    }

    public function design()
    {
        return view('pages.fe.design.index');
    }

    public function legality()
    {
        return view('pages.fe.legality.index');
    }

    public function board()
    {
        $professionals = Professional::where('category', 'board_of_director')
            ->orderBy('order')
            ->get();
        
        $locale = app()->getLocale();
        
        return view('pages.fe.professionals.board', compact('professionals', 'locale'));
    }

    public function management()
    {
        $professionals = Professional::where('category', 'management')
            ->orderBy('order')
            ->get();
        
        $locale = app()->getLocale();
        
        return view('pages.fe.professionals.management', compact('professionals', 'locale'));
    }
    public function switchLanguage($locale)
    {
        if (in_array($locale, ['en', 'id'])) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }

    public function getdata():JsonResponse
    {
        $locale = app()->getLocale();
        $isIndonesian = $locale === 'id';
        
        // Return all masterhead records (ordered newest first) so frontend can use them for a slider
        $masterhead = MasterHead::latest()->get()->map(function($item) use ($isIndonesian) {
            return [
                'title' => $isIndonesian ? $item->title_id : $item->title,
                'subtitle' => $isIndonesian ? $item->subtitle_id : $item->subtitle,
                'image' => $item->image
            ];
        });
        
        $service = Service::all()->map(function($item) use ($isIndonesian) {
            return [
                'title' => $isIndonesian ? $item->title_id : $item->title,
                'subtitle' => $isIndonesian ? $item->subtitle_id : $item->subtitle,
                'image' => $item->image
            ];
        });
        
        $portofolio = Portofolio::with('images')->select('id','project_name', 'status','location','image','slug')->get();
        $design = Design::with('images')->select('id','project_name','location','image','slug')->get();
        
        $legality = Legality::with('images')->get()->map(function($item) use ($isIndonesian) {
            return [
                'id' => $item->id,
                'title' => $isIndonesian ? $item->title_id : $item->title,
                'subtitle' => $isIndonesian ? $item->subtitle_id : $item->subtitle,
                'image' => $item->image,
                'slug' => $item->slug,
                'images' => $item->images
            ];
        });
        
        $about = About::all()->map(function($item) use ($isIndonesian) {
            return [
                'title' => $isIndonesian ? $item->title_id : $item->title,
                'subtitle' => $isIndonesian ? $item->subtitle_id : $item->subtitle,
                'image' => $item->image
            ];
        });
        
        $client = Client::select('title', 'image')->get();
        
        $statistics = Statistic::orderBy('order')->get()->map(function($item) use ($isIndonesian) {
            return [
                'label' => $isIndonesian ? $item->label_id : $item->label,
                'value' => $item->value,
                'icon' => $item->icon
            ];
        });
        
        // Get professionals grouped by category
        $professionals = [
            'board_of_director' => Professional::where('category', 'board_of_director')
                ->orderBy('order')
                ->get()
                ->map(function($item) use ($isIndonesian) {
                    return [
                        'name' => $item->name,
                        'position' => $isIndonesian ? $item->position_id : $item->position,
                        'photo' => $item->photo,
                        'details' => $item->details
                    ];
                }),
            'management' => Professional::where('category', 'management')
                ->orderBy('order')
                ->get()
                ->map(function($item) use ($isIndonesian) {
                    return [
                        'name' => $item->name,
                        'position' => $isIndonesian ? $item->position_id : $item->position,
                        'photo' => $item->photo,
                        'details' => $item->details
                    ];
                }),
        ];
        
        $data = [
            'master_head' => $masterhead,
            'service' => $service,
            'portofolio' => $portofolio,
            'design' => $design,
            'legality' => $legality,
            'about' => $about,
            'client' => $client,
            'statistics' => $statistics,
            'professionals' => $professionals,
        ];
        return response()->json($data);
    }


    public function detail(Request $request):JsonResponse
    {
        $res =[];
        $rescode = 200;
        $slug = $request->query('slug','');

        Try{

            $data = Portofolio::with('images')->select('id','project_name', 'status','location','image','owner_project','alamat','nilai_kontrak','jenis_bangunan','waktu','status_update','updated_at')->where('slug',$slug)->first();
            if($data){
                $res=['success'=>1,'data'=>$data];
            }else{
                $res=['success'=>0,'message'=>'Data tidak ditemukan'];
            }
        }catch (QueryException $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan saat Proses data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }
        return response()->json($res,$rescode);
    }

    public function designDetail(Request $request):JsonResponse
    {
        $res =[];
        $rescode = 200;
        $slug = $request->query('slug','');

        Try{

            $data = Design::with('images')->select('id','project_name','location','image','owner_project','jenis_bangunan','waktu','updated_at')->where('slug',$slug)->first();
            if($data){
                $res=['success'=>1,'data'=>$data];
            }else{
                $res=['success'=>0,'message'=>'Data tidak ditemukan'];
            }
        }catch (QueryException $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan saat Proses data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }
        return response()->json($res,$rescode);
    }

    public function legalityDetail(Request $request):JsonResponse
    {
        $res =[];
        $rescode = 200;
        $slug = $request->query('slug','');

        Try{

            $data = Legality::with('images')->select('id','title','title_id','subtitle','subtitle_id','image','updated_at')->where('slug',$slug)->first();
            if($data){
                $res=['success'=>1,'data'=>$data];
            }else{
                $res=['success'=>0,'message'=>'Data tidak ditemukan'];
            }
        }catch (QueryException $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan saat Proses data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }
        return response()->json($res,$rescode);
    }

}
