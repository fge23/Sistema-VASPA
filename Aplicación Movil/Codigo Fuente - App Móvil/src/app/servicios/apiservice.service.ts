import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ApiserviceService {

  //SE DEBE REEMPLAZAR LA IP POR EL SERVER REAL 
   apiURLCarreras = 'http://192.168.3.107/vaspa/servicioPlanes.php';
   apiURLAsignaturas = 'http://192.168.3.107/vaspa/servicioAsignaturasDePlan.php';
   apiURLProgramasDisponibles = 'http://192.168.3.107/vaspa/servicioAniosDisponiblesProgramas.php';
  constructor(private http:HttpClient) { }
    
    getCarreras(){
      return this.http.get(`${this.apiURLCarreras}`);
    }

    getAsignaturas(idPlan){
      return this.http.get(`${this.apiURLAsignaturas}?idPlan=${idPlan}`);
    }

    getProgramasDisponibles(idAsignatura){
      return this.http.get(`${this.apiURLProgramasDisponibles}?idAsignatura=${idAsignatura}`);
    }
}
