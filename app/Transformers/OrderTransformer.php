<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Order;

/**
 * Class OrderTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    //esse array ta informando os metodos q são padrões na hora de serializar esse Order $model ou seja qdo a gente chamar esse transform() ele ja vai serializar esse includeCupom() em seguida
    //ele compara ex: ['cupom'] com o nome do metodo includeCupom e serializa
    //ele compara ex: ['items'] com o nome do metodo includeItems e serializa
    protected $availableIncludes = ['cupom', 'items'];


    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id'         => (int) $model->id,
            'total'      => (float) $model->total,
            
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    //sempre terá include antes do nome qdo fazer relacionamento
    public function includeCupom(Order $model)
    {
        //se não tiver relação retorna NULL
        if (!$model->cupom) {
            return null;
        }
        //reponsavel por serializar apenas 1 objeto
        return $this->item($model->cupom, new CupomTransformer());
    }


    //serialização de uma coleção de dados
    public function includeItems(Order $model)
    {
        return $this->collection($model->items, new OrderItemTransformer());
    }

}
