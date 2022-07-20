<?php

namespace app\Http\BusinessLogic;

use App\Http\Repository\HistorialCobrosGaritaRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CobroGarita;
use App\Models\HistorialCobroGarita;
use App\Http\BusinessLogic\ParametroBusinessLogic;
use Dotenv\Exception\ValidationException;
use Exception;

class HistorialCobroGaritaBusinessLogic {

    private $_historialCobroGaritaRepository;
    private $_parametrosBusinessLogic;
    private $hisotrial;

    public function __construct()
    {
        $this->_historialCobroGaritaRepository = new HistorialCobrosGaritaRepository();
        $this->_parametrosBusinessLogic = new ParametroBusinessLogic();

    }

    public function aperturarHistorialCobro($request){
        try {
            $data = $request->all();
            
            $historial = HistorialCobroGarita::where('idUsuarioCreacion',Auth::user()->id)
                                                ->whereNull('fechaFin')
                                                ->where('cerrado','=',false)
                                                ->first();
        
            if( !$historial ) {
                $data['idUsuarioCreacion'] = Auth::user()->id;
                $data['fechaInicio']       = date("Y-m-d h:i:s a",time());
                $historial = $this->_historialCobroGaritaRepository->create($data);
            }
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $historial;
    }


    public function valoresTurno($request){
        try {
            $data = $request->all();
            $total = 0;
            
            $historial = HistorialCobroGarita::where('idUsuarioCreacion',Auth::user()->id)
                                                ->whereNull('fechaFin')
                                                ->where('cerrado','=',false)
                                                ->first();
        
            if( !$historial ) {
                throw new ValidationException(json_encode(['error'=>["No existe un turno de cobro abierto en el historial."]]));
            }

            $usuario = Auth::user()->id;

            $cobrosGaritasNoCerrados =DB::select('SELECT cg."idTipoVehiculo" ,p.nombre,sum(cg.valor)  as valor 
                                                    from cobros_garita cg 
                                                    inner join parametros p on cg."idTipoVehiculo" = p.id 
                                                    where cg."idUsuarioCreacion" = '. $usuario .'
                                                    and cg.cerrado = false and cg.activo = true
                                                    group by cg."idTipoVehiculo" ,p.nombre'
                                        );

            $tiposVehiculos = $this->_parametrosBusinessLogic->obtenerListaParametros('PAR-TIPO-VEH')->toArray();
            
            $valoresRecaudados = [];
            foreach( $tiposVehiculos as $tipos ){
                $tipos['valor'] =" 0.00";
                foreach( $cobrosGaritasNoCerrados as $cobros){
                    if($tipos['id'] == $cobros->idTipoVehiculo){
                        $tipos['valor'] = $cobros->valor;
                        $total = $total + (float) $cobros->valor;
                    }
                }
                $valoresRecaudados[] = $tipos; 
            }

            $data = [
                "usuario" => Auth::user(),
                "valorRecaudidado" => $valoresRecaudados,
                "totalRecaudado" => $total
            ];
           
        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());  
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }

    public function cerrarTurno($request){
        try {
            DB::transaction(function () use ( $request ) {
                $data = $request->all();
                
                $historial = HistorialCobroGarita::where('idUsuarioCreacion',Auth::user()->id)
                                                    ->whereNull('fechaFin')
                                                    ->where('cerrado','=',false)
                                                    ->first();
                
                if( !$historial ) {
                    throw new ValidationException(json_encode(['error'=>["No existe un turno de cobro abierto en el historial."]]));
                }
            
                $usuario = Auth::user()->id;
            
                $cobrosGaritasNoCerrados =DB::select('SELECT cg."idTipoVehiculo" ,p.nombre,sum(cg.valor)  as valor 
                                                        from cobros_garita cg 
                                                        inner join parametros p on cg."idTipoVehiculo" = p.id 
                                                        where cg."idUsuarioCreacion" = '. $usuario .'
                                                        and cg.cerrado = false and cg.activo = true
                                                        group by cg."idTipoVehiculo" ,p.nombre'
                                            );

                $cobrosGarita = CobroGarita::where('idUsuarioCreacion', $usuario)
                                            ->where('cerrado','=',false)
                                            ->where('activo','=',true)->get();     
                $valorTotal = 0;
                foreach( $cobrosGaritasNoCerrados as $cobros){
                    $valorTotal = $valorTotal + (float)$cobros->valor;
                }

                
                $data['fechaFin']           = date("Y-m-d h:i:s a",time());
                $data['valorRecaudado']    = $valorTotal;
                $data['cerrado']           = true;
                $this->historial = $this->_historialCobroGaritaRepository->update($data,$historial);

                foreach( $cobrosGarita as $cobro){
                    $cobro->update(['cerrado'=>true]);
                }
        });


        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());      
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $this->historial;
    }


}