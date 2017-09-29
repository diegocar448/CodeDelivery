<?php

namespace CodeDelivery\Http\Requests;

//use CodeDelivery\Http\Requests\Request;
use Illuminate\Http\Request as HttpRequest; //para evitar conflito com o extends Request

class CheckoutRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(HttpRequest $request)
    {
        $rules = [
             'cupom_code' => 'exists:cupoms,code,used,0', //verificamos se existe , o nome da tabela, e o nome do campo, e não permitir campo usado
        ];
        $this->buildRulesItems(0, $rules); // aqui ja passa um posição para obrigar o usuario a passar pelo menos 1 item
        $items = $request->get('items', []); //aqui teremos os nosso items
        $items = !is_array($items) ? [] : $items; //fazer verificação para garantir que o items será um array, operador ternario

        foreach($items as $key => $val) //fazer varredura para criarmos as nossas regras
        {
            $this->buildRulesItems($key, $rules); //chamamos o metodo e passamos o key e o rules
        }
        return $rules;
    }

    public function buildRulesItems($key, array &$rules) //qualquer coisa que acontecer dentro do metodo com parametro q tem o & não é alterado 
    {
        $rules["items.$key.product_id"] = 'required';
        $rules["items.$key.qtd"] = 'required';            
    }
}

