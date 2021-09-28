<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use Exception;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Função para mostrar todos os registros.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cars = Car::all();

        if (count($cars) <= 0){
            return response()->json(['status' => 'Nenhum registro encontrado!']);
        }
        return response()->json($cars);
    }

    /**
     * Função para cadastrar um novo registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(CarRequest $request)
    {
        try{

            $car = Car::create([
                'brand' => $request->brand,
                'model' => $request->model,
                'year' => $request->year
            ]);

            return response('Criado', 201);

        }catch(Exception $exception){

            return $exception->getMessage();
        }

    }

    /**
     * Função para mostrar um único registro.
     *
     * @param  int  $ca
     * @return \Illuminate\Http\JsonResponse
     */
    public function showById(Car $car)
    {
        return response()->json($car);
    }

    /**
     * Função para atualizar um registro;
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        return response()->json($request);
    }

    /**
     * Função para apagar um registro.
     *
     * @param  int  $car
     * @return \Illuminate\Http\Response
     */
    public function delete(Car $car)
    {
        $car->delete();
        return response('Excluido com Sucesso!', 200);
    }
}
