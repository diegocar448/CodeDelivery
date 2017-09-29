<?php 
namespace CodeDelivery\Services;


use CodeDelivery\Models\Order;
use CodeDelivery\Repositories\CupomRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;

class OrderService
{
	private $orderRepository;
	private $cupomRepository;
	private $productRepository;

	public function __construct(
			OrderRepository $orderRepository, 
			CupomRepository $cupomRepository, 
			ProductRepository $productRepository
			)
	{
		$this->orderRepository = $orderRepository;
		$this->cupomRepository = $cupomRepository;
		$this->productRepository = $productRepository;
	}

	public function create(array $data)
	{

		//trabalhando com transação iniciando ela
		\DB::beginTransaction();
		try{
			$data['status'] = 0; //para garantir que o pedido sempre sera pendente
			
			//condição para não permitir usuario enviar cupom_id (logica para segurança do app)
			if (isset($data['cupom_id'])) 
			{
				unset($data['cupom_id']);
			}


			//verificar se vai passar algum cupom de desconto
			if(isset($data['cupom_code']))
			{
				$cupom = $this->cupomRepository->findByField('code', $data['cupom_code'])->first(); //pegar o primeiro registro
				$data['cupom_id'] = $cupom->id;  // vai determinar que o codigo do nosso cupom sera o id
				$cupom->used = 1;
				$cupom->save(); //salva o cupom
				unset($data['cupom_code']); //para ele não tentar persistir esses dados qdo a gente colocar o data no array
			}

			$items = $data['items']; //prepara esse $data para ser inserido no banco
			unset($data['items']);

			$order = $this->orderRepository->create($data);//criar a ordem de serviço
			$total = 0;

			foreach($items as $item)
			{
				$item['price'] = $this->productRepository->find($item['product_id'])->price; //pega o preço individual
				$order->items()->create($item);  //vamos adicionar esse item a nossa ordem de serviço   
				$total += $item['price'] * $item['qtd'];
			}

			$order->total = $total;
			//verificar se ele esta usando um cupom de desconto
			if(isset($cupom))
			{
				$order->total = $total - $cupom->value;  //se tiver cupom subtrair o desconto
			}

			$order->save();  //guardar o total da ordem no banco

			\DB::commit(); //dar commit nos dados caso o o codigo tenha rodado com sucesso
			return $order; //pegar a order
		}
		catch(\Exception $e)
		{
			\DB::rollBack();  //rollback volta tudo caso não tenha feito todo o processo
			throw $e;
		}
	}

	public function updateStatus($id, $idDeliveryman, $status) //com o $id da order e o id $idDeliveryman do deliveryman
	{
		$order = $this->orderRepository->getByIdAndDeliveryman($id, $idDeliveryman);
		if ($order instanceof Order) //se a $order for instancia da entidade Order
		{
			$order->status = $status;	
			$order->save();
			return $order;
		}
		return false;

	}

}