<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use Exception;
use http\Env\Response;
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

            $car = new Car();
            $car->brand = $request->brand;
            $car->model = $request->model;
            $car->year = $request->year;

            $car->save();

            return response(['success' => true], 201);

        }catch(\Exception $exception){

            return response(['error' => $exception->getMessage()]);
        }

    }

    /**
     * Função para mostrar um único registro.
     *
     * @param Car $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function showById(Car $car)
    {
        return response()->json($car);
    }

    /**
     * Função para atualizar um registro;
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, Car $car)
    {
        try {

            $car->brand = $request->brand;
            $car->model = $request->model;
            $car->year = $request->year;

            $car->update();

            return response(['success' => true]);

        }catch (\Exception $exception){
            return response(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Função para apagar um registro.
     *
     * @param  int  $car
     * @return \Illuminate\Http\Response
     */
    public function delete(Car $car)
    {
        try {

            $car->delete();
            return response(['success' => true]);

        }catch (\Exception $exception){
            return response(['error' => $exception->getMessage()]);
        }

    }
}
