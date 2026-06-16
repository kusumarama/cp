<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Client;
use App\Models\Design;
use App\Models\Legality;
use App\Models\Statistic;
use App\Models\Professional;
use App\Models\IsoCertification;
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
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    /**
     * Convert a storage path to a full URL that works in the /cp subdirectory.
     */
    private function getStorageUrl($path)
    {
        if (!$path) return null;
        $storagePath = Storage::url($path);
        // If path is relative, prepend current app path
        if (strpos($storagePath, 'http') === false && strpos($storagePath, '/') === 0) {
            $storagePath = '/cp/public' . $storagePath;
        }
        return $storagePath;
    }
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
        
        $getStorageUrl = [$this, 'getStorageUrl'];
        
        // Return all masterhead records (ordered newest first) so frontend can use them for a slider
        $masterhead = MasterHead::latest()->get()->map(function($item) use ($isIndonesian, $getStorageUrl) {
            return [
                'title' => $isIndonesian ? $item->title_id : $item->title,
                'subtitle' => $isIndonesian ? $item->subtitle_id : $item->subtitle,
                'image' => $getStorageUrl($item->image)
            ];
        });
        
        $service = Service::all()->map(function($item) use ($isIndonesian, $getStorageUrl) {
            return [
                'title' => $isIndonesian ? $item->title_id : $item->title,
                'subtitle' => $isIndonesian ? $item->subtitle_id : $item->subtitle,
                'image' => $getStorageUrl($item->image)
            ];
        });
        
        $portofolio = Portofolio::with('images')->select('id','project_name', 'status','location','image','slug')->get()->map(function($item) use ($getStorageUrl) {
            return [
                'id' => $item->id,
                'project_name' => $item->project_name,
                'status' => $item->status,
                'location' => $item->location,
                'image' => $getStorageUrl($item->image),
                'slug' => $item->slug,
                'images' => $item->images->map(function($img) use ($getStorageUrl) {
                    return [
                        'id' => $img->id,
                        'image_path' => $getStorageUrl($img->image_path),
                        'sort_order' => $img->sort_order,
                    ];
                })
            ];
        });
        $design = Design::with('images')->select('id','project_name','location','image','slug')->get()->map(function($item) use ($getStorageUrl) {
            return [
                'id' => $item->id,
                'project_name' => $item->project_name,
                'location' => $item->location,
                'image' => $getStorageUrl($item->image),
                'slug' => $item->slug,
                'images' => $item->images->map(function($img) use ($getStorageUrl) {
                    return [
                        'id' => $img->id,
                        'image_path' => $getStorageUrl($img->image_path),
                        'sort_order' => $img->sort_order,
                    ];
                })
            ];
        });
        
        $legality = Legality::with('images')->orderBy('title', 'asc')->get()->map(function($item) use ($isIndonesian, $getStorageUrl) {
            return [
                'id' => $item->id,
                'title' => $isIndonesian ? $item->title_id : $item->title,
                'subtitle' => $isIndonesian ? $item->subtitle_id : $item->subtitle,
                'image' => $getStorageUrl($item->image),
                'slug' => $item->slug,
                'images' => $item->images->map(function($img) use ($getStorageUrl) {
                    return [
                        'id' => $img->id,
                        'image_path' => $getStorageUrl($img->image_path),
                        'sort_order' => $img->sort_order,
                    ];
                })
            ];
        });
        
        $about = About::all()->map(function($item) use ($isIndonesian, $getStorageUrl) {
            return [
                'title' => $isIndonesian ? $item->title_id : $item->title,
                'subtitle' => $isIndonesian ? $item->subtitle_id : $item->subtitle,
                'image' => $getStorageUrl($item->image)
            ];
        });
        
        $client = Client::select('title', 'image')->get()->map(function($item) use ($getStorageUrl) {
            return [
                'title' => $item->title,
                'image' => $getStorageUrl($item->image)
            ];
        });
        
        $statistics = Statistic::orderBy('order')->get()->map(function($item) use ($isIndonesian, $getStorageUrl) {
            return [
                'label' => $isIndonesian ? $item->label_id : $item->label,
                'value' => $item->value,
                'icon' => $item->icon ? $getStorageUrl($item->icon) : null
            ];
        });

        // ISO Certifications
        $iso_certifications = IsoCertification::orderBy('order')->get()->map(function($item) use ($isIndonesian, $getStorageUrl) {
            return [
                'title' => $isIndonesian ? $item->title_id : $item->title,
                'description' => $isIndonesian ? $item->description_id : $item->description,
                'image' => $getStorageUrl($item->image)
            ];
        });
        
        // Get professionals grouped by category
        $professionals = [
            'board_of_director' => Professional::where('category', 'board_of_director')
                ->orderBy('order')
                ->get()
                ->map(function($item) use ($isIndonesian, $getStorageUrl) {
                    return [
                        'name' => $item->name,
                        'position' => $isIndonesian ? $item->position_id : $item->position,
                        'photo' => $getStorageUrl($item->photo),
                        'details' => $item->details
                    ];
                }),
            'management' => Professional::where('category', 'management')
                ->orderBy('order')
                ->get()
                ->map(function($item) use ($isIndonesian, $getStorageUrl) {
                    return [
                        'name' => $item->name,
                        'position' => $isIndonesian ? $item->position_id : $item->position,
                        'photo' => $getStorageUrl($item->photo),
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
            'iso_certifications' => $iso_certifications,
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
                $transformed = $data->toArray();
                $transformed['image'] = $this->getStorageUrl($data->image);
                $transformed['images'] = $data->images->map(function($img) {
                    return [
                        'id' => $img->id,
                        'image_path' => $this->getStorageUrl($img->image_path),
                        'sort_order' => $img->sort_order,
                    ];
                });
                $res=['success'=>1,'data'=>$transformed];
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
                $transformed = $data->toArray();
                $transformed['image'] = $this->getStorageUrl($data->image);
                $transformed['images'] = $data->images->map(function($img) {
                    return [
                        'id' => $img->id,
                        'image_path' => $this->getStorageUrl($img->image_path),
                        'sort_order' => $img->sort_order,
                    ];
                });
                $res=['success'=>1,'data'=>$transformed];
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
                $transformed = $data->toArray();
                $transformed['image'] = $this->getStorageUrl($data->image);
                $transformed['images'] = $data->images->map(function($img) {
                    return [
                        'id' => $img->id,
                        'image_path' => $this->getStorageUrl($img->image_path),
                        'sort_order' => $img->sort_order,
                    ];
                });
                $res=['success'=>1,'data'=>$transformed];
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
