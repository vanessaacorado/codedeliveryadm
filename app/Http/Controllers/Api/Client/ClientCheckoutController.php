<?php

namespace CodeDelivery\Http\Controllers\Api\Client;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\CategoryRequest;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use CodeDelivery\Http\Requests\ClientRequest;
class ClientCheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ProductsRepository;
    private $UserRepository;
    private $OrderRepository;
    private $service;
    public function __construct(ProductRepository $ProductRepository,
                                UserRepository $UserRepository, 
                                OrderRepository $OrderRepository, OrderService $service){
        $this->ProductRepository = $ProductRepository;
        $this->UserRepository = $UserRepository;
        $this->OrderRepository = $OrderRepository;
        $this->service= $service;
    }
    public function index(){
        $id=Authorizer::getResourceOwnerId();
        $clientId = $this->UserRepository->find($id)->client->id;
        $orders = $this->OrderRepository->with('items')->scopeQuery(function($query) use ($clientId){
                return $query->where('client_id', '=', $clientId);
            })->paginate();
        return $orders;
        
    }
  
    public function store(ClientRequest $request){
        $id=Authorizer::getResourceOwnerId();
        $data = $request->all();
        $clientId = $this->UserRepository->find($id)->client->id;
        $data['client_id'] = $clientId;
        $o=$this->service->create($data);
        $o=$this->OrderRepository->with('items')->find($o->id);
        return $o;
    }
    public function show($id){
        $o=$this->OrderRepository->with(['items', 'cupom','client'])->find($id);
        $o->items->each(function($item){
            $item->product;
            });
        return $o;
    }
    
}
