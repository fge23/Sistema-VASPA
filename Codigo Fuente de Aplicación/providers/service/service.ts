import { HttpClient } from '@angular/common/http';
import { Http } from '@angular/http';
import { Injectable } from '@angular/core';
import 'rxjs/add/operator/map';



@Injectable()
export class ServiceProvider {
  api:string = "http://192.168.1.71/api";
  carreras: any;
  constructor(public http: HttpClient) {
    console.log('Hello ServiceProvider Provider');
  }

  getData(){
    return this.http.get(this.api+'/asignaturas.php').map(res=>res)
  }

   getCarreras(){
      return this.http.get(this.api+'/carreras.php').map(res=>res)
  }




}
